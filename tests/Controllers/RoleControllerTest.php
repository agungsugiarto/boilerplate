<?php

namespace Tests\Controllers;

use agungsugiarto\boilerplate\Controllers\Users\RoleController;
use Tests\Support\AuthTestCase;

class RoleControllerTest extends AuthTestCase
{
    public function testIndexRole()
    {
        $result = $this->controller(RoleController::class)
            ->execute('index');
        
        $this->assertTrue($result->isOK());
    }
}