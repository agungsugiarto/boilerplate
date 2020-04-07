<?php

namespace Tests\Controllers;

use agungsugiarto\boilerplate\Controllers\Users\PermissionController;
use Tests\Support\AuthTestCase;

class PermissionControllerTest extends AuthTestCase
{
    public function testIndexPermission()
    {
        $result = $this->controller(PermissionController::class)
            ->execute('index');
        
        $this->assertTrue($result->isOK());
    }
}