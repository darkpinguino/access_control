<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyPeopleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyPeopleTable Test Case
 */
class CompanyPeopleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyPeopleTable
     */
    public $CompanyPeople;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_people',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.access_role_people',
        'app.doors',
        'app.enclosures',
        'app.people_locations',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.users',
        'app.user_roles',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.profiles',
        'app.visit_profiles',
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
        $config = TableRegistry::exists('CompanyPeople') ? [] : ['className' => 'App\Model\Table\CompanyPeopleTable'];
        $this->CompanyPeople = TableRegistry::get('CompanyPeople', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyPeople);

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
