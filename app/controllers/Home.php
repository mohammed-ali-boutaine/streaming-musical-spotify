<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
     public function index()
     {

          $this->view('home/index');
     }

     public function login()
     {
          $this->view('home/login');
     }
     public function register()
     {
          $this->view('home/register');
     }

     public function handleLogin()
     {
          echo "<pre>";
          echo "login test \n";
          print_r($_POST);
          echo "</pre>";
     }

     public function handleRegister()
     {
          echo "<pre>";
          print_r($_POST);
          echo "</pre>";
     }
}
