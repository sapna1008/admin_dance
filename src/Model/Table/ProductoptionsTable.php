<?php

namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;

class ProductoptionsTable extends Table

{


    public function initialize(array $config)

    {

        parent::initialize($config);
        $this->setTable('productoptions');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

       $this->belongsTo('Products', [      
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]); 
         $this->belongsTo('Options', [      
            'foreignKey' => 'option_id',
            'joinType' => 'INNER'
        ]); 
        
    }

}

