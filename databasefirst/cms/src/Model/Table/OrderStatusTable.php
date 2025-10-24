<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderStatus Model
 *
 * @method \App\Model\Entity\OrderStatus newEmptyEntity()
 * @method \App\Model\Entity\OrderStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrderStatusTable extends Table
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

        $this->setTable('order_status');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('seq_order')
            ->allowEmptyString('seq_order');

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
