<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuModifiers Model
 *
 * @property \App\Model\Table\MenuItemsTable&\Cake\ORM\Association\BelongsTo $MenuItems
 *
 * @method \App\Model\Entity\MenuModifier newEmptyEntity()
 * @method \App\Model\Entity\MenuModifier newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuModifier> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuModifier get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MenuModifier findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MenuModifier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuModifier> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuModifier|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MenuModifier saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MenuModifier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuModifier>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuModifier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuModifier> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuModifier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuModifier>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuModifier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuModifier> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MenuModifiersTable extends Table
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

        $this->setTable('menu_modifiers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('MenuItems', [
            'foreignKey' => 'menu_item_id',
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
            ->integer('menu_item_id')
            ->notEmptyString('menu_item_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->decimal('extra_price')
            ->allowEmptyString('extra_price');

        $validator
            ->boolean('required')
            ->allowEmptyString('required');

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

        return $rules;
    }
}
