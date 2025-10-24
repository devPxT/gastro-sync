<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\BelongsTo $Waiters
 * @property \App\Model\Table\TerminalsTable&\Cake\ORM\Association\BelongsTo $Terminals
 * @property \App\Model\Table\CashRegistersTable&\Cake\ORM\Association\BelongsTo $CashRegisters
 * @property \App\Model\Table\OrderStatusTable&\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\OrderItemsTable&\Cake\ORM\Association\HasMany $OrderItems
 * @property \App\Model\Table\OrderPaymentsTable&\Cake\ORM\Association\HasMany $OrderPayments
 *
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> deleteManyOrFail(iterable $entities, array $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('order_number');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
        ]);
        $this->belongsTo('Waiters', [
            'foreignKey' => 'waiter_id',
            'className' => 'Employees',
        ]);
        $this->belongsTo('Terminals', [
            'foreignKey' => 'terminal_id',
        ]);
        $this->belongsTo('CashRegisters', [
            'foreignKey' => 'cash_register_id',
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
            'className' => 'OrderStatus',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('OrderItems', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('OrderPayments', [
            'foreignKey' => 'order_id',
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
            ->allowEmptyString('order_guid');

        $validator
            ->scalar('order_number')
            ->maxLength('order_number', 50)
            ->requirePresence('order_number', 'create')
            ->notEmptyString('order_number');

        $validator
            ->scalar('table_number')
            ->maxLength('table_number', 50)
            ->allowEmptyString('table_number');

        $validator
            ->integer('customer_id')
            ->allowEmptyString('customer_id');

        $validator
            ->integer('waiter_id')
            ->allowEmptyString('waiter_id');

        $validator
            ->integer('terminal_id')
            ->allowEmptyString('terminal_id');

        $validator
            ->integer('cash_register_id')
            ->allowEmptyString('cash_register_id');

        $validator
            ->integer('status_id')
            ->notEmptyString('status_id');

        $validator
            ->boolean('is_takeaway')
            ->allowEmptyString('is_takeaway');

        $validator
            ->boolean('is_delivery')
            ->allowEmptyString('is_delivery');

        $validator
            ->dateTime('scheduled_at')
            ->allowEmptyDateTime('scheduled_at');

        $validator
            ->decimal('subtotal')
            ->allowEmptyString('subtotal');

        $validator
            ->decimal('discount')
            ->allowEmptyString('discount');

        $validator
            ->decimal('tax')
            ->allowEmptyString('tax');

        $validator
            ->decimal('service_charge')
            ->allowEmptyString('service_charge');

        $validator
            ->decimal('total')
            ->allowEmptyString('total');

        $validator
            ->scalar('payment_status')
            ->allowEmptyString('payment_status');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn(['waiter_id'], 'Waiters'), ['errorField' => 'waiter_id']);
        $rules->add($rules->existsIn(['terminal_id'], 'Terminals'), ['errorField' => 'terminal_id']);
        $rules->add($rules->existsIn(['cash_register_id'], 'CashRegisters'), ['errorField' => 'cash_register_id']);
        $rules->add($rules->existsIn(['status_id'], 'Statuses'), ['errorField' => 'status_id']);

        return $rules;
    }
}
