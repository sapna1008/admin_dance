<?php

namespace App\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;

class ProductsTable extends Table

{


    public function initialize(array $config)

    {

        parent::initialize($config);
        $this->setTable('products');
        $this->setDisplayField('product_name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

         $this->hasMany('Productoptions', [
            'dependent' => true,
            'foreignKey' => 'product_id'
        ]); 
        
    }

}

