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

class ProductsController extends AppController

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

		$products = $this->Products->find('all');		

//   		$instructors = $this->Instructors->find('all', [
// 			'order' => ['Instructors.id' => 'desc'],
// 			//'contain'=>['Usertones']
// 		]);

		$products = $products->all()->toArray();

		$this->set('products', $products);

		$this->set('_serialize', ['products']);

    }
    
    
	public function logout() {

        if ($this->Auth->logout()) {

            return $this->redirect(['action' => 'login']);

        }

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

    
	

// add product method

	
public function add()
{
    $product = $this->Products->newEntity();
  		$data = $this->Products->find('all');
		$data = $data->all()->toArray();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            	$post = $this->request->data;
       	
				$products = $this->request->data['featured_image'];
				$name = time().$products['name'];
				$tmp_name = $products['tmp_name'];
				$upload_path = WWW_ROOT.'images/products/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				$post['featured_image'] = $name;
				
		    	if(!empty($this->request->data['image1']['name'])){
				$products1 = $this->request->data['image1'];
				$name1 = time().$products1['name'];
				$tmp_name1 = $products1['tmp_name'];
				$upload_path1 = WWW_ROOT.'images/products/'.$name1;
				move_uploaded_file($tmp_name1, $upload_path1);
				$post['image1'] = $name1;
		    	}
				if(!empty($this->request->data['image1']['name'])){
				$products2 = $this->request->data['image2'];
				$name2 = time().$products2['name'];
				$tmp_name2 = $products2['tmp_name'];
				$upload_path2 = WWW_ROOT.'images/products/'.$name2;
				move_uploaded_file($tmp_name2, $upload_path2);
				$post['image2'] = $name2;
				}
				
				if(!empty($this->request->data['image1']['name'])){
				$products3 = $this->request->data['image3'];
				$name3 = time().$products3['name'];
				$tmp_name3 = $products3['tmp_name'];
				$upload_path3 = WWW_ROOT.'images/products/'.$name3;
				move_uploaded_file($tmp_name3, $upload_path3);
				$post['image3'] = $name3;
				}
				
                $product = $this->Products->patchEntity($product, $post);

                 if ($this->Products->save($product)) {
                       
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);

                }else{

	            $this->Flash->error(__('The product could not be saved. Please, try again.'));
		    	}
         
          }
        	$this->set('data', $data);
    		$this->set('_serialize', ['data']);

}

// delete product method


public function delete($id = null)

    {      
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);

	}
	
	
// 	edit product method
	
	
	public function edit($id = null)
	{
	    $baseurl = Router::url('/', true);
	     $product = $this->Products->get($id);
        $this->set('product', $product);
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;

			if($this->request->data['featured_image']['name'] != ''){
			
				$products = $this->request->data['featured_image'];
				$name = time().$products['name'];
				$tmp_name = $products['tmp_name'];
				$upload_path = WWW_ROOT.'images/products/'.$name;
				move_uploaded_file($tmp_name, $upload_path);
				$post['featured_image'] = $name;	
			
			
			}else{
			    $post['featured_image'] = 	$product['featured_image'];

			}
			if($this->request->data['image1']['name'] != ''){
			
				$products1 = $this->request->data['image1'];
				$name1 = time().$products1['name'];
				$tmp_name1 = $products1['tmp_name'];
				$upload_path1 = WWW_ROOT.'images/products/'.$name1;
				move_uploaded_file($tmp_name1, $upload_path1);
				$post['image1'] = $name1;
			
			}else{
				$post['image1'] = 	$product['image1'];

			}
			if($this->request->data['image2']['name'] != ''){
			
			    $products2 = $this->request->data['image2'];
				$name2 = time().$products2['name'];
				$tmp_name2 = $products2['tmp_name'];
				$upload_path2 = WWW_ROOT.'images/products/'.$name2;
				move_uploaded_file($tmp_name2, $upload_path2);
				$post['image2'] = $name2;
			
			}else{
				$post['image2'] = 	$product['image2'];

			}
			if($this->request->data['image3']['name'] != ''){
			
				$products3 = $this->request->data['image3'];
				$name3 = time().$products3['name'];
				$tmp_name3 = $products3['tmp_name'];
				$upload_path3 = WWW_ROOT.'images/products/'.$name3;
				move_uploaded_file($tmp_name3, $upload_path3);
				$post['image3'] = $name3;
			
			}else{
				$post['image3'] = 	$product['image3'];

			}
            $product = $this->Products->patchEntity($product, $post);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);

            }else{

	            $this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
        }

        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
	}
	

// 	    OPTION CATEGORY SECTION


public function option($id = null)
{
    	$this->loadModel('Options');
  		$options = $this->Options->find('all');
		$options = $options->all()->toArray();
		$this->set('options', $options);
		$this->set('opt', $id);
		$this->set('_serialize', ['options']);
	
          if(!empty($id)){
               $this->loadModel('Options');
               	     $option = $this->Options->get($id);
               	$this->set('option', $option);
        if ($this->request->is(['patch', 'post', 'put'])) {
            	$post = $this->request->data;
                $option = $this->Options->patchEntity($option, $post);
                 if ($this->Options->save($option)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['action' => 'option']);

                 }      
        }
          }
          else{
              	$option = $this->Options->newEntity();
		 if ($this->request->is(['patch', 'post', 'put'])) {
            	$post = $this->request->data;
                $option = $this->Options->patchEntity($option, $post);
                 if ($this->Options->save($option)) {
                       
                $this->Flash->success(__('The option has been saved.'));

                return $this->redirect(['action' => 'option']);

                 }
                
        }
              
          }

}

// delete option method


public function deleteopt($id = null)

    {      
         $this->loadModel('Options');
        $option= $this->Options->get($id);
        if ($this->Options->delete($option)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'option']);

	}
	
	
	
// Product_option section

public function productoption()
{
    $this->loadModel('Productoptions');
       	$this->loadModel('Options');
    	$items = $this->Productoptions->find('all',['contain'=>['Products','Options']]);
		$items = $items->all()->toArray();
// 		print_r($items);
// 		exit;

		$this->set('items', $items);

		$this->set('_serialize', ['items']);
}

// add product option method

public function addproductoption(){
        $this->loadModel('Options');
        $this->loadModel('Productoptions');
        $this->loadModel('Products');
        $product = $this->Productoptions->newEntity();
        
      	$products = $this->Products->find('list',[
        'conditions' => ['Products.status =' => 1]]);
		$products = $products->all()->toArray();
		$this->set('products', $products);
		
		$options = $this->Options->find('list',[
        'conditions' => ['Options.status =' => 1]]);
		$options = $options->all()->toArray();
		$this->set('options', $options);
		
		   if ($this->request->is(['patch', 'post', 'put'])) {
            	$post = $this->request->data;
            		
		 $query = $this->Productoptions->find('all', [
                    'conditions' => ['Productoptions.option_id' => $post['option_id']]
                ]);
                $query = $query->first();
                if(empty($query)){
                $product = $this->Productoptions->patchEntity($product, $post);
                 if ($this->Productoptions->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'product_option']);
                }else{
	            $this->Flash->error(__('The product could not be saved. Please, try again.'));
		    	}
          }
          else{
		        $this->Flash->error(__('Already exist of this size'));
		   }
		   }
		   
}

	public function editpro($id = null){
        $this->loadModel('Options');
        $this->loadModel('Productoptions');
	    $item = $this->Productoptions->get($id, [
            'contain' => []
        ]);
         $this->set('item', $item);
	    $baseurl = Router::url('/', true);
	   	$products = $this->Products->find('list',[
        'conditions' => ['Products.status =' => 1]]);
		$products = $products->all()->toArray();
		$this->set('products', $products);
		
		$options = $this->Options->find('list',[
        'conditions' => ['Options.status =' => 1]]);
		$options = $options->all()->toArray();
		$this->set('options', $options);
		
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$post = $this->request->data;
					 $query = $this->Productoptions->find('all', [
                    'conditions' => ['Productoptions.option_id' => $post['option_id']]
                ]);
                $query = $query->first();
                
            $item = $this->Productoptions->patchEntity($item, $post);
            if(empty($query)){
            if ($this->Products->save($item)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'product_option']);

            }else{

	            $this->Flash->error(__('The product could not be saved. Please, try again.'));
			}
            }
            else{
                $this->Flash->error(__('Already exist of this size'));
            }
        }

        $this->set(compact('item'));
        $this->set('_serialize', ['item']);
}
public function deletepro($id = null)

    {      
         $this->loadModel('Productoptions');
        $item= $this->Productoptions->get($id);
        if ($this->Productoptions->delete($item)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'product_option']);

	}
}

