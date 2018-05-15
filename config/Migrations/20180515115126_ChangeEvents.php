<?php
use Migrations\AbstractMigration;

class ChangeEvents extends AbstractMigration
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
      $table = $this->table('events');
      $table->removeColumn('laburpena')
            ->removeColumn('prezioa')
            ->removeColumn('sarrerak')
            ->removeColumn('web')
            ->removeColumn('fitx')
              ->save();

          $table->addColumn('laburpena', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => true,
          ]);
          $table->addColumn('prezioa', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => true,
          ]);
          $table->addColumn('sarrerak', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => true,
          ]);
          $table->addColumn('web', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => true,
          ]);
          $table->addColumn('fitx', 'string', [
              'default' => null,
              'limit' => 255,
              'null' => true,
          ]);

          $table->save();
    }
}
