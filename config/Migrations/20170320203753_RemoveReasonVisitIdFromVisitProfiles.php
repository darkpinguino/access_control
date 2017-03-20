<?php
use Migrations\AbstractMigration;

class RemoveReasonVisitIdFromVisitProfiles extends AbstractMigration
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
        $table->removeColumn('reason_visit_id');
        $table->update();
    }
}
