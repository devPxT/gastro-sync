<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuItemIngredients Model
 *
 * @property \App\Model\Table\MenuItemsTable&\Cake\ORM\Association\BelongsTo $MenuItems
 * @property \App\Model\Table\IngredientsTable&\Cake\ORM\Association\BelongsTo $Ingredients
 *
 * @method \App\Model\Entity\MenuItemIngredient newEmptyEntity()
 * @method \App\Model\Entity\MenuItemIngredient newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuItemIngredient> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuItemIngredient get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MenuItemIngredient findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MenuItemIngredient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuItemIngredient> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuItemIngredient|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MenuItemIngredient saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItemIngredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItemIngredient>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItemIngredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItemIngredient> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItemIngredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItemIngredient>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItemIngredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItemIngredient> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MenuItemIngredientsTable extends Table
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

        $this->setTable('menu_item_ingredients');
        $this->setDisplayField(['menu_item_id', 'ingredient_id']);
        $this->setPrimaryKey(['menu_item_id', 'ingredient_id']);

        $this->belongsTo('MenuItems', [
            'foreignKey' => 'menu_item_id',
            'joinType' => 'INNER',
        ]);
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
            ->decimal('qty_per_item')
            ->requirePresence('qty_per_item', 'create')
            ->notEmptyString('qty_per_item');

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
        $rules->add($rules->existsIn(['menu_item_id'], 'MenuItems'), ['errorField' => 'menu_item_id']);
        $rules->add($rules->existsIn(['ingredient_id'], 'Ingredients'), ['errorField' => 'ingredient_id']);

        return $rules;
    }
}
