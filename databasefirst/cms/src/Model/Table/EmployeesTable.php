<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Employee> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Employee> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Employee>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Employee> deleteManyOrFail(iterable $entities, array $options = [])
 */
class EmployeesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('employees');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->maxLength('username', 80)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 100)
            ->allowEmptyString('last_name');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->allowEmptyString('phone');

        $validator
            ->integer('role_id')
            ->notEmptyString('role_id');

        $validator
            ->scalar('password_hash')
            ->maxLength('password_hash', 255)
            ->requirePresence('password_hash', 'create')
            ->notEmptyString('password_hash');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->dateTime('last_login')
            ->allowEmptyDateTime('last_login');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
