<?php
/**
 * Laravel Database - for any web application
 *
 * @package  Database
 * @author   Arul Kumaran <arul@luracast.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Configure your Web Application
|--------------------------------------------------------------------------
|
| Configure your favourite web app framework to handle web requests and
| respond back. If you are using Restler framework, you may simply uncomment
| the code below and run the following command from the command line on the
| project root folder
|
|    composer require restler/framework
|
*/

use Bootstrap\Container\Application;
use Luracast\Restler\Defaults;
use Luracast\Restler\Restler;
use Luracast\Restler\User;
use Luracast\Restler\Explorer\Info;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Registry;

$requestId = uniqid();

// Create a log channel and pushing handler to stack
$logger = new Logger(Config::get('app.channel'));
$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

// Allows to get `Logger` instances in the global scope via static method calls on any class.
Registry::addLogger($logger);

// Enable URL based versioning - /v1/* || /v2/*
Defaults::$useUrlBasedVersioning = true;

// Setting cache directory to /app/storage/cache
Defaults::$cacheDirectory        = Application::getInstance()->storagePath().'/cache';

$env = env('APP_ENV', 'production');

// Initializing Restler application
$app = new Restler($env === 'production');

// Supported Formats (JsonFormat, XmlFormat)
$app->setSupportedFormats('JsonFormat');

// Setting current API version
$app->setAPIVersion(1);

// API Lifecycle events
$app->onGet(function() use ($app) {});
$app->onNegotiate(function() use ($app) {});
$app->onValidate(function() use ($app) {});
$app->onCall(function () use ($app, $requestId, $logger) {

	// Don't log Luracast Restler Swagger & Authorize Token calls
	if (!preg_match('/apidocs|oauth2/', $app->url))
	{
		$info = [
			'requestId' => $requestId,
			'base'      => $app->getBaseUrl(),
			'method'    => $app->requestMethod,
			'url'       => $app->url,
			'route'     => $app->apiMethodInfo->className.'::'.$app->apiMethodInfo->methodName,
			'version'   => $app->getRequestedApiVersion(),
			'requestData'      => $app->getRequestData(),
			'timestamp' => date("Y-m-d H:i:s"),
			'ip'        => User::getIpAddress()
		];

		// Logging initial request
		$logger->debug('API Request', $info);

	}
});
$app->onRespond(function() use ($app, $requestId, $logger) {

	// Hide in production mode
	if($app->getProductionMode())
	{
		header_remove('X-Powered-By');
	}

	if ($app->exception instanceof \Exception &&
		$app->exception->getCode() !== 200
	)
	{
		// Logging exception
		$logger->debug('API Response',
			[
				'requestId' => $requestId,
				'exception' => $app->exception->getCode(),
				'message'	=> $app->exception->getMessage()
			]
		);
	}
});


$app->addAPIClass('Reviews');
$app->addAPIClass('ApiDocs');


// Show the @access protected API in Swagger documentation
ApiDocs::$hideProtected = false;

// Hiding docs and token class in Swagger documentation
ApiDocs::$excludedPaths = [
	'apidocs',
	'oauth2'
];


// Swagger API documentation info
Info::$title = "Swagger";
Info::$description = 'API documentation';
Info::$termsOfServiceUrl = '';
Info::$contactName = '';
Info::$contactEmail = '';
Info::$contactUrl = '';
Info::$license = '';
Info::$licenseUrl = '';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application set up, we can simply let it handle the
| request and response
|
*/

$app->handle();
