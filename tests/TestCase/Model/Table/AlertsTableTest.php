<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlertsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlertsTable Test Case
 */
class AlertsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlertsTable
     */
    public $Alerts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.alerts',
        'app.access_requests',
        'app.notifications',
        'app.companies',
        'app.access_roles',
        'app.people',
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
        'app.access_request',
        'app.doors',
        'app.enclosures',
        'app.people_locations',
        'app.inside_alerts',
        'app.access_resquest',
        'app.vehicle_locations',
        'app.vehicle_people_locations',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.access_status',
        'app.visit_profiles',
        'app.reason_visits',
        'app.person_to_visits',
        'app.access_role_people',
        'app.access_denied_alerts',
        'app.users',
        'app.user_roles',
        'app.user_notifications',
        'app.forms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Alerts') ? [] : ['className' => 'App\Model\Table\AlertsTable'];
        $this->Alerts = TableRegistry::get('Alerts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Alerts);

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
