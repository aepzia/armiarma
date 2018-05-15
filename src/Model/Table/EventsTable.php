<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');


        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');


        $validator
            ->scalar('izenburua')
            ->maxLength('izenburua', 255)
            ->requirePresence('izenburua', 'create')
            ->notEmpty('izenburua','Datu hau betetzea beharrezkoa da');

        $validator
            ->scalar('laburpena')
            ->maxLength('laburpena', 255)
            ->requirePresence('laburpena', 'create')
            ->allowEmpty('laburpena');

        $validator
            ->date('hasData')
            ->requirePresence('hasData', 'create')
            ->notEmpty('hasData','Datu hau betetzea beharrezkoa da');
        $validator
            ->date('bukData')
            ->requirePresence('bukData', 'create')
            ->notEmpty('bukData','Datu hau betetzea beharrezkoa da');
        $validator
            ->date('hasOrdua')
            ->requirePresence('hasOrdua', 'create')
            ->notEmpty('hasOrdua','Datu hau betetzea beharrezkoa da');
        $validator
            ->date('bukOrdua')
            ->requirePresence('bukOrdua', 'create')
            ->notEmpty('bukOrdua','Datu hau betetzea beharrezkoa da');
        $validator
            ->scalar('tokia')
            ->maxLength('tokia', 255)
            ->requirePresence('tokia', 'create')
            ->notEmpty('tokia','Datu hau betetzea beharrezkoa da');

        $validator
            ->scalar('prezioa')
            ->maxLength('prezioa', 255)
            ->requirePresence('prezioa', 'create')
            ->allowEmpty('prezioa');

        $validator
            ->scalar('sarrerak')
            ->maxLength('sarrerak', 255)
            ->requirePresence('sarrerak', 'create')
            ->allowEmpty('sarrerak');

        $validator
            ->scalar('web')
            ->maxLength('web', 255)
            ->requirePresence('web', 'create')
            ->allowEmpty('web');

        $validator
            ->scalar('fitx')
            ->maxLength('fitx', 255)
            ->requirePresence('fitx', 'create')
            ->allowEmpty('fitx')
            ->add('fitx', [
                'validExtension' => [
                    'rule' => ['extension',['png']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('Fitxategiak .png motakoa izan behar du.')
                ]
              ]);


        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
