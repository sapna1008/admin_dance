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

class VideosController extends AppController

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

	
// 	video method


public function index()
{
    	$this->loadModel('Videos');	
    	$this->loadModel('Instructors');	
    	$this->loadModel('Programs');	
    	$this->loadModel('Styles');	
  		$videos = $this->Videos->find('all',
  		['contain'=>['Instructors','Programs','Styles']
  	
		]);

		$videos = $videos->all()->toArray();



		$this->set('videos', $videos);

		$this->set('_serialize', ['videos']);

}


// add video method
	
public function add()
{
    $this->loadModel('Videos');
    $this->loadModel('Instructors');
    $this->loadModel('Programs');
    $count = range(2,10);
    $this->set('count', $count);
    $video = $this->Videos->newEntity();
   
  		$instructors = $this->Instructors->find('list'
		);


		$instructors = $instructors->all()->toArray();
		$this->set('instructors', $instructors);

		
  		$data = $this->Videos->find('all');
		$data = $data->all()->toArray();
		$this->set('data', $data);
		$this->set('_serialize', ['data']);
	
        
        if ($this->request->is(['patch', 'post', 'put']))
        {

            	$post = $this->request->data;
				$videos = $this->request->data['video'];
				$name = time().$videos['name'];
				$tmp_name = $videos['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['video'] = $name;
				
			   $query = $this->Videos->find('all', [
                    'conditions' => ['Videos.level' => $post['level'],'Videos.count' => $post['count'],'Videos.program_id'=>$post['program_id']]
                ]);
                $query = $query->first();



                if(empty($query))
                {


                       $video = $this->Videos->patchEntity($video, $post);

			            if ($this->Videos->save($video)) {
			                       
			                $this->Flash->success(__('The video has been saved.'));

			                return $this->redirect(['action' => 'index']);

			            }
			            else{

				            $this->Flash->error(__('The video could not be saved. Please, try again.'));
						}
			    }
                else{
                    
                    $this->Flash->error(__('Already exist at this count'));
                }
			    
				// $video = $this->request->data['video'];
				// $name = time().$video['name'];
				// $tmp_name = $video['tmp_name'];
				// $upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				// move_uploaded_file($tmp_name, $upload_path);
				
				// $post['video'] = $name;


         
        }

}

// delete video method
public function delete($id = null)

    {      
         $this->loadModel('Videos');
        $video = $this->Videos->get($id);
        if ($this->Videos->delete($video)) {
            $this->Flash->success(__('The video has been deleted.'));
        } else {
            $this->Flash->error(__('The video could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

	}
	
	
// 	edit video method
	
	
	public function edit($id = null)
	{
	    $this->loadModel('Videos');
	    $this->loadModel('Instructors');
	    $this->loadModel('Programs');
	     $video = $this->Videos->get($id, [

            'contain' => []

        ]);

	     $video_style =  $this->StyleName($video->style_id);
	     $video['style_id'] = array('id'=>$video->style_id,'name'=>$video_style);

	     $video_program =  $this->ProgramName($video->program_id);
	     $video['program_id'] = array('id'=>$video->program_id,'name'=>$video_program);




        $count = range(2,10);
        $this->set('count', $count);

	    $baseurl = Router::url('/', true);
	    
	   	$instructors = $this->Instructors->find('list');
		$instructors = $instructors->all()->toArray();


 		$programs = $this->Programs->find('list');
		$programs = $programs->all()->toArray();

		$this->set('instructors', $instructors);
		$this->set('programs', $programs);
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;

			if($this->request->data['video']['name'] != ''){
				// if($video->video != ''){
				// 	unlink(WWW_ROOT.'images/introductoryimages/'.$video->video);
				// }	
			
				$videos = $this->request->data['video'];
				$name = time().$videos['name'];
				$tmp_name = $videos['tmp_name'];
				$upload_path = WWW_ROOT.'images/introductoryimages/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				
				$post['video'] = $name;
			
			}
			else
			{
				unset($this->request->data['video']);
				$post = $this->request->data;

			}

            $video = $this->Videos->patchEntity($video, $post);

            if ($this->Videos->save($video)) {

                $this->Flash->success(__('The video has been saved.'));



                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The video could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('video'));
        $this->set('_serialize', ['video']);
	}


	public function getStyles($id = null)
	{
		$this->loadModel('Instructors');
		$this->loadModel('Programs');
		// $query = $this->Programs->get($this->request->data['id'])->toArray();
		$query = $this->Programs
          ->find('all', [
        'conditions'=>['Programs.instructor_id' => $this->request->data['id']]
        ])->all()->toArray(); 


		$html ="";
			$html ='<option>Choose Program</option>';
		foreach ($query as $val) {
			$html .= '<option value="'.$val['id'].'">'.$this->ProgramName($val['id']).'</option>';
		}


		print_r($html);
		die();
	}
	

	public function getstylepro($id = null)
	{
		$this->loadModel('Instructors');
		$this->loadModel('Programs');
		$query = $this->Programs
          ->find('all', [
        'conditions'=>['Programs.instructor_id' => $this->request->data['id'],'Programs.id'=>$this->request->data['pro_id']]
        ])->all()->toArray(); 

		$html ="";
		$html ='<option>Choose Style</option>';
		foreach ($query as $val) {
			$html .= '<option value="'.$val['style_id'].'">'.$this->StyleName($val['style_id']).'</option>';
		}


		print_r($html);
		die();
	}



}

