<?php
use Migrations\AbstractSeed;

/**
 * VehicleProfile seed.
 */
class VehicleProfileSeed extends AbstractSeed
{
	/**
	 * Run Method.
	 *
	 * Write your database seeder using this method.
	 *
	 * More information on writing seeds is available here:
	 * http://docs.phinx.org/en/latest/seeding.html
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			[
				'id' => '1',
				'name' => 'Visita',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '2',
				'name' => 'Empresa',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '3',
				'name' => 'Transporte',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
		];

		$table = $this->table('vehicle_profiles');
		$table->insert($data)->save();
	}
}
