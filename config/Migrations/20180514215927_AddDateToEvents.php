<?php
use Migrations\AbstractMigration;

class AddDateToEvents extends AbstractMigration
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
        $table->addColumn('hasiData', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bukData', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('hasiOrdua', 'time', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bukOrdua', 'time', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
