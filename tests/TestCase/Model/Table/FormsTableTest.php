<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormsTable Test Case
 */
class FormsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormsTable
     */
    public $Forms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.forms',
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
        'app.vehicle_locations',
        'app.vehicles',
        'app.vehicle_types',
        'app.vehicle_access_request',
        'app.access_request',
        'app.access_status',
        'app.vehicle_people_locations',
        'app.visit_profiles',
        'app.reason_visits',
        'app.access_role_people',
        'app.users',
        'app.user_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Forms') ? [] : ['className' => 'App\Model\Table\FormsTable'];
        $this->Forms = TableRegistry::get('Forms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Forms);

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
