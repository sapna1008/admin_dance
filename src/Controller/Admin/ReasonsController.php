<?php
namespace App\Controller\Admin;     

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  

/**
 * Reasons Controller
 *
 * @property \App\Model\Table\QuestionsTable $Reasons
 *
 * @method \App\Model\Entity\Question[] paginate($object = null, array $settings = [])
 */
class ReasonsController extends AppController
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
        $reasons = $this->paginate($this->Reasons);

        $this->set(compact('reasons'));
        $this->set('_serialize', ['reasons']);
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
        $category = $this->Reasons->get($id, [
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
        $reason = $this->Reasons->newEntity(); 
        if ($this->request->is('post')) {
            $reason = $this->Reasons->patchEntity($reason, $this->request->getData());
            if ($this->Reasons->save($reason)) {
                $this->Flash->success(__('Reason has been created.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Reason could not be created. Please, try again.'));
        }
        $this->set(compact('reason'));
        $this->set('_serialize', ['reason']);
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
        $reason = $this->Reasons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $post = $this->request->data; 
            $reason = $this->Reasons->patchEntity($reason, $post);
            if ($this->Reasons->save($reason)) {
                $this->Flash->success(__('The reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reason could not be saved. Please, try again.'));
        }
        $this->set(compact('reason'));
        $this->set('_serialize', ['reason']);
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
        $reason = $this->Reasons->get($id);

        if ($this->Reasons->delete($reason)) {
            $this->Flash->success(__('The Reasons has been deleted.'));
        } else {
            $this->Flash->error(__('The Reasons could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }  
}
