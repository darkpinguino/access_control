<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessRequestTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessRequestTable Test Case
 */
class AccessRequestTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessRequestTable
     */
    public $AccessRequest;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_request',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.doors',
        'app.access_requests',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
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
        $config = TableRegistry::exists('AccessRequest') ? [] : ['className' => 'App\Model\Table\AccessRequestTable'];
        $this->AccessRequest = TableRegistry::get('AccessRequest', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessRequest);

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
