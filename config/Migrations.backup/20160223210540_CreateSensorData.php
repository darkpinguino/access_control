<?php
use Migrations\AbstractMigration;

class CreateSensorData extends AbstractMigration
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
        $table = $this->table('sensor_data');
        $table->addColumn('sensor_type_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('people_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('data', 'string', [
            'limit' => 255,
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
