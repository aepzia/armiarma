<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Readers Model
 *
 * @method \App\Model\Entity\Reader get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reader newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reader[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reader|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reader[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reader findOrCreate($search, callable $callback = null, $options = [])
 */
class ReadersTable extends Table
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

        $this->setTable('readers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->boolean('ekitaldiinfo')
            ->requirePresence('ekitaldiinfo', 'create')
            ->notEmpty('ekitaldiinfo','Datu hau betetzea beharrezkoa da');

        $validator
            ->integer('maiztasuna')
            ->requirePresence('maiztasuna', 'create')
            ->notEmpty('maiztasuna','Datu hau betetzea beharrezkoa da');

        $validator
            ->boolean('hizkuntzapolitikainfo')
            ->requirePresence('hizkuntzapolitikainfo', 'create')
            ->notEmpty('hizkuntzapolitikainfo','Datu hau betetzea beharrezkoa da');
        $validator
            ->boolean('ahobizi')
            ->requirePresence('ahobizi', 'create')
            ->notEmpty('ahobizi','Datu hau betetzea beharrezkoa da');
        $validator
            ->boolean('bolondres')
            ->requirePresence('bolondres', 'create')
            ->notEmpty('bolondres','Datu hau betetzea beharrezkoa da');


        $validator
            ->scalar('izena')
            ->maxLength('izena', 255)
            ->requirePresence('izena', 'Izena','create')
            ->notEmpty('izena','Datu hau betetzea beharrezkoa da');

        $validator
            ->scalar('abizena')
            ->maxLength('abizena', 255)
            ->requirePresence('abizena', 'create')
            ->notEmpty('abizena','Datu hau betetzea beharrezkoa da');
        $validator
            ->scalar('herria')
            ->maxLength('herria', 255)
            ->requirePresence('herria', 'create')
            ->notEmpty('herria','Datu hau betetzea beharrezkoa da');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'E-mail must be valid'
            ])
            ->notEmpty('email','Datu hau betetzea beharrezkoa da');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active','Datu hau betetzea beharrezkoa da');

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
        $rules->add($rules->isUnique(['email'], 'Helbide hau aurretik erabili da.'));

        return $rules;
    }
}
