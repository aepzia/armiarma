<?php
use Migrations\AbstractMigration;

class AddnewVarToReaders extends AbstractMigration
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
        $table = $this->table('readers');
        $table->addColumn('ahobizu', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bolondres', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
