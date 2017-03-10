<?php
use Migrations\AbstractMigration;

class RemovePersonIdAndDriverFromVehicleLocations extends AbstractMigration
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
        $table = $this->table('vehicle_locations');
        $table->removeColumn('person_id');
        $table->removeColumn('driver');
        $table->update();
    }
}
