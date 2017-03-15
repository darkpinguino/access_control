<?php
use Migrations\AbstractMigration;

class AddAnswersSetsToVehicleAccessRequest extends AbstractMigration
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
		$table = $this->table('vehicle_access_request');
		$table->addColumn('answer_set_id', 'integer', [
			'default' => null,
			'limit' => 11,
			'null' => false,
		]);
		$table->update();
	}
}
