<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReasonVisitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReasonVisitsTable Test Case
 */
class ReasonVisitsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReasonVisitsTable
     */
    public $ReasonVisits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reason_visits'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReasonVisits') ? [] : ['className' => 'App\Model\Table\ReasonVisitsTable'];
        $this->ReasonVisits = TableRegistry::get('ReasonVisits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReasonVisits);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
