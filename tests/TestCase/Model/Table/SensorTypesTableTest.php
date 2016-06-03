<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SensorTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SensorTypesTable Test Case
 */
class SensorTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SensorTypesTable
     */
    public $SensorTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sensor_types',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.doors',
        'app.access_requests',
        'app.sensors',
        'app.people',
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
        $config = TableRegistry::exists('SensorTypes') ? [] : ['className' => 'App\Model\Table\SensorTypesTable'];
        $this->SensorTypes = TableRegistry::get('SensorTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SensorTypes);

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
