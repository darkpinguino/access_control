<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AlertsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AlertsController Test Case
 */
class AlertsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.alerts',
        'app.access_request',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.access_role_people',
        'app.person_to_visits',
        'app.company_people',
        'app.profiles',
        'app.company_profiles',
        'app.contractor_companies',
        'app.work_areas',
        'app.vehicle',
        'app.vehicle_authorizations',
        'app.vehicles',
        'app.vehicle_types',
        'app.company_vehicles',
        'app.vehicle_profiles',
        'app.vehicle_access_request',
        'app.vehicle_locations',
        'app.enclosures',
        'app.people_locations',
        'app.inside_alerts',
        'app.access_resquest',
        'app.notifications',
        'app.users',
        'app.user_roles',
        'app.doors',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.user_notifications',
        'app.access_denied_alerts',
        'app.vehicle_people_locations',
        'app.visit_profiles',
        'app.reason_visits',
        'app.forms',
        'app.access_status'
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
