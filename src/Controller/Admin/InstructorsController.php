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


class InstructorsController extends AppController

{


    public function beforeFilter(Event $event)
    {
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

		//$users = $this->Users->find('all');		

  		$instructors = $this->Instructors->find('all', [
			'order' => ['Instructors.id' => 'desc'],
			//'contain'=>['Usertones']
		]);

		$instructors = $instructors->all()->toArray();

		$this->set('instructors', $instructors);

		$this->set('_serialize', ['instructors']);

    }
    

	
	public function view($id = null)
	{
        $instructor = $this->Instructors->get($id, [

            'contain' => []  

        ]); 

        $this->set('instructor', $instructor);
        $this->set('_serialize', ['instructor']);

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

		$this->loadModel('Styles');
		$this->loadModel('Instructorstyles');
        $baseurl = Router::url('/', true);

        $instructor = $this->Instructors->get($id, [

            'contain' => ['Instructorstyles'=>['Styles']]

        ]);


		$styles =$this->Styles->find('all')->select(['id', 'style'])->toArray();

		// echo '<pre>';
		// print_r($instructor);
		// exit;


        if ($this->request->is(['patch', 'post', 'put'])) 
        {

			$post = $this->request->data;
			if($this->request->data['image']['name'] != '')
			{
					
				// if($instructor->image != ''){
				// 	unlink(WWW_ROOT.'images/introductoryimages/'.$instructor->image);
				// }	
			
				$image = $this->request->data['image'];
				$name = time().$image['name'];
				$tmp_name = $image['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['image'] = $name;
			
			}
			else
			{
				$post['image'] = $instructor->image;
			}
			
			
		
		
			$instructor = $this->Instructors->patchEntity($instructor, $post);

			$savedata = $this->Instructors->save($instructor);
			

            if($savedata) 
            {

            		if(!empty($this->request->data['style_id']))
            		{
            			$posst =array();
            			foreach ($this->request->data['style_id'] as $key => $value) 
            			{

								$posst[] = ['instructor_id'=>$savedata->id,'style_id'=>$value];
			            	

            				
            			}

            			// delete data from table 
							$result = $this->Instructorstyles->deleteAll(['Instructorstyles.instructor_id'=>$savedata->id],false);
							$entities = $this->Instructorstyles->newEntities($posst);
							$result   = $this->Instructorstyles->saveMany($entities);
						


            		}

            	

                $this->Flash->success(__('The instructor has been saved.'));
				return $this->redirect(['action' => 'index']);

            }
            else
            {

	            $this->Flash->error(__('The instructor could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('instructor','styles'));
        $this->set('_serialize', ['instructor','styles']);

	}


// 	 public function add($id = null)

//     {

//          $baseurl = Router::url('/', true);

//         $instructor = $this->Instructors->get($id, [

//             'contain' => []

//         ]);

// }

// 	/**   Delete method */

//     public function delete($id = null)

//     {      
     
//         $instructor = $this->Instructors->get($id);
//         if ($this->Instructors->delete($instructor)) {
//             $this->Flash->success(__('The user has been deleted.'));
//         } else {
//             $this->Flash->error(__('The user could not be deleted. Please, try again.'));
//         }
//         return $this->redirect(['action' => 'index']);

// 	}
	






}

