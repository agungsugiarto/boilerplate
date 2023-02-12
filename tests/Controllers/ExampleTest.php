<?php

namespace Tests\Controllers;

use App\Controllers\Home;
use CodeIgniter\Test\ControllerTestTrait;
use Tests\Support\AuthTestCase;

/**
 * @internal
 */
final class ExampleTest extends AuthTestCase
{
    use ControllerTestTrait;

    public function testIndexHome()
    {
        $result = $this->controller(Home::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }
}
