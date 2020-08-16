<?php

namespace App\Controller\Admin;



use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\ORM\Entity;
//use Cake\Datasource\EntityInterface;
use Cake\Error\Debugger;


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
        if ($this->request->getParam('prefix') == 'admin') {
            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
              $this->logout();   
              //  $this->viewBuilder()->setLayout('admin');
            }
        }   
        $this->Auth->allow(['logout']);
        $this->authcontent();

    }




    /**

     * Index method

     *

     * @return \Cake\Http\Response|void

     */

    public function login()

    {

		if($this->Auth->user('role') == 'admin'){

			return $this->redirect(['action' => 'index']);
		}

		$this->viewBuilder()->setLayout('admin2');

		

		if ($this->request->is('post')) {

			if(!filter_var($this->request->getData()['username'], FILTER_VALIDATE_EMAIL)===false){

				$this->Auth->setConfig('authenticate', [

					'Form'=>['fields'=>['username'=>'email', 'password'=>'password']]

				]);

				$this->Auth->constructAuthenticate();
                $this->request->data['email'] = $this->request->getData()['username'];
				unset($this->request->getData()['username']);

			}
			$user = $this->Auth->identify();

			if ($user) {

				$this->Auth->setUser($user);

				

				if($this->Auth->user('role') != 'admin'){

					$this->logout();

					$this->Flash->error(__('Invalid Username or Password, try again'));

				}else{				
                    return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);    
			   		//return $this->redirect($this->Auth->redirectUrl());

				}	

			}else{

				$this->Flash->error(__('Invalid Username or Password, try again'));

			}

        }
       $this->set('title_for_layout', 'Admin Login'); 
    }

	

	public function index()

    {


  	$users = $this->Users->find()->where(['Users.role =' => 'user'])
    ->order(['Users.id' => 'DESC']);

		$users = $users->all()->toArray();

		 

		$this->set('users', $users);

		$this->set('_serialize', ['users']);

    }
    
    
	public function logout() {

        if ($this->Auth->logout()) {

            return $this->redirect(['action' => 'login']);

        }

	}




	public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);

                
            }
            else
            {
            	$this->Flash->error(__('The user could not be saved. Please, try again.'));
            	return $this->redirect(['action' => 'index']);

            }
        }
        $this->set(compact('user'));
    }







	
	public function view($id = null)

    {
        $user = $this->Users->get($id, [

            'contain' => []  

        ]); 


        $this->set('user', $user);
        $this->set('_serialize', ['user']);

	}
	

	/**

     * Edit method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.

     * @throws \Cake\Network\Exception\NotFoundException When record not found.

     */

public function edit($id = null)

    {

         $baseurl = Router::url('/', true);

        $user = $this->Users->get($id, [

            'contain' => []

        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;

			if($this->request->data['image']['name'] != ''){
					
				if($user->image != ''){
					unlink(WWW_ROOT.'images/users/'.$user->image);
				}	
			
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/users/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}


            $user = $this->Users->patchEntity($user, $post);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'));



                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

	}
	


	//  change Password
	
	public function changepassword($id = null){
		$user = $this->Users->get($id, [
            'contain' => []
        ]);




        if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			
			if ($this->Users->save($user)) {

				$title ="You password has been changed";
				$type= "password_changed";
				$body="Your password is changed.";
		 		$not_res =$this->SendPushNotificationsAndroid($user->device_token,$title,$body);    // push notification to user

				$this->Flash->success(__('Your password has been changed'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->success(__('Invalid Password, try again'));
				return $this->redirect(['action' => 'index']);
			}
		}
		
		$this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}


	/**   Delete method */

    public function delete($id = null)

    {      
     
        $user = $this->Users->get($id);

        $user_data = $this->Users->get($id, [

            'contain' => []

        ]);



        if ($this->Users->delete($user)) {

        		$title ="You are deleted";
				$type= "user_deleted";
				$body="You are deleted by admin ,to avail further services please contact.";
		 		$not_res =$this->SendPushNotificationsAndroid($user_data->device_token, $title,$body);    // push notification to user

            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

	}
	
	/** enable user */

	public function enable($id = null) {
		$user = $this->Users->get($id);
		$post['status'] = 1;

		$user = $this->Users->patchEntity($user, $post);
		if ($this->Users->save($user)) {
			$this->Flash->success(__('Activated successfully.'));
		} else {
			$this->Flash->error(__('Unable to activate.'));
		}
		return $this->redirect(['action' => 'index']);
	 }
	 
	 /** disable user */
	 public function desable($id = null) {
		$user = $this->Users->get($id);
		$post['status'] = 0;

		$user_data = $this->Users->get($id, [

            'contain' => []

        ]);

		
		$user = $this->Users->patchEntity($user, $post);

	   if ($this->Users->save($user)) {

			   	$title ="You are blocked";
				$type= "user_blocked";
				$body="You are blocked by admin ,to avail further services please contact.";
		 		$not_res =$this->SendPushNotificationsAndroid($user_data->device_token,$title,$body);    // push notification to user

		 	$this->Flash->success(__('Deactivated successfully.'));
      } 
      else 
      {  
		   $this->Flash->error(__('Unable to Deactivated.'));
	   }
	   return $this->redirect(['action' => 'index']);
   }



}
