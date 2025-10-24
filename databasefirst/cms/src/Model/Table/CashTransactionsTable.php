<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashTransactions Model
 *
 * @property \App\Model\Table\CashRegistersTable&\Cake\ORM\Association\BelongsTo $CashRegisters
 * @property \App\Model\Table\PaymentMethodsTable&\Cake\ORM\Association\BelongsTo $PaymentMethods
 *
 * @method \App\Model\Entity\CashTransaction newEmptyEntity()
 * @method \App\Model\Entity\CashTransaction newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CashTransaction> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CashTransaction get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CashTransaction findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CashTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CashTransaction> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CashTransaction|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CashTransaction saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CashTransaction>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashTransaction>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashTransaction>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashTransaction> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashTransaction>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashTransaction>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashTransaction>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashTransaction> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CashTransactionsTable extends Table
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

        $this->setTable('cash_transactions');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->belongsTo('CashRegisters', [
            'foreignKey' => 'cash_register_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PaymentMethods', [
            'foreignKey' => 'payment_method_id',
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
            ->integer('cash_register_id')
            ->notEmptyString('cash_register_id');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->integer('payment_method_id')
            ->allowEmptyString('payment_method_id');

        $validator
            ->allowEmptyString('related_order_id');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->allowEmptyString('reference');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

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
        $rules->add($rules->existsIn(['cash_register_id'], 'CashRegisters'), ['errorField' => 'cash_register_id']);
        $rules->add($rules->existsIn(['payment_method_id'], 'PaymentMethods'), ['errorField' => 'payment_method_id']);

        return $rules;
    }
}
