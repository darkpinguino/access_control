<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
				'username' => 'admin',
				'password' => '$2y$10$QJ86VtQTyqePX2tH74TfM.WAv5eLkN6KBlbEMFt.SxGJJCnXscwq2',
				'userRole_id' => '1',
				'person_id' => '1',
				'company_id' => '1',
				'doorCharge_id' => 0,
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('users');
		$table->insert($data)->save();
	}
}
