<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ingredients Model
 *
 * @property \App\Model\Table\InventoryMovementsTable&\Cake\ORM\Association\HasMany $InventoryMovements
 * @property \App\Model\Table\MenuItemIngredientsTable&\Cake\ORM\Association\HasMany $MenuItemIngredients
 *
 * @method \App\Model\Entity\Ingredient newEmptyEntity()
 * @method \App\Model\Entity\Ingredient newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Ingredient> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ingredient get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Ingredient findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Ingredient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Ingredient> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ingredient|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Ingredient saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient> deleteManyOrFail(iterable $entities, array $options = [])
 */
class IngredientsTable extends Table
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

        $this->setTable('ingredients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('InventoryMovements', [
            'foreignKey' => 'ingredient_id',
        ]);
        $this->hasMany('MenuItemIngredients', [
            'foreignKey' => 'ingredient_id',
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
            ->scalar('sku')
            ->maxLength('sku', 80)
            ->allowEmptyString('sku');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('unit')
            ->maxLength('unit', 50)
            ->allowEmptyString('unit');

        $validator
            ->decimal('stock_qty')
            ->allowEmptyString('stock_qty');

        $validator
            ->decimal('stock_threshold')
            ->allowEmptyString('stock_threshold');

        $validator
            ->decimal('cost_price')
            ->allowEmptyString('cost_price');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
