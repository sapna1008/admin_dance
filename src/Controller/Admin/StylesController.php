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
use Cake\Controller\Component\FlashComponent;



/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */

class StylesController extends AppController

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
	
// 	    DANCE CATEGORY SECTION


public function index()
{
    	$this->loadModel('Styles');	
  		$styles = $this->Styles->find('all');

		$styles = $styles->all()->toArray();

		$this->set('styles', $styles);

		$this->set('_serialize', ['styles']);

}

// add dance style

public function add()
    {
    		
        $user = $this->Styles->newEntity();

         if($this->request->is(['patch', 'post', 'put']))
          {


				$post = $this->request->data;
				if($this->request->data['thumbnail']['name'] != '')
        	{
				$styles1 = $this->request->data['thumbnail'];
				$name1 = time().$styles1['name'];
				$tmp_name = $styles1['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name1;
				move_uploaded_file($tmp_name, $upload_path);
				$post['thumbnail'] = $name1;
			}

			// if($this->request->data['video']['name'] != '')
   //      	{
			// 	$styles = $this->request->data['video'];
			// 	$name = time().$styles['name'];
			// 	$tmp_name = $styles['tmp_name'];
			// 	$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
			// 	move_uploaded_file($tmp_name, $upload_path);
			// 	$post['video'] = $name;
			// }	
				

            $user = $this->Styles->patchEntity($user, $post);
            if ($this->Styles->save($user)) {

                $this->Flash->success(__('The style form has been saved.'));
            }
            else
            {
            	$this->Flash->error(__('The style form could not be saved. Please, try again.'));


            }
             return $this->redirect(['action' => 'index']);

				

        }
        $this->set(compact('user'));
    }


// delete category method


public function delete($id = null)

    {      
         $this->loadModel('Styles');
        $style = $this->Styles->get($id);
        if ($this->Styles->delete($style)) {
            $this->Flash->success(__('The style form has been deleted.'));
        } else {
            $this->Flash->error(__('The style form could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

	}

	public function edit($id = null)
	{
		 $baseurl = Router::url('/', true);

        $styles = $this->Styles->get($id, [

            'contain' => []

        ]);
       
       if ($this->request->is(['patch', 'post', 'put'])) {
			

			$post = $this->request->data;


			if($this->request->data['thumbnail']['name'] != ''){
					
				if($styles->image != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$styles->thumbnail);
				}	
			
				$styles1 = $this->request->data['thumbnail'];
				$name1 = time().$styles1['name'];
				$tmp_name = $styles1['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name1;
				move_uploaded_file($tmp_name, $upload_path);
				$post['thumbnail'] = $name1;
			
			}
			else
			{
				unset($this->request->data['thumbnail']);
				$post = $this->request->data;
			}


			// if($this->request->data['video']['name'] != ''){
					
			// 	if($styles->image != ''){
			// 		unlink(WWW_ROOT.'images/introductoryimages/'.$styles->video);
			// 	}	
			
			// 	$styles1 = $this->request->data['video'];
			// 	$name1 = time().$styles1['name'];
			// 	$tmp_name = $styles1['tmp_name'];
			// 	$upload_path = WWW_ROOT.'images/introductoryimages/'.$name1;
			// 	move_uploaded_file($tmp_name, $upload_path);
			// 	$post['video'] = $name1;
			
			// }
			// else
			// {
			// 	unset($this->request->data['video']);
			// 	$post = $this->request->data;
			// }

		

            $styles = $this->Styles->patchEntity($styles, $post);

            if($this->Styles->save($styles)) 
            {

                $this->Flash->success(__('The style form has been saved.'));
				return $this->redirect(['action' => 'index']);

            }
            else{

	            $this->Flash->error(__('The style could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('styles'));
        $this->set('_serialize', ['styles']);
	}

}

