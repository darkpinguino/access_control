<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VehicleLocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VehicleLocationsTable Test Case
 */
class VehicleLocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VehicleLocationsTable
     */
    public $VehicleLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vehicle_locations',
        'app.vehicles',
        'app.companies',
        'app.access_roles',
        'app.people',
        'app.company_people',
        'app.profiles',
        'app.people_locations',
        'app.enclosures',
        'app.doors',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.visit_profiles',
        'app.reason_visits',
        'app.access_role_people',
        'app.users',
        'app.user_roles',
        'app.vehicle_types',
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
        $config = TableRegistry::exists('VehicleLocations') ? [] : ['className' => 'App\Model\Table\VehicleLocationsTable'];
        $this->VehicleLocations = TableRegistry::get('VehicleLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VehicleLocations);

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
