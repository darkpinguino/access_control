<?php
use Migrations\AbstractSeed;

/**
 * CompanyProfiles seed.
 */
class CompanyProfilesSeed extends AbstractSeed
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
				'profile_id' => '1',
				'company_id' => '1',
				'maxTime' => '8',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'profile_id' => '2',
				'company_id' => '1',
				'maxTime' => '8',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'profile_id' => '3',
				'company_id' => '1',
				'maxTime' => '8',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('company_profiles');
		$table->insert($data)->save();
	}
}
