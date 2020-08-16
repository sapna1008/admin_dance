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

class SubscriptionsController extends AppController

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
    	$introductoryimage = $this->Subscriptions->find('all');

    	
		$introductoryimage = $introductoryimage->toArray();

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
        $user = $this->Subscriptions->newEntity();


          if ($this->request->is(['patch', 'post', 'put'])) {

       
		if ($this->request->is('post')) {

			$post = $this->request->data;


			
        	$user = $this->Subscriptions->patchEntity($user, $post);
            if ($this->Subscriptions->save($user)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
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

        $user = $this->Subscriptions->get($id, [

            'contain' => []

        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
			
			     $post = $this->request->data;

            $user = $this->Subscriptions->patchEntity($user, $post);

            if ($this->Subscriptions->save($user)) {

                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

	}
}

