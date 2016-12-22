<?php
use Migrations\AbstractMigration;

class RemoveCompnayIdFromVehicleProfile extends AbstractMigration
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
        $table = $this->table('vehicle_profiles');
        $table->removeColumn('company_id');
        $table->update();
    }
}
