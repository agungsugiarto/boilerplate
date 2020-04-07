<?php

namespace Tests\Controllers;

use agungsugiarto\boilerplate\Controllers\Users\UserController;
use Tests\Support\AuthTestCase;

class UserControllerTest extends AuthTestCase
{
    public function testIndexUser()
    {
        $result = $this->controller(UserController::class)
            ->execute('index');
        
        $this->assertTrue($result->isOK());
    }
}