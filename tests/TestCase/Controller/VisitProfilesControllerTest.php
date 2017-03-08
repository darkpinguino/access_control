<?php
namespace App\Test\TestCase\Controller;

use App\Controller\VisitProfilesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\VisitProfilesController Test Case
 */
class VisitProfilesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.visit_profiles',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.access_role_people',
        'app.doors',
        'app.enclosures',
        'app.people_locations',
        'app.vehicle_locations',
        'app.vehicles',
        'app.vehicle_types',
        'app.company_people',
        'app.profiles',
        'app.company_profiles',
        'app.contractor_companies',
        'app.work_areas',
        'app.vehicle',
        'app.vehicle_authorizations',
        'app.company_vehicles',
        'app.vehicle_profiles',
        'app.vehicle_access_request',
        'app.access_request',
        'app.access_status',
        'app.vehicle_people_locations',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.users',
        'app.user_roles',
        'app.forms',
        'app.reason_visits'
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
