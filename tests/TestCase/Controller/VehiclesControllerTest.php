<?php
namespace App\Test\TestCase\Controller;

use App\Controller\VehiclesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\VehiclesController Test Case
 */
class VehiclesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vehicles',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.doors',
        'app.access_requests',
        'app.sensors',
        'app.sensor_types',
        'app.sensor_data',
        'app.people',
        'app.vehicle_access_requests'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
