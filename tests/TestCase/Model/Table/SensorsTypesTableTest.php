<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SensorsTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SensorsTypesTable Test Case
 */
class SensorsTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SensorsTypesTable
     */
    public $SensorsTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sensors_types',
        'app.companies',
        'app.access_roles',
        'app.doors',
        'app.access_requests',
        'app.access_role_doors',
        'app.sensors',
        'app.sensor_types',
        'app.persons',
        'app.access_role_peoples',
        'app.sensor_data',
        'app.vehicles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SensorsTypes') ? [] : ['className' => 'App\Model\Table\SensorsTypesTable'];
        $this->SensorsTypes = TableRegistry::get('SensorsTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SensorsTypes);

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
