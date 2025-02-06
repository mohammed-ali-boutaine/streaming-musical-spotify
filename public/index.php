<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Core\Router;

// $router->get('/users', 'UserController@index');
// $router->get('/users/create', 'UserController@create');
// $router->post('/users/create', 'UserController@create');
// $router->get('/users/edit/{id}', 'UserController@edit');
// $router->post('/users/edit/{id}', 'UserController@edit');
// $router->get('/users/delete/{id}', 'UserController@delete');
// $router->get('/users/{id}', 'UserController@show');
// Router::post('/users/delete/{id}', 'UserController@delete');



// static stuff

// ----   get
Router::get('', 'Home@index');
Router::get('login', 'Home@login');
Router::get('register', 'Home@register');
Router::get('users', 'UserController@index');
Router::get('test', 'Test@index');
Router::post('test', 'Test@testForm');


// ----  post
Router::post('login', 'Home@handleLogin');
Router::post('register', 'Home@handleRegister');






Router::dispatch();