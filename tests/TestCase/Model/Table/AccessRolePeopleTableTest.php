<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessRolePeopleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessRolePeopleTable Test Case
 */
class AccessRolePeopleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessRolePeopleTable
     */
    public $AccessRolePeople;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_role_people',
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
        $config = TableRegistry::exists('AccessRolePeople') ? [] : ['className' => 'App\Model\Table\AccessRolePeopleTable'];
        $this->AccessRolePeople = TableRegistry::get('AccessRolePeople', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccessRolePeople);

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
