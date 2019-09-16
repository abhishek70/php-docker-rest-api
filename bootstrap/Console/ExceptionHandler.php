<?php
namespace Bootstrap\Console;

use Exception;
use Closure;

/**
 * Class ExceptionHandler
 * @package Bootstrap\Console
 */
class ExceptionHandler
{
    protected $handlers = array();

	/**
	 * Handle console exception
	 *
	 * @param Exception $exception
	 * @return string
	 */
    function handleConsole(Exception $exception)
    {
        return $exception->getMessage();
    }

    /**
     * Register an application error handler.
     *
     * @param  Closure $callback
     *
     * @return void
     */
    public function error(Closure $callback)
    {
        array_unshift($this->handlers, $callback);
    }
} 
