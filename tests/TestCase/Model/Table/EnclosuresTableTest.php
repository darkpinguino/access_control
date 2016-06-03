<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnclosuresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnclosuresTable Test Case
 */
class EnclosuresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnclosuresTable
     */
    public $Enclosures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enclosures',
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.people',
        'app.access_role_people',
        'app.access_role_doors',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.access_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Enclosures') ? [] : ['className' => 'App\Model\Table\EnclosuresTable'];
        $this->Enclosures = TableRegistry::get('Enclosures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enclosures);

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
