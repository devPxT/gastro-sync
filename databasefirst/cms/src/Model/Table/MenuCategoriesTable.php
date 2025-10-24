<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MenuCategories Model
 *
 * @method \App\Model\Entity\MenuCategory newEmptyEntity()
 * @method \App\Model\Entity\MenuCategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuCategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuCategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MenuCategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MenuCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MenuCategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuCategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MenuCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MenuCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuCategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuCategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuCategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MenuCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MenuCategory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MenuCategoriesTable extends Table
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

        $this->setTable('menu_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('position')
            ->allowEmptyString('position');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        return $validator;
    }
}
