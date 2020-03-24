<?php

namespace agungsugiarto\boilerplate\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Autoload;

/**
 * Class PublishCommand.
 */
class PublishCommand extends BaseCommand
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
    protected $name = 'boilerplate:publish';

    /**
     * The command's short description.
     *
     * @var string
     */
    protected $description = 'Publish assets plugin into the current public directory.';

    /**
     * The command's usage.
     *
     * @var string
     */
    protected $usage = 'boilerplate:publish';

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

    /**
     * The path to agungsugiarto\boilerplate\src directory.
     *
     * @var string
     */
    protected $sourcePath;

    //--------------------------------------------------------------------

    /**
     * Displays the help for the spark cli script itself.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $this->determineSourcePath();

        // Controller
        if (CLI::prompt('Publish Controller?', ['y', 'n']) == 'y') {
            $this->publishController();
        }

        // Views
        if (CLI::prompt('Publish Views?', ['y', 'n']) == 'y') {
            $this->publishViews();
        }

        // Config
        if (CLI::prompt('Publish Config file?', ['y', 'n']) == 'y') {
            $this->publishConfig();
        }
    }

    protected function publishController()
    {
        $path = "{$this->sourcePath}/Controllers/AuthController.php";

        $content = file_get_contents($path);
        $content = $this->replaceNamespace($content, 'Myth\Auth\Controllers', 'Controllers');

        $this->writeFile('Controllers/AuthController.php', $content);
    }

    protected function publishViews()
    {
        $map = directory_map($this->sourcePath.'/Views');
        $prefix = '';

        foreach ($map as $key => $view) {
            if (is_array($view)) {
                $oldPrefix = $prefix;
                $prefix .= $key;

                foreach ($view as $file) {
                    $this->publishView($file, $prefix);
                }

                $prefix = $oldPrefix;

                continue;
            }

            $this->publishView($view, $prefix);
        }
    }

    protected function publishView($view, string $prefix = '')
    {
        $path = "{$this->sourcePath}/Views/{$prefix}{$view}";
        $namespace = defined('APP_NAMESPACE') ? APP_NAMESPACE : 'App';

        $content = file_get_contents($path);
        $content = str_replace('agungsugiarto\boilertplate\Views', $namespace.'\Authentication', $content);

        $this->writeFile("Views/{$prefix}{$view}", $content);
    }

    protected function publishConfig()
    {
        $path = "{$this->sourcePath}/Config/Auth.php";

        $content = file_get_contents($path);
        $content = str_replace('namespace Myth\Auth\Config', 'namespace Config', $content);
        $content = str_replace('extends BaseConfig', "extends \Myth\Auth\Config\Auth", $content);

        $this->writeFile('Config/Auth.php', $content);
    }

    //--------------------------------------------------------------------
    // Utilities
    //--------------------------------------------------------------------

    /**
     * Replaces the Myth\Auth namespace in the published
     * file with the applications current namespace.
     *
     * @param string $contents
     * @param string $originalNamespace
     * @param string $newNamespace
     *
     * @return string
     */
    protected function replaceNamespace(string $contents, string $originalNamespace, string $newNamespace): string
    {
        $appNamespace = APP_NAMESPACE;
        $originalNamespace = "namespace {$originalNamespace}";
        $newNamespace = "namespace {$appNamespace}\\{$newNamespace}";

        return str_replace($originalNamespace, $newNamespace, $contents);
    }

    /**
     * Determines the current source path from which all other files are located.
     */
    protected function determineSourcePath()
    {
        $this->sourcePath = realpath(__DIR__.'/../');

        if ($this->sourcePath == '/' || empty($this->sourcePath)) {
            CLI::error('Unable to determine the correct source directory. Bailing.');
            exit();
        }
    }

    /**
     * Write a file, catching any exceptions and showing a
     * nicely formatted error.
     *
     * @param string $path
     * @param string $content
     */
    protected function writeFile(string $path, string $content)
    {
        $config = new Autoload();
        $appPath = $config->psr4[APP_NAMESPACE];

        $directory = dirname($appPath.$path);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        try {
            write_file($appPath.$path, $content);
        } catch (\Exception $e) {
            $this->showError($e);
            exit();
        }

        $path = str_replace($appPath, '', $path);

        CLI::write(CLI::color('  created: ', 'green').$path);
    }
}
