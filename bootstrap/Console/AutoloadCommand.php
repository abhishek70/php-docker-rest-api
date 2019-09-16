<?php
namespace Bootstrap\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Symfony\Component\Finder\Finder;

/**
 * Class AutoloadCommand
 * @package Bootstrap\Console
 */
class AutoloadCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'dump-autoload';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Regenerate framework autoload files";
    /**
     * The composer instance.
     *
     * @var Composer
     */
    protected $composer;

    /**
     * Create a new optimize command instance.
     *
     * @param Composer $composer
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->composer->dumpOptimized();
        foreach ($this->findWorkbenches() as $workbench)
        {
            $this->comment("Running for workbench [{$workbench['name']}]...");
            $this->composer->setWorkingPath($workbench['path'])->dumpOptimized();
        }
    }

    /**
     * Get all of the workbench directories.
     *
     * @return array
     */
    protected function findWorkbenches()
    {
        $results = array();
        foreach ($this->getWorkbenchComposers() as $file)
        {
            $results[] = array('name' => $file->getRelativePath(), 'path' => $file->getPath());
        }
        return $results;
    }

    /**
     * Get all of the workbench composer files.
     *
     * @return Finder
     */
    protected function getWorkbenchComposers()
    {
        $workbench = $this->laravel['path.base'].'/workbench';
        if ( ! is_dir($workbench))
        	return [];

        return Finder::create()->files()->followLinks()->in($workbench)->name('composer.json')->depth('< 3');
    }
}
