<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\User;

class Home extends Controller
{
     public function index()
     {

          $this->view('home/index');
     }
     public function dashboard()
     {

          $this->view('dashboard/index');
     }
     public function notFound()
     {

          $this->view('home/404');
     }
     public function login()
     {
          $this->view('home/login');
     }
     public function register()
     {
          $this->view('home/register');
     }
}
