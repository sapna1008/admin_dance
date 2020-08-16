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

class IntroductoriesController extends AppController

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


	public function index()

    {
    	$introductoryimage = $this->Introductories->find('all');

    	
		$introductoryimage = $introductoryimage->toArray();




		$this->set('introductoryimage', $introductoryimage);
       
		$this->set('_serialize', ['introductoryimage']);

         $baseurl = Router::url('/', true);

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;
			
			if($this->request->data['image1']['name'] != ''){
					
			if($introductoryimage['image1'] != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$introductoryimage->image1);
				}
			
				$image1 = $this->request->data['image1'];
				$name = time().$image1['name'];
				$tmp_name = $image1['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image1'] = $name;
			
			}else{
			    
			 $post['image1'] = 	$introductoryimage['image1'];
		
			}    

		
			    if($this->request->data['image2']['name'] != ''){
						if($introductoryimage['image2'] != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$introductoryimage->image2);
				}
	
				$image2 = $this->request->data['image2'];
				$name = time().$image2['name'];
				$tmp_name = $image2['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image2'] = $name;
			
			}else{
		
				$post['image2'] = 	$introductoryimage['image2'];
			}
		
			
		
			 if($this->request->data['image3']['name'] != ''){
					
				if($introductoryimage['image3'] != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$introductoryimage->image3);
				}
			
				$image3 = $this->request->data['image3'];
				$name = time().$image3['name'];
				$tmp_name = $image3['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image3'] = $name;
			
			}else{
					$post['image3'] = $introductoryimage['image3'];
			}   

            $introductoryimage = $this->Introductories->patchEntity($introductoryimage, $post);

            if ($this->Introductories->save($introductoryimage)) {

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('introductoryimage'));
        $this->set('_serialize', ['introductoryimage']);
    }
    
    
	public function logout() {

        if ($this->Auth->logout()) {

            return $this->redirect(['action' => 'login']);

        }

	}
	
	public function add()
    {
        $user = $this->Introductories->newEntity();


          if ($this->request->is(['patch', 'post', 'put'])) {

       
		if ($this->request->is('post')) {

			$post = $this->request->data;

			 if($this->request->data['image']['name'] != '')
        	{
        		$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image'] = $name;
			
			}

			
        	$user = $this->Introductories->patchEntity($user, $post);
            if ($this->Introductories->save($user)) {
                $this->Flash->success(__('The screen has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The screen could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
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

        $user = $this->Introductories->get($id, [

            'contain' => []

        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;

			if($this->request->data['image']['name'] != ''){
					
				if($user->image != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$user->image);
				}	
			
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image'] = $name;
			
			}else{
				unset($this->request->data['image']);
				$post = $this->request->data;
			}

            $user = $this->Introductories->patchEntity($user, $post);

            if ($this->Introductories->save($user)) {

                $this->Flash->success(__('The screen has been saved.'));

                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The screen could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

	}
}

