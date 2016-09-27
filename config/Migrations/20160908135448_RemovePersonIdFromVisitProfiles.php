<?php
use Migrations\AbstractMigration;

class RemovePersonIdFromVisitProfiles extends AbstractMigration
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
        $table = $this->table('visit_profiles');
        $table->removeColumn('person_id');
        $table->update();
    }
}
