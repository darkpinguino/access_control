<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CompanyVehiclesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CompanyVehiclesController Test Case
 */
class CompanyVehiclesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_vehicles',
        'app.vehicles',
        'app.vehicle_types',
        'app.company_people',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.access_role_people',
        'app.doors',
        'app.enclosures',
        'app.people_locations',
        'app.vehicle_locations',
        'app.vehicle_people_locations',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.users',
        'app.user_roles',
        'app.forms',
        'app.profiles',
        'app.company_profiles',
        'app.visit_profiles',
        'app.reason_visits',
        'app.vehicle',
        'app.vehicle_authorizations',
        'app.vehicle_access_request',
        'app.access_request',
        'app.access_status',
        'app.vehicle_profiles'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
