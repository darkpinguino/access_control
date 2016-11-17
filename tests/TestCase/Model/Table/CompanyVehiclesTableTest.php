<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyVehiclesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyVehiclesTable Test Case
 */
class CompanyVehiclesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyVehiclesTable
     */
    public $CompanyVehicles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_vehicles',
        'app.vehicles',
        'app.companies',
        'app.access_roles',
        'app.people',
        'app.company_people',
        'app.profiles',
        'app.vehicle_authorizations',
        'app.people_locations',
        'app.enclosures',
        'app.doors',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.vehicle_locations',
        'app.vehicle_people_locations',
        'app.visit_profiles',
        'app.reason_visits',
        'app.access_role_people',
        'app.users',
        'app.user_roles',
        'app.vehicle_types',
        'app.vehicle_authorizations_vehicles',
        'app.vehicle_access_request',
        'app.access_request',
        'app.access_status'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompanyVehicles') ? [] : ['className' => 'App\Model\Table\CompanyVehiclesTable'];
        $this->CompanyVehicles = TableRegistry::get('CompanyVehicles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyVehicles);

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
