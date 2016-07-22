<?php
use Migrations\AbstractMigration;

class AddExpirationToAccessRolePeople extends AbstractMigration
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
        $table = $this->table('access_role_people');
        $table->addColumn('expiration', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }
}
