<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkAreasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkAreasTable Test Case
 */
class WorkAreasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkAreasTable
     */
    public $WorkAreas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.work_areas',
        'app.company_people',
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
        'app.profiles',
        'app.company_profiles',
        'app.visit_profiles',
        'app.reason_visits',
        'app.contractor_companies',
        'app.vehicle'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WorkAreas') ? [] : ['className' => 'App\Model\Table\WorkAreasTable'];
        $this->WorkAreas = TableRegistry::get('WorkAreas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkAreas);

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
}
