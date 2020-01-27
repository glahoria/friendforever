<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FriendRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FriendRequestsTable Test Case
 */
class FriendRequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FriendRequestsTable
     */
    public $FriendRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FriendRequests',
        'app.RequestFroms',
        'app.RequestTos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FriendRequests') ? [] : ['className' => FriendRequestsTable::class];
        $this->FriendRequests = TableRegistry::getTableLocator()->get('FriendRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FriendRequests);

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
