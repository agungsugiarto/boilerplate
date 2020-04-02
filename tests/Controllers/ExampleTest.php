<?php

namespace Tests\Controllers;

use App\Controllers\Home;
use CodeIgniter\Test\CIDatabaseTestCase;
use CodeIgniter\Test\ControllerTester;

class ExampleTest extends CIDatabaseTestCase
{
    use ControllerTester;
    
    public function testIndexHome()
    {
        $result = $this->controller(Home::class)
                        ->execute('index');
                        
        $this->assertTrue($result->isOK());
    }
}