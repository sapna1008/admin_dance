<?php

namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



/**$this->hasMany('Userskills', [
            'foreignKey' => 'user_id'
        ]);

 * Users Model

 *

 * @method \App\Model\Entity\User get($primaryKey, $options = [])

 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])

 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])

 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])

 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])

 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])

 *

 * @mixin \Cake\ORM\Behavior\TimestampBehavior

 */

class SubscriptionsTable extends Table

{



    /**

     * Initialize method

     *

     * @param array $config The configuration for the Table.

     * @return void

     */

    public function initialize(array $config)

    {

        parent::initialize($config);
        $this->setTable('subscriptions');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        // $this->hasMany('Galleries', [
        //     'dependent' => true,
        //     'foreignKey' => 'user_id'
        // ]); 
        
        //   $this->hasOne('Requests', [
        //     'dependent' => true,
        //     'foreignKey' => 'sender_id'
        // ]); 
        //   $this->hasOne('Requests', [
        //     'dependent' => true,
        //     'foreignKey' => 'receiver_id'
        // ]); 
                  
        //   $this->hasOne('Friends', [
        //     'dependent' => true,
        //     'foreignKey' => 'sender_id'
        // ]); 
           
        //   $this->hasOne('Friends', [
        //     'dependent' => true,
        //     'foreignKey' => 'receiver_id'
        // ]); 
          
        //   $this->hasOne('Answers', [
        //     'dependent' => true,
        //     'foreignKey' => 'sender_id'
        // ]); 
        //     $this->hasOne('Answers', [
        //     'dependent' => true,
        //     'foreignKey' => 'receiver_id'
        // ]); 
           
        //   $this->hasOne('Chats', [
        //     'dependent' => true,
        //     'foreignKey' => 'sender_id'
        // ]); 
           
        //     $this->hasOne('Chats', [
        //     'dependent' => true,
        //     'foreignKey' => 'receiver_id'
        // ]); 
           
        
    }

    

    /**

     * Default validation rules.

     *

     * @param \Cake\Validation\Validator $validator Validator instance.

     * @return \Cake\Validation\Validator

     */

    // public function validationDefault(Validator $validator)

    // {

    //     $validator

    //         ->integer('id')

    //         ->allowEmpty('id', 'create');



    //     $validator

    //         ->notEmpty('name', 'Please Enter Full Name');  

    //     $validator

    //         ->email('email')

    //         ->notEmpty('email', 'Please Enter Email');



    //     $validator

    //         ->notEmpty('phone', 'Please Enter Phone');

    //     return $validator;

    // }



    /**

     * Returns a rules checker object that will be used for validating

     * application integrity.

     *

     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.

     * @return \Cake\ORM\RulesChecker

     */

//     public function buildRules(RulesChecker $rules)

//     {   

//         $rules->add($rules->isUnique(['email'],[
//     'errorField' => 'status',
//     'message' => 'Email address already exists, add a unique value.'
// ]));
        
       
        
//         $rules->add($rules->isUnique(['phone'],[
//     'errorField' => 'status',
//     'message' => 'Mobile number already exists, add a unique value.'  
// ])); 


//         return $rules;

//     }

}

