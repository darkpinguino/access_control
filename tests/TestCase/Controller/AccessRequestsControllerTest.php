<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AccessRequestsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AccessRequestsController Test Case
 */
class AccessRequestsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.access_requests',
        'app.people',
        'app.doors',
        'app.companies',
        'app.access_roles',
        'app.users',
        'app.access_role_doors',
        'app.persons',
        'app.access_role_peoples',
        'app.sensor_data',
        'app.sensor_types',
        'app.sensors',
        'app.sensors_types',
        'app.vehicles',
        'app.vehicle_access_requests',
        'app.access_statuses'
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
