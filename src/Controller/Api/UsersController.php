<?php

namespace App\Controller\Api;



use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Mailer\Email;

use Cake\Error\Debugger;
use Twilio\Rest\Client;
use Cake\ORM\TableRegistry;


/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */


class UsersController extends AppController
{



	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);
        // $this->getEventManager()->off($this->Csrf);
        $this->Auth->allow(); 
        $this->authcontent();
        $this->viewBuilder()->setLayout('ajax');

}



    /**

     * Index method

     *

     * @return \Cake\Http\Response|void

     */
   public function index(){
    	
        $baseurl = Router::url('/',true);

    

        $indexInfo['description'] = "Signin (post method)";

        $indexInfo['url'] = $baseurl. "api/users/login";

        $indexInfo['parameters'] = 'phone:4569871236 password:123456  <br>';

        $indexarr[] = $indexInfo;   
        
        $indexInfo['description'] = "EditInfo (post method)";

        $indexInfo['url'] = $baseurl. "api/users/editinfo";

        $indexInfo['parameters'] = 'id:456 phone:123456789 image:base64 email:kuldeepjha@avainfotech.com gender:male : name:kuldeep age:25 <br>';

        $indexarr[] = $indexInfo;   

        $indexInfo['description'] = "Change Password (post method)";

        $indexInfo['url'] = $baseurl. "api/users/changepassword";

        $indexInfo['parameters'] = 'id:456  oldpassword : 123456 password:12345678<br>';

        $indexarr[] = $indexInfo; 

        $indexInfo['description'] = "Forgot password by Email (post method)";

        $indexInfo['url'] = $baseurl. "api/users/forgotemail";

        $indexInfo['parameters'] = 'email : kuldeepjha@avainfotech.com <br>';

        $indexarr[] = $indexInfo; 

        $indexInfo['description'] = "Verify OTP (post method)";

        $indexInfo['url'] = $baseurl. "api/users/verifyotp";

        $indexInfo['parameters'] = 'id:234 otp:4569 <br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = "reset password";

        $indexInfo['url'] = $baseurl. "api/users/reset";

        $indexInfo['parameters'] = 'id:234 password:123456 cpassword:12365478 <br>';

        $indexarr[] = $indexInfo; 

        $indexInfo['description'] = "Forgot password by phone (post method)";

        $indexInfo['url'] = $baseurl. "api/users/forgotphone";

        $indexInfo['parameters'] = 'phone : 1236547890 <br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = "For notification  (post method)";

        $indexInfo['url'] = $baseurl. "api/users/getnotification";

        $indexInfo['parameters'] = 'receiver_id : 454 <br>';

        $indexarr[] = $indexInfo;


        $indexInfo['description'] = "Adding card details";

        $indexInfo['url'] = $baseurl. "api/users/addcard";

        $indexInfo['parameters'] = 'user_id :181 card_number : 41111111111 holder_name: vikrant expiry_date : 09/23<br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = "Filter programs by instructor id,rating,subscribtion";

        $indexInfo['url'] = $baseurl. "api/users/filterprograms";

        $indexInfo['parameters'] = 'instructor_id :1<br>';

        $indexarr[] = $indexInfo; 


        $indexInfo['description'] = " For subscriptions screens";

        $indexInfo['url'] = $baseurl. "api/users/subscriptions";

        $indexInfo['parameters'] = '';

        $indexarr[] = $indexInfo;  


        $indexInfo['description'] = "For introductory screens";

        $indexInfo['url'] = $baseurl. "api/users/introductorydata";

        $indexInfo['parameters'] = '';

        $indexarr[] = $indexInfo; 



		$indexInfo['description'] = "All Programs";

		$indexInfo['url'] = $baseurl. "api/users/programs";

		$indexInfo['parameters'] = '';

		$indexarr[] = $indexInfo;     


        $indexInfo['description'] = "For instructors list";

        $indexInfo['url'] = $baseurl. "api/users/instructor";

        $indexInfo['parameters'] = '';

        $indexarr[] = $indexInfo;   

        $indexInfo['description'] = "Subscribed programs by user";

        $indexInfo['url'] = $baseurl. "api/users/joinnow";

        $indexInfo['parameters'] = 'user_id :227 subscribed_id:1 program_id:2';

        $indexarr[] = $indexInfo;   

        $this->set('baseurl', $baseurl);
        $this->set('indexarr', $indexarr); 

        $this->set('_serialize', ['user']);

    }
    
    
 
    
     public function instructor()
    {
      
        $response = array();
        $this->loadModel('Instructors');
        $introdata =$this->Instructors->find('all',[

        	'contain'=>['instructorstyles'=>['Styles']]

    ])->toArray();
        foreach($introdata as $value)
        {
            $value['image'] = Router::url('/',true).'images/introductoryimages/'.$value['image'];
            
        } 

        if($introdata){
            $response['data'] = $introdata;
            $response['status'] = true;
        }else{
            $response['data'] ='';
            $response['status'] = false;
        }
        echo json_encode($response);
        exit;
    }

// signup

   public function register()

    {  
        $this->loadModel('Users');
        $response = array();
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			if (empty($this->request->data['email'])) {
				$response['status'] = false;
				$response['msg'] = "Email required";
			} elseif (empty($this->request->data['phone'])) {
				$response['status'] = false;
				$response['msg'] = "Phone required";
			} else {
				$user_check = $this->Users->find('all', ['conditions' => ['Users.phone' => $this->request->data['phone']]]);
				$user_check = $user_check->first();

				$user_email = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
				$user_email = $user_email->first();
				if (!empty($user_check)) {
					$response['status'] = false;
					$response['msg'] = "Phone number already exists. Please try with another Phone number.";
				} elseif (!empty($user_email)) {
					$response['status'] = false;
					$response['msg'] = "Email is already exists. Please try with another Email.";
				} else {
					if ($this->request->data['password'] == $this->request->data['confirmpassword']) {
						$post = $this->request->getData();
						$post['status'] = '1';
						$post['role'] = 'user';

						$user = $this->Users->patchEntity($user, $post);
						$new_user = $this->Users->save($user);

						if ($new_user)
                        {
							$response['status'] = true;
							$response['msg'] = "Registration done successfully.";
							$response['data'] = $new_user;
						} else 
                       {
							$response['status'] = false;
							$response['msg'] = "The user could not be saved. Please, try again.";
						}
					} else {
						$response['status'] = false;
						$response['msg'] = "Password and Confirm Password should match.";
					}

				}
			}
		}
		echo json_encode($response);
		exit;
    }
    
    
      // login api   

   	public function login() 
    {
     	$this->loadModel('Users');
		$response = array();
		if ($this->request->is('post')) {

			if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {
                    $use = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
					$use = $use->first();
                    $use['image_path'] = Router::url('/',true).'images/users/';
                    if(!empty($this->request->data['device_token']))
                    {

                     $set_token = $this->Users->updateAll(array('device_token' => $this->request->data['device_token']), array('id' => $use['id']));
       
                    }

					if($use){
					    if(!(new DefaultPasswordHasher)->check($this->request->data['password'], $use['password'])){
					        	$response['msg'] = 'Wrong password';
			                	$response['status'] = false;
					    }
					    else {
					         if ($use['status'] == 0) {   
                                 $this->Auth->logout();
                                 $response['msg']='You are not active Yet!';
                                 $response['status']=false;    
                      
                              }
                             else if($use['role'] == 'admin'){
                                $response['msg']='You are admin';
                                $response['status']=false;
                                 }
                                 else{
                                     $response['data'] = $use;
                                     $response['msg'] = 'login successfully';
			                         $response['status'] = true;
                                     }
					    }
					}
             
			}
			else {
			    	$response['msg'] = 'Invalid email';
			    	$response['status'] = false;
			} 
		}
		echo json_encode($response);
		exit;
	}
	
	
	
// 	Forgot email



	public function forgotemail() {
	$this->loadModel('Users');
		$response = array();
		if ($this->request->is('post')) {
			$email = $this->request->data['email'];
			if (!empty($email)) {
				$user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);
				$user = $user->first();
				if (empty($user)) {
					$response['status'] = false;
					$response['msg'] = 'Enter regsitered email address to reset you password.';
				} 
				else {
					if ($user->email) {
						$randnum = rand(1000, 9999);
						$this->Users->updateAll(array('tokenhash' => $randnum), array('id' => $user->id));
						$email = new Email('default');
						$send = $email->from(['nancy@avainfotech.com' => 'Dance App'])
							->emailFormat('html')
							->template('forgot')
							->to($user->email)
							->subject('Reset Your Password')
							->viewVars(array('otp' => $randnum))
							->viewVars(array('user' => $user))
							->send();

						$response['status'] = true;
						$response['msg'] = 'Check your email to reset your Password.';
						$response['data'] = $user;
					} else {
						$response['status'] = false;
						$response['msg'] = 'Email Is Invalid.';
					}
				}
			} else {
				$response['status'] = false;
				$response['msg'] = 'Please enter your register email address.';
			}
		}
		echo json_encode($response);
		exit;
	}
	
	
// 	Forgot phone


public function forgotphone() {
    $this->loadModel('Users');
    $response = array();
    	if ($this->request->is('post')) {
    	    	$number = $this->request->data['phone'];
			if (!empty($number)) {
				$user = $this->Users->find('all', ['conditions' => ['Users.phone' => $number]]);
				$user = $user->first();
				if (empty($user)) {
					$response['status'] = false;
					$response['msg'] = 'Enter regsitered phone number to reset you password.';
				} 
				else {
					if ($user->phone) {
						$sid = "AC14440b312fdde400c320790c69117981";
                		$token = "1f925f0477089656c6dadd8bd44d3422";
                		$number = $this->request->data['phone'];
                		$twilio = new Client($sid, $token);
                		$randnum = rand(1000, 9999);
                		$post['tokenhash'] = $randnum;
                	    $this->Users->updateAll(array('tokenhash' => $randnum), array('id' => $user->id));
                		$message = $twilio->messages
                			->create($number, array("from" => "+18653240260", "body" => "Your OTP is " . $randnum)
                			);
						$response['status'] = true;
						$response['msg'] = 'Otp has been sent successfully.';
						$response['data'] = $user;
					} else {
						$response['status'] = false;
						$response['msg'] = 'Phone Is Invalid.';
					}
				}
			} else {
				$response['status'] = false;
				$response['msg'] = 'Please enter your registered Phone.';
			}
	}
	echo json_encode($response);
        		exit;
    
}
	
	
// 	Verify otp


public function verifyotp() {
		//params-  id,otp
		$response = array();
		if ($this->request->is('post')){
		   	if (empty($this->request->data['id'])) {
			$response['msg'] = 'user id required';
			$response['status'] = false;
		} else {
			$users = $this->Users->find('all', [
				'conditions' => ['Users.id' => $this->request->data['id']],
			]);
			$users = $users->first();
			if ($users['tokenhash'] == $this->request->data['otp']) {
				// $this->Users->updateAll(array('status'=>1), array('id' => $users['id']));
				$response['data'] = $users;
				$response['status'] = true;
				$response['msg'] = 'You have successfully verify Otp!';
				// $response['baseurl'] =  Router::url('/', true) . 'images/users/';
			} else {
				$response['msg'] = 'Invalid otp';
				// $response['data'] = '';
				$response['status'] = false;
			}
		} 
		}
		echo json_encode($response);
		exit;
	}
	
	
// 	Reset passwords


public function resetpassword() {
		$response = array();
		if (empty($this->request->data['id'])) {
			$response['msg'] = 'user id required';
			$response['status'] = false;
		} else {
			$id = $this->request->data['id'];
			$data = $this->Users->get($id);
			if ($this->request->data['password'] != $this->request->data['confirmpassword']) {
				$response['msg'] = 'Password does not match';
				$response['status'] = false;
			} else {
			    $pass = $this->request->data['password'];
			    $post['password'] = $pass;
			 //   $this->Users->updateAll(array('password' => $password), array('id' => $data->id));
                if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($data, $post);  
                $user = $this-> Users ->save($user);
                if($user){
                     $response['data'] = $data;
                     $response['status'] = true;
                     $response['msg'] = 'Password Changed Successfully.';
                }
                else{
                    $response['status'] = false;
                    $response['msg'] = 'Something went wrong.';
                }
                }
			}
		}
		echo json_encode($response);
		exit;
	}
	
	
	
// 	change password


	public function changepassword() {
		//params- id,oldpassword,password,confirmpassword
		if (empty($this->request->data['id'])) {
			$response['msg'] = 'user id required';
			$response['status'] = false;
		}
		else {
			$id = $this->request->data['id'];
			$user = $this->Users->get($id);
			if ((new DefaultPasswordHasher)->check($this->request->data['oldpassword'], $user['password'])) {
				if ($this->request->data['password'] != $this->request->data['confirmpassword']) {
					$response['msg'] = 'password does not match with confirm password';
					$response['status'] = false;
				} else {
					$user->password = $this->request->data['password'];
					if ($this->Users->save($user)) {
						$response['msg'] = 'Your password has been changed.';
						$response['status'] = true;
					}
				}
			} else {
				$response['msg'] = 'Incorrect old password';
				$response['status'] = false;
			}
		}
		echo json_encode($response);
		exit;
	}
	
	
	
// 	profile data


public function getprofiledata() 
{
	

		$users = $this->Users->find('all', [
            'conditions' => ['Users.id' => $this->request->data['id']],
            'contain' => ['Addresses','Subscribedprograms'=>['Programs'=>['Instructors']]]
			]);
		$users = $users->first();
		$users['image']=Router::url('/',true).'images/users/'.$users['image'];


		foreach ($users['subscribedprograms'] as $sub_val)
		{
			
			$sub_val['program']['thumbnail']=Router::url('/',true).'images/introductoryimages/'.$sub_val['program']['thumbnail'];
			$sub_val['program']['featured_video']=Router::url('/',true).'images/introductoryimages/'.$sub_val['program']['featured_video'];


		}
		

		
		$response['data'] = $users;
		$response['status'] = true;
		echo json_encode($response);
		exit;
	}
	


	
// 	edit profile


public function editprofile() {
   
		//params-  id,name,age,image,gender,instructor
		$post = $this->request->data; 
		if (empty($this->request->data['id'])) {
			$response['msg'] = 'user id required';
			$response['status'] = false;
		} elseif (empty($this->request->data['name']))
		{
			$response['msg'] = 'name is required';
			$response['status'] = false;
		} 
		 else 
		 {
			$id = $this->request->data['id'];
			$user = $this->Users->get($id);
					      
				// 			if($this->request->data['image']){
				// 			if ($this->request->data['image'] == "") {
				// 			    unset($this->request->data['image']);
				// 			} else {
				// 					$imgname = $this->request->data['image'];
				// 					$name = time().$imgname['name'];
				// 			    	$tmp_name = $imgname['tmp_name'];
				// 					$filepath = getcwd() . '/img/' . $imgname;
				// 		        	$up_data->image = $imgname;
				// 			}    
				// 			}
			if(!empty($this->request->data['image'])) {
             $uniquename = time().uniqid(rand()).'.png';
             $upload_path = WWW_ROOT . 'images/users/' . $uniquename;
          
             $userimage = base64_decode($post['image']);
             $success = file_put_contents($upload_path, $userimage);
             $uniquename = $uniquename;
             $post['image']= $uniquename;     
             }else{
               $post['image']= $user->image;  
             }
              	$post['image_path'] = Router::url('/',true).'images/users/';
				$up_data = $this->Users->patchEntity($user, $post);
				$update = $this->Users->save($up_data);
			if ($update) {
				$response['msg'] = 'Profile has been updated';
				$response['status'] = true;
				$response['data'] = $update;
			}
			else{
			    $response['msg'] = 'unable to update profile at this moment';
				$response['status'] = false;
			}
		}
		echo json_encode($response);
		exit;
	}
	
	
	
// 	instal login


public function instalogin() {
		//params-  insta_id,email,image,name
		$response = array();
		if (empty($this->request->data['insta_id'])) {
			$response['msg'] = "insta_id required";
			$response['status'] = false;
		} else {
			$fbuser = $this->Users->find('all', ['conditions' => ['Users.insta_id' => $this->request->data['insta_id']]]);
			$number = $fbuser->count();
			if ($number == 0) {
				if (empty($this->request->data['email'])) {
					$response['msg'] = 'email is required';
					$response['status'] = false;
				} elseif (empty($this->request->data['name'])) {
					$response['msg'] = 'name is required';
					$response['status'] = false;
				} else {
					$user = $this->Users->newEntity();
					$post = $this->request->getData();
					$user = $this->Users->patchEntity($user, $post);
					$new_user = $this->Users->save($user);
					if ($new_user) {
						$response['status'] = true;
						$response['msg1'] = "new instagram user registered successfully";
						$response['data'] = $new_user;
						if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {

							$use = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email'], 'Users.insta_id' => $this->request->data['insta_id']]]);
						} else {

							$use = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email'], 'Users.insta_id' => $this->request->data['insta_id']]]);
						}
						$use = $use->first();
						if (empty($use)) {
							$response['msg'] = 'Invalid email';
							$response['status'] = false;
						} else {
							$this->Auth->setUser($use);
							$response['msg'] = 'login successfully';
							$response['status'] = true;
							$response['data'] = $fbuser;
						}
					} else {
						$response['status'] = false;
						$response['msg'] = "The user could not be saved. Please, try again.";
					}
				}
			} else {
				if (empty($this->request->data['email'])) {
					$response['msg'] = 'email is required';
					$response['status'] = false;
				} else {
					if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {

						$use = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email'], 'Users.insta_id' => $this->request->data['insta_id']]]);
					} else {

						$use = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email'], 'Users.insta_id' => $this->request->data['insta_id']]]);
					}
					$use = $use->first();
					if (empty($use)) {
						$response['msg'] = 'Invalid email';
						$response['status'] = false;
					} else {
						$this->Auth->setUser($use);
						$response['msg'] = 'login successfully';
						$response['status'] = true;
						$response['data'] = $fbuser;
					}
				}
			}
		}
		echo json_encode($response);
		exit;

	}
	
	
	
// 	facebook login

        public function fblogin() { 
       
        $response = array();
        if ($this->request->is('post')) {   
             $imgurl ='https://graph.facebook.com/'.$this->request->data['fb_id'].'/picture?width=320&height=320' ;
            $results = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
            $results = $results->first();
            if (!empty($results)) {
            
                if ($results) {
                    $this->Users->updateAll(array('fb_id' => $this->request->data['fb_id'],'image'=>$imgurl), array('id' => $results['id']));
                  
              
                    $this->Auth->setUser($results);
                    $usedata = $this->Users->find('all',['conditions'=>['Users.id'=>$results['id']]]);
                    $usedata = $usedata->first();
                    $usedata['image_path']="";
                    $response['status'] = true;
                    $response['data'] = $usedata;
                    $response['msg'] = 'Logged in successfully.';
                } else {
                    $response['status'] = false;
                    $response['data'] = '';
                    $response['msg'] = 'Error In Signing In. Please Try Again.';
       
                }
            } else {
                $post = array();
                $post['fb_id'] = $this->request->data['fb_id'];
                $post['name'] = $this->request->data['name'];
                $post['email'] = $this->request->data['email'];
                $post['image'] = $imgurl; 
                $post['password'] = 'zxswedcxswzrrr';
                $post['status'] = '1';
                $post['role'] = 'user'; 
                $user = $this->Users->newEntity();
                $user = $this->Users->patchEntity($user, $post);
                $new_user = $this->Users->save($user);
                
                if ($new_user) {
                   
                    $this->request->data['username'] = $this->request->data['username'];
                    $this->request->data['password'] = 'zxswedcxswzrrr';
                  
                    $user2 = $this->Auth->identify();
                    if ($user2) {
                        $this->Auth->setUser($user2);     
                        $response['status'] = true;
                        $response['data'] = $user2;
                        $response['msg'] = 'Logged in successfully.';
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Error In Signing In. Please Try Again.';
                    }
                }
            }
        }
        echo json_encode($response);
        exit;
    }
	

    public function pushnotification()
    { 
         $response = array(); 
         if ($this->request->is('post')) { 
          $user_id = $this->request->data['user_id']; 
          if(!empty($user_id)){
          $userdata = $this->Users->find('all',['contain'=>[],'conditions'=>['Users.id'=>$user_id]]);
          $userdata = $userdata->first();
         if($userdata){ 
         if($userdata['device_token']){  
            $status = '';
            if(($userdata['status'] == 1)){
                $status = 'Yours account has been activated';
            }else{
                $status = 'Yours profile has been deactivated.Please contact admin.';
            }  
            $send = $this->SendPushNotificationsAndroid($userdata['device_token'],'Test','This is test push notification.',$status);
           if($send){
             $response['msg'] = "Successfully send notification."; 
             $response['status'] = true;
           }else{
             $response['msg'] = "something worng.";
             $response['status'] = false;
           } 
          }else{
            $response['msg'] = "Device token required.";
            $response['status'] = false;   
          } 
         }else{
             $response['msg'] = "Invalid user";
             $response['status'] = false; 
         }  
        }else{
             $response['msg'] = "User id required";
             $response['status'] = false; 
        } 
       }
         echo json_encode($response);
         exit;
    }

    public function getnotification()
    {
        $this->loadModel('Notifications');
        $notification = $this->Notifications->find('all', [
        'conditions'=>['Notifications.receiver_id' => $this->request->data['receiver_id']]
        ])->all();
        if($notification){
        $response['data']= $notification;
        $response['status']= true;
        }else{
        $response['msg']='No data found.';
        $response['status']= false; 
        }
      echo json_encode($response);
      exit;
    }


   public function introductorydata()
    {
      
        $response = array();
        $this->loadModel('Introductories');
        $introdata =$this->Introductories->find('all')->toArray();
        $data=array();
        foreach ($introdata as $dataval) 
        {
            $data[] =array(
                'id'=>$dataval['id'],
                'title'=>$dataval['title'],
                'image'=> Router::url('/',true).'images/introductoryimages/'.$dataval['image'],
                'description'=>$dataval['description'],
            );
        }


        if($introdata){
            $response['data'] = $data;
            $response['status'] = true;
        }else{
            $response['data'] ='';
            $response['status'] = false;
        }
        echo json_encode($response);
        exit;
    }


    public function subscriptions()
    {

       $response = array();
        $this->loadModel('Subscriptions');
        $sub_plains =$this->Subscriptions->find('all')->toArray();
        $data=array();
        foreach ($sub_plains as $dataval) 
        {
            $data[] =array(
                'id'=>$dataval['id'],
                'title'=>$dataval['title'],
                'price'=> $dataval['price'],
                'description'=>$dataval['description'],
            );
        }


        if($sub_plains)
        {
            $response['data'] = $data;
            $response['status'] = true;
        }
        else{
            $response['data'] ='';
            $response['status'] = false;
        }
        echo json_encode($response);
        exit;

    }

    public function programs()
    {
        $this->loadModel('Programs');
        $this->loadModel('Videos');

            $programs = $this->Programs
            ->find('all')
             ->select('Programs.id')
             ->select('Programs.title')
             ->select('Programs.description')
             ->select('Programs.thumbnail')
             ->select('Programs.featured_video')
             ->select('Programs.subscription')
             ->select('Styles.id')
             ->select('Styles.style')
             ->select('Instructors.id')
             ->select('Instructors.name')
            ->contain(['Videos'])
            ->contain(['Styles'])
            ->contain(['Instructors'])
            ->toArray(); 

        

         if(!empty($programs))
        {
             foreach ($programs as $program_val)
            {
               
                $program_val['thumbnail'] = Router::url('/',true).'images/introductoryimages/'.$program_val['thumbnail'];
                $program_val['featured_video'] = Router::url('/',true).'images/introductoryimages/'.$program_val['featured_video'];
                  $program_val['videos'] = $this->pro_video($program_val);
               
            }
            if($programs){
                $response['data'] = $programs;

                $response['status'] = true;
            }else{
                $response['data'] ='';
                $response['status'] = false;
            }
        }
        else
        {
                 $response['data'] ='No program found';
                $response['status'] = false;
        }

    
        echo json_encode($response);
        exit;

 }


 public function addcard()
 {

    $this->loadModel('Card');
        $response = array();
        $card = $this->Card->newEntity();
        if ($this->request->is('post')) {
            if (empty($this->request->data['user_id'])) {
                $response['status'] = false;
                $response['msg'] = "User id required";
            } elseif (empty($this->request->data['card_number'])) {
                $response['status'] = false;
                $response['msg'] = "card number required";
            }  elseif (empty($this->request->data['holder_name'])) {
                $response['status'] = false;
                $response['msg'] = "holder name required";
            }  elseif (empty($this->request->data['expiry_date'])) {
                $response['status'] = false;
                $response['msg'] = "expiry date required";
            } else {
                $card_check = $this->Card->find('all', ['conditions' => ['Card.card_number' => $this->request->data['card_number']]]);
                $card_check = $card_check->first();

                if (!empty($card_check)) {
                    $response['status'] = false;
                    $response['msg'] = "This card number already exists.";
                }  else {
                    $post = $this->request->getData();
                         $card = $this->Card->patchEntity($card, $post);
                        $new_card = $this->Card->save($card);

                        if ($new_card)
                        {
                            $response['status'] = true;
                            $response['msg'] = "Card has been saved successfully.";
                            $response['data'] = $new_card;
                        } else 
                       {
                            $response['status'] = false;
                            $response['msg'] = "The Card could not be saved. Please, try again.";
                        }
                    

                }
            }
        }
        echo json_encode($response);
        exit;
    }



    public function filterprograms()
    {


        $this->loadModel('Programs');
        $this->loadModel('Videos');
        $this->loadModel('Programsrating');

		if ($this->request->is('post')) {

			if (empty($this->request->data['instructor_id'])) {
                $response['status'] = false;
                $response['msg'] = "Instructor id required";
            }  elseif (empty($this->request->data['rating'])) {
                $response['status'] = false;
                $response['msg'] = "Rating is required";
            } else{

       				$ids = explode(",", $this->request->data['instructor_id']);
       				$programs = $this->Programs
                    ->find('all',['conditions' => ['Programs.instructor_id IN' => $ids,'Programs.avg_rating >=' => $this->request->data['rating']]])
                     ->select('Programs.id')
                     ->select('Programs.title')
                     ->select('Programs.description')
                     ->select('Programs.thumbnail')
                     ->select('Programs.featured_video')
                     ->select('Programs.subscription')
                     ->select('Programs.avg_rating')
                     ->select('Styles.id')
                     ->select('Styles.style')
                     ->select('Instructors.id')
                     ->select('Instructors.name')
                    ->contain(['Videos'])
                    ->contain(['Styles'])
                    ->contain(['Instructors'])
                    ->toArray(); 

                }
		       


		        if(!empty($programs))
		        {
		                 foreach ($programs as $program_val)
		                {
		                   
		                    $program_val['thumbnail'] = Router::url('/',true).'images/introductoryimages/'.$program_val['thumbnail'];
		                    $program_val['featured_video'] = Router::url('/',true).'images/introductoryimages/'.$program_val['featured_video'];
		                      $program_val['videos'] = $this->pro_video($program_val);
		                   
		                }
		                if($programs)
		                {
		                    $response['data'] = $programs;

		                    $response['status'] = true;
		                }else
		                {
		                    $response['data'] ='';
		                    $response['status'] = false;
		                }
		            }
		            else
		            {
		                     $response['data'] ='No program found';
		                    $response['status'] = false;
		            }

		        echo json_encode($response);
		        exit;

			}



	}


public function joinnow()
{

	 $this->loadModel('Subscribedprograms');
        $response = array();
        $plain = $this->Subscribedprograms->newEntity();
        if ($this->request->is('post')) {
            if (empty($this->request->data['user_id'])) {
                $response['status'] = false;
                $response['msg'] = "User id required";
            }  elseif (empty($this->request->data['program_id'])) {
                $response['status'] = false;
                $response['msg'] = "Program id required";
            } else {
                
                $plain_check = $this->Subscribedprograms->find('all', [
                	'conditions' => 
                	['Subscribedprograms.user_id' => $this->request->data['user_id'],
                	'Subscribedprograms.program_id' => $this->request->data['program_id']
                ]
            ]);
                $plain_check = $plain_check->first();



                if (!empty($plain_check)) {
                    $response['status'] = false;
                    $response['msg'] = "This subscription is already taken by this user.";
                }  else {
                    	$post = $this->request->getData();
                    	$plain = $this->Subscribedprograms->patchEntity($plain, $post);
                        $new_plain = $this->Subscribedprograms->save($plain);

                        if ($new_plain)
                        {
                            $response['status'] = true;
                            $response['msg'] = "Program has been subscribed  successfully.";
                            $response['data'] = $new_plain;
                        } else 
                       {
                            $response['status'] = false;
                            $response['msg'] = "The program could not be subscribed. Please, try again.";
                        }
                    

                }
                    

                }
            
        }
        echo json_encode($response);
        exit;

}

public function uploadvideobyuser()
{
		$this->loadModel('Subscribedprograms');

        $response = array();
        // $plain = $this->Subscribedprograms->newEntity();
        
        $post = $this->request->data; 
        if ($this->request->is('post')) 
        {	
			// print_r($this->request->data['uploaded_video']);
			// exit;
			if(empty($this->request->data['user_id'])) {
                $response['status'] = false;
                $response['msg'] = "User id required";
            }elseif (empty($this->request->data['program_id'])) {
                $response['status'] = false;
                $response['msg'] = "Program id required";
            }elseif (empty($this->request->data['video_id'])) {
                $response['status'] = false;
                $response['msg'] = "Video id required";
            }elseif (empty($this->request->data['uploaded_video']))
             {
                $response['status'] = false;
                $response['msg'] = "Video is required";
            }  
            else 
            {

           		 $user = $this->Subscribedprograms->find('all', [
            				'conditions'=>['Subscribedprograms.user_id'=>$this->request->data['user_id'],'Subscribedprograms.program_id'=>$this->request->data['program_id']]
            			]);
				$user = $user->first();
            		

		            if(!empty($this->request->data['uploaded_video']))
		             {	
		             		if($user->uploaded_video != ''){
								unlink(WWW_ROOT.'images/uservideo/'.$user->uploaded_video);
							}

		             	 $image = $this->request->data['uploaded_video'];
			             $uniquename = time().uniqid(rand()).'.mp4';
			             $upload_path = WWW_ROOT . 'images/uservideo/' . $uniquename;
			          
			             $userimage = base64_decode($post['uploaded_video']['name']);
			             $success = file_put_contents($upload_path, $userimage);
			             $uniquename = $uniquename;
			             $post['uploaded_video']= $uniquename;     
		             }
		             $post['status'] =0;
             		// $post['image_path'] = Router::url('/',true).'images/uservideo/';
                    $plain = $this->Subscribedprograms->patchEntity($user, $post);
                    $video_uploaded = $this->Subscribedprograms->save($plain);

                    if ($video_uploaded)
                    {
                            $response['status'] = true;
                            $response['msg'] = "Video has been uploaded successfully.";
                            $response['data'] = $video_uploaded;
                    } 
                    else 
                    {
                            $response['status'] = false;
                            $response['msg'] = "Video could not be uploaded. Please, try again.";
                    }
            }
            
        }
        echo json_encode($response);
        exit;
}


public function getprogrambyuser()
{

		$this->loadModel('Programs');
		$this->loadModel('Subscribedprograms');
        $this->loadModel('Videos');

        $programs = $this->Subscribedprograms->find('all', [
            'conditions' => ['Subscribedprograms.user_id' => $this->request->data['user_id'],'Subscribedprograms.program_id' => $this->request->data['program_id']],
            'contain' => ['Programs'=>['Videos','Styles']]]);
		$programs = $programs->toArray();



		if(!empty($programs))
        {
             foreach ($programs as $program_val)
            {
                $program_val['program']['thumbnail'] = Router::url('/',true).'images/introductoryimages/'.$program_val['program']['thumbnail'];
                $program_val['program']['featured_video'] = Router::url('/',true).'images/introductoryimages/'.$program_val['program']['featured_video'];
                  $program_val['program']['videos'] = $this->pro_video($program_val['program']);
               
            }
            
            if($programs){
                $response['data'] = $programs;

                $response['status'] = true;
            }else{
                $response['data'] ='';
                $response['status'] = false;
            }
        }
        else
        {
                 $response['data'] ='No program found';
                $response['status'] = false;
        }

    
        echo json_encode($response);
        exit;
}

}