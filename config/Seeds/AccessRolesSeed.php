<?php
use Migrations\AbstractSeed;

/**
 * AccessRoles seed.
 */
class AccessRolesSeed extends AbstractSeed
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
				'name' => 'Por defecto',
				'description' => 'rol por defecto',
				'company_id' => '-1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('access_roles');
		$table->insert($data)->save();
	}
}
