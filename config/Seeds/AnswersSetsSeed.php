<?php
use Migrations\AbstractSeed;

/**
 * AnswersSets seed.
 */
class AnswersSetsSeed extends AbstractSeed
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
				'form_id' => '-1',
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			]
		];

		$table = $this->table('answers_sets');
		$table->insert($data)->save();
	}
}
