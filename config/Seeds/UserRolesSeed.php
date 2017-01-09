<?php
use Migrations\AbstractSeed;

/**
 * UserRoles seed.
 */
class UserRolesSeed extends AbstractSeed
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
				'role' => 'Administrador',
				'description' => 'Rol de administrador',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '2',
				'role' => 'Administrador Local',
				'description' => 'Rol de administrador local',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '3',
				'role' => 'Supervisor',
				'description' => 'Rol de supervisor',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '4',
				'role' => 'Guardia tipo 1',
				'description' => 'Rol de guardia tipo 1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			],
			[
				'id' => '5',
				'role' => 'Guardia tipo 2',
				'description' => 'Rol de guardia tipo 2',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('user_roles');
		$table->insert($data)->save();
	}
}
