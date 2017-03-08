<?php
use Migrations\AbstractSeed;

/**
 * AccessStatus seed.
 */
class AccessStatusSeed extends AbstractSeed
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
				'status' => 'Permitido',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '2',
				'status' => 'Pendiente',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '3',
				'status' => 'Denegado',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('access_status');
		$table->insert($data)->save();
	}
}
