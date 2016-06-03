<?php
use Migrations\AbstractMigration;

class CreateSensors extends AbstractMigration
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
        $table = $this->table('sensors');
        $table->addColumn('code', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('sensor_type_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('door_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('company_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
