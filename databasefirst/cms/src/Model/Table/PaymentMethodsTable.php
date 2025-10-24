<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentMethods Model
 *
 * @property \App\Model\Table\CashTransactionsTable&\Cake\ORM\Association\HasMany $CashTransactions
 * @property \App\Model\Table\OrderPaymentsTable&\Cake\ORM\Association\HasMany $OrderPayments
 *
 * @method \App\Model\Entity\PaymentMethod newEmptyEntity()
 * @method \App\Model\Entity\PaymentMethod newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentMethod> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentMethod get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PaymentMethod findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PaymentMethod patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PaymentMethod> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentMethod|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PaymentMethod saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PaymentMethod>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PaymentMethod> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PaymentMethodsTable extends Table
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

        $this->setTable('payment_methods');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CashTransactions', [
            'foreignKey' => 'payment_method_id',
        ]);
        $this->hasMany('OrderPayments', [
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
            ->allowEmptyString('extra_info');

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
