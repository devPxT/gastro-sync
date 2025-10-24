<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KitchenStations Model
 *
 * @property \App\Model\Table\OrderItemsTable&\Cake\ORM\Association\HasMany $OrderItems
 *
 * @method \App\Model\Entity\KitchenStation newEmptyEntity()
 * @method \App\Model\Entity\KitchenStation newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\KitchenStation> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KitchenStation get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\KitchenStation findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\KitchenStation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\KitchenStation> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\KitchenStation|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\KitchenStation saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\KitchenStation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\KitchenStation>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\KitchenStation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\KitchenStation> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\KitchenStation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\KitchenStation>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\KitchenStation>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\KitchenStation> deleteManyOrFail(iterable $entities, array $options = [])
 */
class KitchenStationsTable extends Table
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

        $this->setTable('kitchen_stations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderItems', [
            'foreignKey' => 'kitchen_station_id',
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
            ->maxLength('code', 100)
            ->allowEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

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
        $rules->add($rules->isUnique(['code'], ['allowMultipleNulls' => true]), ['errorField' => 'code']);

        return $rules;
    }
}
