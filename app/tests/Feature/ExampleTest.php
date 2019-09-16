<?php

namespace tests\Feature;

use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class ExampleTest
 * @package tests\Feature
 */
class ExampleTest extends TestCase
{
	/** @var $client */
	private static $client;

    /**
     * Called before the first test of the test case class is run
     */
    public static function setUpBeforeClass(): void
    {
        self::$client = new Client(['base_uri' => Config::get('app.url')]);
    }

    /**
     * Called once for each test method
     */
    protected function setUp(): void
    {
        //TODO
    }

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 * @throws GuzzleException
	 */
    public function testExample()
    {
		$response = self::$client->request('GET', '/apidocs/');

		$this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Called once for each test method
     */
    protected function tearDown(): void
    {
        //TODO
    }

    /**
     * Called after the last test of the test case class is run
     */
    public static function tearDownAfterClass(): void
    {
        //TODO
    }
}
