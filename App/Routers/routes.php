<?php
use App\Routers\Router as Router;
use App\Middlewares\AuthMiddleware;

// use Controllers
use App\Controllers\AuthController;
use App\Controllers\WeatherController;
use App\Controllers\DestinationController;
use App\Controllers\RoomController;
use App\Controllers\UserController;
use \App\Controllers\SliderController;


// ایجاد یک نمونه از میدلور
$authMiddleware = new AuthMiddleware();
$request = getTokenFromRequest();
$response = $authMiddleware->handle($request);

$router = new Router();

// Define routes
$router->post('v1','/login', AuthController::class, 'login');
$router->post('v1','/register', AuthController::class, 'register');
$router->post('v1','/verify', AuthController::class, 'verify');
$router->get('v1','/test', AuthController::class, 'test');

// Weathers
$router->get('v1', '/weathers', WeatherController::class, 'index', "owners");
$router->get('v1', '/weathers/{id}', WeatherController::class, 'get', "owners");
$router->post('v1', '/weathers', WeatherController::class, 'store', "owners");
$router->put('v1', '/weathers/{id}', WeatherController::class, 'update', "owners");
$router->delete('v1', '/weathers/{id}', WeatherController::class, 'destroy', "owners");
$router->post('v1', '/weathers/delete/{id}', WeatherController::class, 'destroy', "owners");

// Destinations
$router->get('v1', '/destinations', DestinationController::class, 'index', "owners");
$router->get('v1', '/destinations/{id}', DestinationController::class, 'get', "owners");
$router->post('v1', '/destinations', DestinationController::class, 'store', "owners");
$router->put('v1', '/destinations/{id}', DestinationController::class, 'update', "owners");
$router->delete('v1', '/destinations/{id}', DestinationController::class, 'destroy', "owners");

// Rooms
$router->get('v1', '/rooms', RoomController::class, 'index');
$router->get('v1', '/rooms/{id}', RoomController::class, 'get');
$router->post('v1', '/rooms', RoomController::class, 'store', inaccess: 'guest');
$router->put('v1', '/rooms/{id}', RoomController::class, 'update', inaccess: 'guest');
$router->delete('v1', '/rooms/{id}', RoomController::class, 'destroy', "owners");
$router->post('v1', '/rooms/like', RoomController::class, 'room_like');
$router->post('v1', '/rooms/reserve', RoomController::class, 'room_reserve');

// Sliders
$router->post('v1', '/sliders', SliderController::class, 'store', access: 'owners');
$router->get('v1', '/sliders', SliderController::class, 'index');

// Users
$router->get('v1', '/users', UserController::class, 'index',  'owners');
$router->get('v1', '/users/hosts', UserController::class, 'get_hosts',  'owners');
$router->get('v1', '/users/{id}', UserController::class, 'get');
$router->post('v1', '/users', UserController::class, 'store', inaccess: 'guest');
$router->put('v1', '/users/{id}', UserController::class, 'update', inaccess: 'guest');
$router->delete('v1', '/users/{id}', UserController::class, 'destroy', "owners");
$router->post('v1', '/users/delete/{id}', UserController::class, 'destroy',  "owners");
$router->post('v1', '/users/accept/{id}', UserController::class, 'confirm', "owners");
$router->get('v1', '/host/requests', UserController::class, 'host_requests', 'owners');

// features
$router->post('v1', '/rooms/feature', RoomController::class, 'add_feature', inaccess: 'guest');
$router->post('v1', '/rooms/append_feature', RoomController::class, 'append_feature', inaccess: 'guest');