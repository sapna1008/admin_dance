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

class ProgramsController extends AppController

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
    	$this->loadModel('Programs');	
  		$programs = $this->Programs->find('all');

		$programs = $programs->all()->toArray();

		$this->set('programs', $programs);

		$this->set('_serialize', ['programs']);

}


public function view($id = null)

    {
        $programs = $this->Programs->get($id, [

            'contain' => ['Videos']  

        ]); 

        // echo '<pre>';
        // print_r($programs);
        // exit;
        $this->set('programs', $programs);
        $this->set('_serialize', ['programs']);

	}

// add dance style

public function add()
    {
    	$this->loadModel('Instructors');
    		$instructors = $this->Instructors->find('list'
		);


		$instructors = $instructors->all()->toArray();
		$this->set('instructors', $instructors);
        $user = $this->Programs->newEntity();

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

			if($this->request->data['featured_video']['name'] != '')
        	{
				$styles = $this->request->data['featured_video'];
				$name = time().$styles['name'];
				$tmp_name = $styles['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				$post['featured_video'] = $name;
			}	
				

            $user = $this->Programs->patchEntity($user, $post);
            if ($this->Programs->save($user)) {

                $this->Flash->success(__('The program form has been saved.'));
            }
            else
            {
            	$this->Flash->error(__('The program form could not be saved. Please, try again.'));


            }
             return $this->redirect(['action' => 'index']);

				

        }
        $this->set(compact('user'));
    }


// delete category method


public function delete($id = null)

    {      
         $this->loadModel('Programs');
        $programs = $this->Programs->get($id);
        if ($this->Programs->delete($programs)) {
            $this->Flash->success(__('The program form has been deleted.'));
        } else {
            $this->Flash->error(__('The program form could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

	}

	public function edit($id = null)
	{
		 $baseurl = Router::url('/', true);
	
        $programs = $this->Programs->get($id, [

            'contain' => []

        ]);	

         $prog=  $this->StyleName($programs->style_id);

	     $programs['style_id'] = array('id'=>$programs->style_id,'name'=>$prog);


       
       $this->loadModel('Instructors');
    		$instructors = $this->Instructors->find('list'
		);





		$instructors = $instructors->all()->toArray();
		$this->set('instructors', $instructors);

       if ($this->request->is(['patch', 'post', 'put'])) {
			

			$post = $this->request->data;


			if($this->request->data['thumbnail']['name'] != '')
			{
					
				if($programs->image != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$programs->thumbnail);
				}	
			
				$styles = $this->request->data['thumbnail'];
				$name = time().$styles['name'];
				$tmp_name = $styles['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				$post['thumbnail'] = $name;
			
			}
			else
			{
				unset($this->request->data['thumbnail']);
				$post = $this->request->data;
			}


			if($this->request->data['featured_video']['name'] != ''){
					
				if($programs->image != ''){
					unlink(WWW_ROOT.'images/introductoryimages/'.$programs->featured_video);
				}	
			
				$styles1 = $this->request->data['featured_video'];
				$name1 = time().$styles1['name'];
				$tmp_name = $styles1['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name1;
				move_uploaded_file($tmp_name, $upload_path);
				$post['featured_video'] = $name1;
			
			}
			else
			{
				unset($this->request->data['featured_video']);
				$post = $this->request->data;
			}

		

            $programs = $this->Programs->patchEntity($programs, $post);

            if($this->Programs->save($programs)) 
            {

                $this->Flash->success(__('The program form has been saved.'));
				return $this->redirect(['action' => 'index']);

            }
            else{

	            $this->Flash->error(__('The program could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('programs'));
        $this->set('_serialize', ['programs']);
	}

	public function getStyles($id = null)
	{
		$this->loadModel('Instructors');
		// $query = $this->Instructors->get($this->request->data['id']);
		$query = $this->Instructors->get($this->request->data['id'],[
			 'contain' => ['Instructorstyles']

		]);

		
		// $st_ids =explode(",", $query->styles);

		$html ="";
		foreach ($query['instructorstyles'] as $val) {
			$html .= '<option value="'.$val['style_id'].'">'.$this->StyleName($val['style_id']).'</option>';
		}


		print_r($html);
		die();
	}




}

