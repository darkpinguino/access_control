<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeopleLocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeopleLocationsTable Test Case
 */
class PeopleLocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PeopleLocationsTable
     */
    public $PeopleLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.people_locations',
        'app.people',
        'app.companies',
        'app.access_roles',
        'app.access_role_people',
        'app.doors',
        'app.enclosures',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.vehicles',
        'app.vehicle_access_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PeopleLocations') ? [] : ['className' => 'App\Model\Table\PeopleLocationsTable'];
        $this->PeopleLocations = TableRegistry::get('PeopleLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PeopleLocations);

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
