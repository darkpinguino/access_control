<?php
use Migrations\AbstractMigration;

class AddEnclosureIdToDoors extends AbstractMigration
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
        $table->addColumn('enclosure_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->update();
    }
}
