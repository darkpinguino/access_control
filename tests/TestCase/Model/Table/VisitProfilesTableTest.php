<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VisitProfilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VisitProfilesTable Test Case
 */
class VisitProfilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VisitProfilesTable
     */
    public $VisitProfiles;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VisitProfiles') ? [] : ['className' => 'App\Model\Table\VisitProfilesTable'];
        $this->VisitProfiles = TableRegistry::get('VisitProfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VisitProfiles);

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
