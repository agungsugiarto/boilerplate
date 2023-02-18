<?php

namespace agungsugiarto\boilerplate\Entities;

use Myth\Auth\Entities\User as MythUser;

class User extends MythUser
{
    /**
     * Default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'first_name' => 'Guest',
        'last_name'  => 'User',
    ];

    /**
     * Returns a full name: "first last"
     */
    public function getName(): string
    {
        return trim(trim($this->attributes['first_name']) . ' ' . trim($this->attributes['last_name']));
    }
}
