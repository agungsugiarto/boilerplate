<?php

namespace Tests\Controllers;

use agungsugiarto\boilerplate\Controllers\Users\PermissionController;
use CodeIgniter\Test\CIDatabaseTestCase;
use CodeIgniter\Test\ControllerTester;

class PermissionTest extends CIDatabaseTestCase
{
    use ControllerTester;
    
    public function testIndexPermission()
    {
        $result = $this->controller(PermissionController::class)
                        ->execute('index');
                        
        $this->assertTrue($result->isOK());
    }
}