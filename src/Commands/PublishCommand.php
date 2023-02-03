<?php

namespace julio101290\boilerplate\Commands;

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
        $this->publishConfig();
        $this->publishMigration();
    }

    protected function publishConfig()
    {
        $path = "{$this->sourcePath}/Config/Boilerplate.php";

        $content = file_get_contents($path);
        $content = str_replace('namespace julio101290\boilerplate\Config', 'namespace Config', $content);

        $this->writeFile('Config/Boilerplate.php', $content);
    }

    protected function publishMigration()
    {
        $map = directory_map($this->sourcePath.'/Database/Migrations');

        foreach ($map as $file) {
            $content = file_get_contents("{$this->sourcePath}/Database/Migrations/{$file}");
            $content = str_replace('namespace julio101290\boilerplate\Database\Migrations', 'namespace '.APP_NAMESPACE.'\Database\Migrations', $content);

            $this->writeFile("Database/Migrations/{$file}", $content);
        }
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
