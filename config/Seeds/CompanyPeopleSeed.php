<?php
use Migrations\AbstractSeed;

/**
 * CompanyPeople seed.
 */
class CompanyPeopleSeed extends AbstractSeed
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
				'person_id' => '1',
				'company_id' => '1',
				'profile_id' => '2',
				'is_visited' => '1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('company_people');
		$table->insert($data)->save();
	}
}
