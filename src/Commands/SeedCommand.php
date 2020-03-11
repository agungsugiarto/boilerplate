<?php

namespace agungsugiarto\boilerplate\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Exception;

class SeedCommand extends BaseCommand
{
    // helper('filesystem');
    /**
     * The group the command is lumped under
     * when listing commands.
     *
     * @var string
     */
    protected $group = 'boilerplate';

    /**
     * The command's name.
     *
     * @var string
     */
    protected $name = 'boilerplate:seed';

    /**
     * The command's short description.
     *
     * @var string
     */
    protected $description = 'Db seed for basic boilerplate data.';

    /**
     * The command's usage.
     *
     * @var string
     */
    protected $usage = 'boilerplate:seed';

    /**
     * The commamd's argument.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The command's options.
     *
     * @var array
     */
    protected $options = [];

    //--------------------------------------------------------------------

    /**
     * Displays the help for the spark cli script itself.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $params = ['agungsugiarto\boilerplate\Database\Seeds\BoilerplateSeeder'];

        try {
            $this->call('db:seed', $params);
        } catch (\Exception $e) {
            $this->showError($e);
        }
    }
}
