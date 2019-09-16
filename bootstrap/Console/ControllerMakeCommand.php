<?php


namespace Bootstrap\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerMakeCommand
 * @package Bootstrap\Console
 */
class ControllerMakeCommand extends GeneratorCommand
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:controller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new controller class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Controller';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__.'/stubs/controller.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return 'Controllers';
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['resource', null, InputOption::VALUE_NONE, 'Generate a resource controller class.'],
		];
	}

	/**
	 * Build the class with the given name.
	 *
	 * Remove the base controller import if we are already in base namespace.
	 *
	 * @param string $name
	 * @return string
	 * @throws FileNotFoundException
	 */
	protected function buildClass($name)
	{
		$namespace = $this->getNamespace($name);

		return str_replace("use $namespace\Controller;\n", '', parent::buildClass($name));
	}

	/**
	 * Parse the class name and format according to the root namespace.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function qualifyClass($name)
	{
		return $name;
	}

	/**
	 * Get the destination class path.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getPath($name)
	{
		return BASE.'/app/controllers/'.$name.'.php';
	}
}
