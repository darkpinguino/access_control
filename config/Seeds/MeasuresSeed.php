<?php
use Migrations\AbstractSeed;

/**
 * Measures seed.
 */
class MeasuresSeed extends AbstractSeed
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
				'measure' => 'kilos',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '2',
				'measure' => 'Litros',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '3',
				'measure' => 'Metros',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '4',
				'measure' => 'Celsius',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '5',
				'measure' => 'Toneladas',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('measures');
		$table->insert($data)->save();
	}
}
