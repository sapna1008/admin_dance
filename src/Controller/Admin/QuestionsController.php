<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[] paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{

    
    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
              $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }
        }
        $this->Auth->allow(['slugify','index']); 

        $this->authcontent();

    } 
    
    
    
     private function slugify($str) {  
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     } 
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Questions->get($id, [
            'contain' => []
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity(); 
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('Question has been created.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be created. Please, try again.'));
        }
        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $post = $this->request->data; 
            $question = $this->Questions->patchEntity($question, $post);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);

        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The Questions has been deleted.'));
        } else {
            $this->Flash->error(__('The Questions could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }  
}
