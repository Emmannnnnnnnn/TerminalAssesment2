<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================
// Protected web routes
// ======================
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('/', 'Dashboard::index');

    // Student routes
    $routes->get('students', 'Students::index');
    $routes->get('students/add', 'Students::add');
    $routes->post('students/store', 'Students::store');
    $routes->get('students/view/(:num)', 'Students::view/$1');
    $routes->get('students/edit/(:num)', 'Students::edit/$1');
    $routes->post('students/update/(:num)', 'Students::update/$1');
    $routes->get('students/delete/(:num)', 'Students::delete/$1');

    // Course routes
    $routes->get('courses', 'Courses::index');
    $routes->get('courses/add', 'Courses::add');
    $routes->post('courses/store', 'Courses::store');
    $routes->get('courses/edit/(:num)', 'Courses::edit/$1');
    $routes->post('courses/update/(:num)', 'Courses::update/$1');
    $routes->get('courses/delete/(:num)', 'Courses::delete/$1');

    // Grade routes
    $routes->get('grades', 'Grades::index');
    $routes->get('grades/add', 'Grades::add');
    $routes->post('grades/store', 'Grades::store');
    $routes->get('grades/edit/(:num)', 'Grades::edit/$1');
    $routes->post('grades/update/(:num)', 'Grades::update/$1');
    $routes->get('grades/delete/(:num)', 'Grades::delete/$1');

    // Attendance routes
    $routes->get('attendance', 'Attendance::index');
    $routes->get('attendance/add', 'Attendance::add');
    $routes->post('attendance/store', 'Attendance::store');
    $routes->get('attendance/edit/(:num)', 'Attendance::edit/$1');
    $routes->post('attendance/update/(:num)', 'Attendance::update/$1');
    $routes->get('attendance/delete/(:num)', 'Attendance::delete/$1');
});

// ======================
// Public routes
// ======================
$routes->get('students/photo/(:segment)', 'Students::photo/$1');

// Authentication routes
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register/store', 'Auth::store');

// ======================
// API routes for Postman
// ======================
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'api-auth'], function($routes) {
    // Student API
    $routes->group('students', function($routes) {
        $routes->get('/', 'StudentApi::index');
        $routes->get('(:num)', 'StudentApi::show/$1');
        $routes->post('/', 'StudentApi::create');
        $routes->put('(:num)', 'StudentApi::update/$1');
        $routes->delete('(:num)', 'StudentApi::delete/$1');
        
        // Additional API endpoints that use your model's custom methods
        $routes->get('search/(:segment)', 'StudentApi::search/$1');
        $routes->get('course/(:num)', 'StudentApi::byCourse/$1');
        $routes->get('stats', 'StudentApi::stats');
    });

    // Add more API groups here if needed (e.g., courses, grades, etc.)
});