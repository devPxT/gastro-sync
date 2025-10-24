<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VDailySales Model
 *
 * @method \App\Model\Entity\VDailySale newEmptyEntity()
 * @method \App\Model\Entity\VDailySale newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VDailySale> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VDailySale get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VDailySale findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VDailySale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VDailySale> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VDailySale|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VDailySale saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VDailySale>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VDailySale>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VDailySale>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VDailySale> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VDailySale>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VDailySale>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VDailySale>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VDailySale> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VDailySalesTable extends Table
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

        $this->setTable('v_daily_sales');
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
            ->date('sale_date')
            ->allowEmptyDate('sale_date');

        $validator
            ->notEmptyString('orders_count');

        $validator
            ->decimal('subtotal')
            ->allowEmptyString('subtotal');

        $validator
            ->decimal('total_discount')
            ->allowEmptyString('total_discount');

        $validator
            ->decimal('total_tax')
            ->allowEmptyString('total_tax');

        $validator
            ->decimal('total_service')
            ->allowEmptyString('total_service');

        $validator
            ->decimal('gross_total')
            ->allowEmptyString('gross_total');

        return $validator;
    }
}
