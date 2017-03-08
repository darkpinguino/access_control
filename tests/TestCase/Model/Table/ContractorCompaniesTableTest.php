<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContractorCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContractorCompaniesTable Test Case
 */
class ContractorCompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContractorCompaniesTable
     */
    public $ContractorCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contractor_companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContractorCompanies') ? [] : ['className' => 'App\Model\Table\ContractorCompaniesTable'];
        $this->ContractorCompanies = TableRegistry::get('ContractorCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContractorCompanies);

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
