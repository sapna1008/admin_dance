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

class ProgramsratingTable extends Table

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
        $this->setTable('programsrating');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        
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

    // }

    public function buildRules(RulesChecker $rules)

    {   

        $rules->add($rules->isUnique(['style'],[
            'errorField' => 'status',
            'message' => 'Style form already exists.'
        ]));
        
       
     return $rules;

    }







}

