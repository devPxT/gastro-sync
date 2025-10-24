<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuItems Model
 *
 * @property \App\Model\Table\MenuCategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\MenuItemIngredientsTable&\Cake\ORM\Association\HasMany $MenuItemIngredients
 * @property \App\Model\Table\MenuModifiersTable&\Cake\ORM\Association\HasMany $MenuModifiers
 * @property \App\Model\Table\OrderItemsTable&\Cake\ORM\Association\HasMany $OrderItems
 * @property \App\Model\Table\VTopItemsTable&\Cake\ORM\Association\HasMany $VTopItems
 *
 * @method \App\Model\Entity\MenuItem newEmptyEntity()
 * @method \App\Model\Entity\MenuItem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuItem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuItem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MenuItem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MenuItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuItem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuItem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MenuItem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuItem> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MenuItemsTable extends Table
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

        $this->setTable('menu_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'className' => 'MenuCategories',
        ]);
        $this->hasMany('MenuItemIngredients', [
            'foreignKey' => 'menu_item_id',
        ]);
        $this->hasMany('MenuModifiers', [
            'foreignKey' => 'menu_item_id',
        ]);
        $this->hasMany('OrderItems', [
            'foreignKey' => 'menu_item_id',
        ]);
        $this->hasMany('VTopItems', [
            'foreignKey' => 'menu_item_id',
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
            ->integer('category_id')
            ->allowEmptyString('category_id');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        $validator
            ->boolean('available')
            ->allowEmptyString('available');

        $validator
            ->integer('prep_time_minutes')
            ->allowEmptyString('prep_time_minutes');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
