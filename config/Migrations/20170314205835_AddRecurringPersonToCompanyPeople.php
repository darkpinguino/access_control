<?php
use Migrations\AbstractMigration;

class AddRecurringPersonToCompanyPeople extends AbstractMigration
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
        $table = $this->table('company_people');
        $table->addColumn('recurring_person', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
