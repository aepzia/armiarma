<?php
use Migrations\AbstractMigration;

class CreateReaders extends AbstractMigration
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
        $table->addColumn('ekitaldiinfo', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('maiztasuna', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('hizkuntzapolitikainfo', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('izena', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('abizena', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->create();
    }
}
