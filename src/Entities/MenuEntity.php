<?php

namespace agungsugiarto\boilerplate\Entities;

use agungsugiarto\boilerplate\Models\MenuModel;
use CodeIgniter\Entity;

class MenuEntity extends Entity
{
    /**
     * Define properties that are automatically converted to Time instances.
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Activate menu.
     *
     * @return $this
     */
    public function activate()
    {
        $this->attributes['active'] = 1;

        return $this;
    }

    /**
     * Unactivate menu.
     *
     * @return $this
     */
    public function deactivate()
    {
        $this->attributes['active'] = 0;

        return $this;
    }

    /**
     * Checks to see if a menu is active.
     *
     * @return bool
     */
    public function isActivated(): bool
    {
        return isset($this->attributes['active']) && $this->attributes['active'] == true;
    }

    /**
     * Check to see max value from fields sequence.
     *
     * @return int
     */
    public function sequence(): int
    {
        return (new MenuModel())->selectMax('sequence')->get()->getRow()->sequence;
    }
}
