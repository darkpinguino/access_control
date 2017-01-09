<?php
use Migrations\AbstractMigration;

class AddAcctionToVehicleAccessRequest extends AbstractMigration
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
        $table = $this->table('vehicle_access_request');
        $table->addColumn('action', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
