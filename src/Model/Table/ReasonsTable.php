<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reasons Model
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReasonsTable extends Table
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

        $this->setTable('reasons');
        $this->setDisplayField('reason'); 
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->integer('id')
//            ->allowEmpty('id', 'create');
//
//        $validator
//            ->allowEmpty('name');
//
//        $validator
//            ->allowEmpty('slug');
//
//        $validator
//            ->allowEmpty('image');
//         $validator
//        ->add('lft', 'valid', ['rule' => 'numeric'])
//    //    ->requirePresence('lft', 'create')
//        ->notEmpty('lft');
//
//    $validator
//        ->add('rght', 'valid', ['rule' => 'numeric'])
//    //    ->requirePresence('rght', 'create')
//        ->notEmpty('rght');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->existsIn(['parent_id'], 'ParentCategories'));

        return $rules;
    }
}
