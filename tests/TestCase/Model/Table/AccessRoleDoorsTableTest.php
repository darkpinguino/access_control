<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessRoleDoorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessRoleDoorsTable Test Case
 */
class AccessRoleDoorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessRoleDoorsTable
     */
    public $AccessRoleDoors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_role_doors',
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.people',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.access_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccessRoleDoors') ? [] : ['className' => 'App\Model\Table\AccessRoleDoorsTable'];
        $this->AccessRoleDoors = TableRegistry::get('AccessRoleDoors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessRoleDoors);

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
