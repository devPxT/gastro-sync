<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderPayments Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\PaymentMethodsTable&\Cake\ORM\Association\BelongsTo $PaymentMethods
 *
 * @method \App\Model\Entity\OrderPayment newEmptyEntity()
 * @method \App\Model\Entity\OrderPayment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderPayment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderPayment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderPayment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderPayment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderPayment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderPayment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderPayment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderPayment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderPayment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderPayment> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrderPaymentsTable extends Table
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

        $this->setTable('order_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaymentMethods', [
            'foreignKey' => 'payment_method_id',
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
            ->notEmptyString('order_id');

        $validator
            ->integer('payment_method_id')
            ->notEmptyString('payment_method_id');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->allowEmptyString('reference');

        $validator
            ->integer('processed_by')
            ->allowEmptyString('processed_by');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'), ['errorField' => 'order_id']);
        $rules->add($rules->existsIn(['payment_method_id'], 'PaymentMethods'), ['errorField' => 'payment_method_id']);

        return $rules;
    }
}
