<?php
use Migrations\AbstractMigration;

class CreateDoors extends AbstractMigration
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
        $table = $this->table('doors');
        $table->addColumn('name', 'string', [
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('location', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
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
