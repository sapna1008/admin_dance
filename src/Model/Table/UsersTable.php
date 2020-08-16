<?php

namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;

use Cake\Auth\DefaultPasswordHasher;




class UsersTable extends Table

{



    public function initialize(array $config)
    {

        parent::initialize($config);
        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasMany('Instructors', [
            'dependent' => true,
            'foreignKey' => 'instructor_id'
        ]);
        
         $this->hasMany('Addresses', [
            'dependent' => true,
            'foreignKey' => 'user_id'
        ]);


        $this->hasMany('Subscribedprograms', [
            'dependent' => true,
            'foreignKey' => 'user_id'
        ]);

           
        
    }


    public function validationDefault(Validator $validator)

    {

        // $validator

        //     ->integer('id')

        //     ->allowEmpty('id', 'create');



        $validator

            ->notEmpty('name', 'Please Enter Full Name');  

        $validator

            ->email('email')

            ->notEmpty('email', 'Please Enter Email');



        $validator

            ->notEmpty('phone', 'Please Enter Phone');

        return $validator;

    }
    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }


    public function buildRules(RulesChecker $rules)

    {   

        $rules->add($rules->isUnique(['email'],[
    'errorField' => 'status',
    'message' => 'Email address already exists, add a unique value.'
]));
        
       
        
        $rules->add($rules->isUnique(['phone'],[
    'errorField' => 'status',
    'message' => 'Mobile number already exists, add a unique value.'  
])); 


        return $rules;

    }

}

