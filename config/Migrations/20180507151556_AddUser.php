<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
class AddUser extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
      $UsersTable = TableRegistry::get('Users');
      $user = $UsersTable->newEntity();

      $user->name = 'Admin';
      $user->email = 'admin@admin.com';
      $user->password= 'default';
      $user->active= true;
      $user->role = 'admin';
      $user->modified = 

      $UsersTable->save($user);
    }
}
