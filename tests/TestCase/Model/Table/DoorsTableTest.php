<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DoorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DoorsTable Test Case
 */
class DoorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DoorsTable
     */
    public $Doors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.people',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.vehicles',
        'app.access_requests',
        'app.access_role_doors'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Doors') ? [] : ['className' => 'App\Model\Table\DoorsTable'];
        $this->Doors = TableRegistry::get('Doors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Doors);

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
