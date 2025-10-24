<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property int $role_id
 * @property string $password_hash
 * @property bool|null $is_active
 * @property \Cake\I18n\DateTime|null $last_login
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Role $role
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone' => true,
        'role_id' => true,
        'password_hash' => true,
        'is_active' => true,
        'last_login' => true,
        'created_at' => true,
        'role' => true,
    ];
}
