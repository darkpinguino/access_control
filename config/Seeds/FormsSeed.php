<?php
use Migrations\AbstractSeed;

/**
 * Forms seed.
 */
class FormsSeed extends AbstractSeed
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
				'id' => '-1',
				'name' => '',
				'description' => '', 
				'company_id' => '-1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('forms');
		$table->insert($data)->save();
	}
}
