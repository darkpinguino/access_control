<?php
use Migrations\AbstractMigration;

class CreatePeople extends AbstractMigration
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
        $table = $this->table('people');
        $table->addColumn('rut', 'string', [
                'limit' => 50,
                'null' => false,
        ]);
        $table->addColumn('name', 'string', [
                'limit' => 50,
                'null' => false,
        ]);
        $table->addColumn('lastname', 'string', [
                'limit' => 255,
                'null' => false,
        ]);
        $table->addColumn('phone', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
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
