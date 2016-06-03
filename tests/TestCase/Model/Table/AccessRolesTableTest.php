<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessRolesTable Test Case
 */
class AccessRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessRolesTable
     */
    public $AccessRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_roles',
        'app.users',
        'app.companies',
        'app.doors',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.people',
        'app.vehicles',
        'app.vehicle_access_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccessRoles') ? [] : ['className' => 'App\Model\Table\AccessRolesTable'];
        $this->AccessRoles = TableRegistry::get('AccessRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessRoles);

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
