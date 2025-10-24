<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashRegisters Model
 *
 * @property \App\Model\Table\TerminalsTable&\Cake\ORM\Association\BelongsTo $Terminals
 * @property \App\Model\Table\CashTransactionsTable&\Cake\ORM\Association\HasMany $CashTransactions
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\CashRegister newEmptyEntity()
 * @method \App\Model\Entity\CashRegister newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CashRegister> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CashRegister get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CashRegister findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CashRegister patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CashRegister> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CashRegister|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CashRegister saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CashRegister>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashRegister>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashRegister>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashRegister> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashRegister>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashRegister>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CashRegister>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CashRegister> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CashRegistersTable extends Table
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

        $this->setTable('cash_registers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Terminals', [
            'foreignKey' => 'terminal_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CashTransactions', [
            'foreignKey' => 'cash_register_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'cash_register_id',
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
            ->integer('terminal_id')
            ->notEmptyString('terminal_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('opened_by')
            ->allowEmptyString('opened_by');

        $validator
            ->dateTime('opened_at')
            ->allowEmptyDateTime('opened_at');

        $validator
            ->dateTime('closed_at')
            ->allowEmptyDateTime('closed_at');

        $validator
            ->decimal('opening_amount')
            ->allowEmptyString('opening_amount');

        $validator
            ->decimal('closing_amount')
            ->allowEmptyString('closing_amount');

        $validator
            ->scalar('state')
            ->allowEmptyString('state');

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
        $rules->add($rules->existsIn(['terminal_id'], 'Terminals'), ['errorField' => 'terminal_id']);

        return $rules;
    }
}
