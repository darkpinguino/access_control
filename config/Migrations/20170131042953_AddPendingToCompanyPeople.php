<?php
use Migrations\AbstractMigration;

class AddPendingToCompanyPeople extends AbstractMigration
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
        $table->addColumn('pending', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
