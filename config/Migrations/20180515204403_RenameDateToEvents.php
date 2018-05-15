<?php
use Migrations\AbstractMigration;

class RenameDateToEvents extends AbstractMigration
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
      $table->removeColumn('hasData')
            ->removeColumn('bukData')
            ->removeColumn('hasOrdua')
            ->removeColumn('bukOrdua')
              ->save();
      $table->addColumn('hasdata', 'date', [
          'default' => null,
          'null' => false,
      ]);
      $table->addColumn('bukdata', 'date', [
          'default' => null,
          'null' => false,
      ]);
      $table->addColumn('hasordua', 'time', [
          'default' => null,
          'null' => false,
      ]);
      $table->addColumn('bukordua', 'time', [
          'default' => null,
          'null' => false,
      ]);
      $table->update();
    }
}
