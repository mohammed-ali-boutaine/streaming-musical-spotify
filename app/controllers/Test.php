<?php

namespace App\Controllers;

use Core\Controller;

class Test extends Controller
{
     public function index()
     {

          $this->view('home/test');
     }
     public function testForm()
     {
          $data = [
               'name' => $_POST['name'] ?? '',
               'email' => $_POST['email'] ?? '',
               'password' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT)
          ];
          // $this->view('home/test');
     }
}
