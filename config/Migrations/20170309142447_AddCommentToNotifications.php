<?php
use Migrations\AbstractMigration;

class AddCommentToNotifications extends AbstractMigration
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
		$table = $this->table('notifications');
		$table->addColumn('comment', 'string', [
			'default' => null,
			'limit' => 255,
			'null' => false,
		]);
		$table->update();
	}
}
