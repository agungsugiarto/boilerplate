<?php

namespace Tests\Controllers;

use App\Controllers\Home;
use CodeIgniter\Test\ControllerTester;
use Tests\Support\AuthTestCase;

class ExampleTest extends AuthTestCase
{
    use ControllerTester;

    public function testIndexHome()
    {
        $result = $this->controller(Home::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }
}
