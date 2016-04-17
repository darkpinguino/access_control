<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DoorsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DoorsController Test Case
 */
class DoorsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.people',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.access_requests'
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
