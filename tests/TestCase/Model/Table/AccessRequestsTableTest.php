<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessRequestsTable Test Case
 */
class AccessRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessRequestsTable
     */
    public $AccessRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_requests',
        'app.people',
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.persons',
        'app.access_role_peoples',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.sensors_types',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.access_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccessRequests') ? [] : ['className' => 'App\Model\Table\AccessRequestsTable'];
        $this->AccessRequests = TableRegistry::get('AccessRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessRequests);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
