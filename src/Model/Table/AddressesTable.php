<?php

namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;

class AddressesTable extends Table

{


    public function initialize(array $config)

    {

        parent::initialize($config);
        $this->setTable('addresses');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

          $this->belongsTo('Users', [      
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);   
    }
    

}

