<?php
use Migrations\AbstractMigration;

class RemoveFecuencyFromEvents extends AbstractMigration
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
        $table->removeColumn('frecuency');
        $table->update();
    }
}
