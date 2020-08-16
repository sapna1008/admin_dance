<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */


namespace App\Controller;

error_reporting(E_ALL & ~E_USER_DEPRECATED);

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;


header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('Content-Type: text/plain');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        // $this->loadComponent('Csrf');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action'     => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action'     => 'login'
            ]
        ]);
        $userdata = $this->Auth->user();
        $this->set('loggeduser', $userdata);
        $path = Router::url('/', true); 
        $this->set('fullurl',$path);	
		
        /*************************************/
        $this->loadModel('Users');
        $currentuser = $this->Users->find('all',['conditions'=>['Users.id'=>$userdata['id']]]);
        $currentuser = $currentuser->first();
        
        $this->set(compact('currentuser'));
        $this->set('_serialize', ['currentuser']);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function SendPushNotificationsAndroid($token,$title,$body){
        $ch = curl_init("https://fcm.googleapis.com/fcm/send"); 
          $notification = array('title' =>$title , 'body' => $body, 'vibrate'=> true,'content-available' => true, 'priority' => 'high'); 
          $data = array('title' => $title, 'body' => $body);
          $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $data);
          
          $json = json_encode($arrayToSend); 
           $headers = array();
           $headers[] = 'Content-Type: application/json';
           $headers[] = 'Authorization: key=AIzaSyD8O3kHWEJ_mk454-OSh7fgKJ5Lwy3hmpk';
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
           curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
           curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
           
           curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);  
           curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_POST, 1);
      
          $response = curl_exec($ch);
          curl_close($ch);
          
          return $response ;
              
      }
      
      public function SendPushNotifications($token,$id,$userid,$title,$body){
        $ch = curl_init("https://fcm.googleapis.com/fcm/send"); 
        $notification = array('title' =>$title , 'body' => $body, 'vibrate'=> true, 'content-available' => true, 'priority' => 'high'); 
        $data = array('title' => $title, 'body' => $body, 'id' => array('aid'=> $id, 'userid'=> $userid) );
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $data);
        
        $json = json_encode($arrayToSend);  
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AIzaSyA0o-RqPQJwkeALlyAKEFbPTCXlmV8w2R8';
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);  
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
    
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response ;            
    }


 


    public function authcontent() {
        $this->set('userdata', $this->Auth->user());
    }


    public function StyleName($id)
    {

        $this->loadModel('Styles');
        $query = $this->Styles->get($id);
        $stylname = $query['style'];
        return $stylname;

    }

    // public function multipleStyleName($style_arr)
    // {

    //   $style_st = explode(",", $style_arr);
    //     foreach ($style_st as $style_val) 
    //     {

    //          echo $style_val ;           
    //     }
        
    // }


public function ProgramName($id)
    {

        $this->loadModel('Programs');
        $query = $this->Programs->get($id);
        $programname = $query['title'];
        return $programname;

    }


    public function pro_video($program_val)
    {
         $new_arr =array();
          foreach ($program_val['videos'] as $pro_val) 
            {
               $pro_val['video'] = Router::url('/',true).'images/introductoryimages/'.$pro_val['video'];
                if($program_val['id'] == $pro_val['program_id'])
                {
                 $new_arr[$pro_val->level][] = $pro_val;

                }
                
            }
            return $new_arr;
    }
 


}
