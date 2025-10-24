<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryMovements Model
 *
 * @property \App\Model\Table\IngredientsTable&\Cake\ORM\Association\BelongsTo $Ingredients
 *
 * @method \App\Model\Entity\InventoryMovement newEmptyEntity()
 * @method \App\Model\Entity\InventoryMovement newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\InventoryMovement> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryMovement get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\InventoryMovement findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\InventoryMovement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\InventoryMovement> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryMovement|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\InventoryMovement saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\InventoryMovement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\InventoryMovement>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\InventoryMovement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\InventoryMovement> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\InventoryMovement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\InventoryMovement>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\InventoryMovement>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\InventoryMovement> deleteManyOrFail(iterable $entities, array $options = [])
 */
class InventoryMovementsTable extends Table
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

        $this->setTable('inventory_movements');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ingredients', [
            'foreignKey' => 'ingredient_id',
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
            ->integer('ingredient_id')
            ->notEmptyString('ingredient_id');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->decimal('qty')
            ->requirePresence('qty', 'create')
            ->notEmptyString('qty');

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
        $rules->add($rules->existsIn(['ingredient_id'], 'Ingredients'), ['errorField' => 'ingredient_id']);

        return $rules;
    }
}
