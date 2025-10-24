<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terminals Model
 *
 * @property \App\Model\Table\CashRegistersTable&\Cake\ORM\Association\HasMany $CashRegisters
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\Terminal newEmptyEntity()
 * @method \App\Model\Entity\Terminal newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Terminal> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Terminal get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Terminal findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Terminal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Terminal> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Terminal|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Terminal saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Terminal>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Terminal>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Terminal>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Terminal> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Terminal>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Terminal>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Terminal>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Terminal> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TerminalsTable extends Table
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

        $this->setTable('terminals');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');

        $this->hasMany('CashRegisters', [
            'foreignKey' => 'terminal_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'terminal_id',
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
            ->scalar('code')
            ->maxLength('code', 50)
            ->requirePresence('code', 'create')
            ->notEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->maxLength('description', 200)
            ->allowEmptyString('description');

        $validator
            ->scalar('location')
            ->maxLength('location', 200)
            ->allowEmptyString('location');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

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
        $rules->add($rules->isUnique(['code']), ['errorField' => 'code']);

        return $rules;
    }
}
