<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

use JDesrosiers\Silex\Provider\CorsServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

$app->before(function (Request $request) {
	if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
		$data = json_decode($request->getContent(), true);
		$request->request->replace(is_array($data) ? $data : []);
	}
});

$app->register(new Silex\Provider\MonologServiceProvider(), [
	'monolog.logfile' => realpath(__DIR__ . '/../log/') . '/warning.log',
	'monolog.level' => Logger::WARNING,
]);

$app->register(new CorsServiceProvider(), array(
	"cors.allowOrigin" => "*",
));

$app->after($app["cors"]);

$app->error(function(\Exception $e) use($app) {
	if($e instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
		return $app->json([
			'status' => 'error',
		], 404);
	} else {
		if($app['debug']) {
			return $app->json([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);
		}
		return $app->json([
			'status' => 'error',
		], 500);
	}
});

$app->get('/hello', '\\App\\Controllers\\API::hello');
$app->get('/test', '\\App\\Controllers\\API::test');
$app->get('/test/{key}', '\\App\\Controllers\\API::test');
$app->get('/', '\\App\\Controllers\\API::testEntry');
$app->get('/auth', '\\App\\Controllers\\API::testAuth');

$app->run();
