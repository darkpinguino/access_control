<?php
use Migrations\AbstractMigration;

class AddAccessRequestIdToPeopleLocations extends AbstractMigration
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
		$table = $this->table('people_locations');
		$table->addColumn('access_request_id', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->update();
	}
}
