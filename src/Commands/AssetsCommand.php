<?php

namespace agungsugiarto\boilerplate\Commands;

use agungsugiarto\boilerplate\Utility\FilteUtility;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * Class assetsCommand.
 */
class AssetsCommand extends BaseCommand
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
    protected $name = 'boilerplate:assets';

    /**
     * The command's short description.
     *
     * @var string
     */
    protected $description = 'Publish assets to public project directory.';

    /**
     * The command's usage.
     *
     * @var string
     */
    protected $usage = 'boilerplate:assets';

    /**
     * Displays the help for the spark cli script itself.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        try {
            CLI::write('Trying install module');

            $this->publish();

            CLI::write('Module have been installed');
        } catch (\Exception  $e) {
            $this->showError($e);
        }
    }

    private function publish()
    {
        $filesystem = new FilteUtility();

        $filesystem->recursiveCopy(realpath(__DIR__.'/../../resource/build'), ROOTPATH.'public');
    }
}
