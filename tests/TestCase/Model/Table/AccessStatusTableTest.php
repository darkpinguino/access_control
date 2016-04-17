<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessStatusTable Test Case
 */
class AccessStatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessStatusTable
     */
    public $AccessStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_status',
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
        $config = TableRegistry::exists('AccessStatus') ? [] : ['className' => 'App\Model\Table\AccessStatusTable'];
        $this->AccessStatus = TableRegistry::get('AccessStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessStatus);

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
