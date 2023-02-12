<?php

namespace Tests\Support;

use CodeIgniter\Session\Handlers\ArrayHandler;
use CodeIgniter\Session\Session;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Mock\MockSession;
use Config\Services;

/**
 * @internal
 */
final class SessionTestCase extends CIUnitTestCase
{
    use DatabaseTestTrait;

    private MockSession $mockSession;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockSession();
    }

    /**
     * Pre-loads the mock session driver into $this->session.
     *
     * @return void
     */
    protected function mockSession()
    {
        require_once SYSTEMPATH . 'Test/Mock/MockSession.php';
        $config            = config('App');
        $this->mockSession = new MockSession(new ArrayHandler($config, '0.0.0.0'), $config);
        Services::injectMock('session', $this->mockSession);
    }
}
