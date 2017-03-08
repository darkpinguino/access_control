<?php
use Migrations\AbstractMigration;

class RemoveCompnayIdFromProfiles extends AbstractMigration
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
        $table = $this->table('profiles');
        $table->removeColumn('company_id');
        $table->update();
    }
}
