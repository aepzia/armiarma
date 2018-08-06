<?php
use Migrations\AbstractMigration;

class AddRepeatableToEvents extends AbstractMigration
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
        $table->addColumn('repeatable', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('frecuency', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
