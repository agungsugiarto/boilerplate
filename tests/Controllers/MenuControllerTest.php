<?php

namespace Tests\Controllers;

use agungsugiarto\boilerplate\Controllers\Users\MenuController;
use Tests\Support\AuthTestCase;

class MenuControllerTest extends AuthTestCase
{
    public function testIndexPermission()
    {
        $result = $this->controller(MenuController::class)
            ->execute('index');
        
        $this->assertTrue($result->isOK());
    }
}