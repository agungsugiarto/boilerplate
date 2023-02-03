<?php

namespace julio101290\boilerplate\Commands;

use CodeIgniter\CLI\BaseCommand;
use Config\Database;

/**
 * Class InstallCommand.
 */
class InstallCommand extends BaseCommand
{
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
    protected $name = 'boilerplate:install';

    /**
     * The command's short description.
     *
     * @var string
     */
    protected $description = 'Db install for basic boilerplate data.';

    /**
     * The command's usage.
     *
     * @var string
     */
    protected $usage = 'boilerplate:install';

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
        try {
            $this->call('boilerplate:publish');
            // migrate all first
            $this->call('migrate');
            // then seed data
            $seeder = Database::seeder();
            $seeder->call('julio101290\boilerplate\Database\Seeds\BoilerplateSeeder');
        } catch (\Exception $e) {
            $this->showError($e);
        }
    }
}
