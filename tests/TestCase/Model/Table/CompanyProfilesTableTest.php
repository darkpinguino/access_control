<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyProfilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyProfilesTable Test Case
 */
class CompanyProfilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyProfilesTable
     */
    public $CompanyProfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_profiles',
        'app.profiles',
        'app.companies',
        'app.access_roles',
        'app.people',
        'app.company_people',
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
        'app.vehicle_locations',
        'app.vehicle_people_locations',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.access_status',
        'app.visit_profiles',
        'app.reason_visits',
        'app.access_role_people',
        'app.users',
        'app.user_roles',
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
        $config = TableRegistry::exists('CompanyProfiles') ? [] : ['className' => 'App\Model\Table\CompanyProfilesTable'];
        $this->CompanyProfiles = TableRegistry::get('CompanyProfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyProfiles);

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
