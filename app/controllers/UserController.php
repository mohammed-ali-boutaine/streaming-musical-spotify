<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    // list all users
    public function index()
    {
        $users = User::getAll();
    
        $this->view('/user/index', ['users' => $users]);
    }
    // create user
    public function create()
    {
        $this->view('users/create');
    }

    public function store()
    {
        // $data = [
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com',
        //     'password' => password_hash('123456', PASSWORD_BCRYPT)
        // ];
        // User::create($data);
        
        // $email = $_POST["email"];
        // $name = $_POST["name"];
        // $user = new User(null, $email, $name);
        // $user->save();

        header('Location: /users');
    }


    public function edit($id)
    {

        $user = User::getUserById($id);
        $this->view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        // $data = ['name' => 'Updated Name'];
        // User::update($id, $data);
        // $email = $_POST["email"];
        // $name = $_POST["name"];
        // $user = new User($id, $email, $name);
        // $user->save();
        header('Location: /users');
    }


    public function destroy($id)
    {
        // csrf prottection
        // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            // die('Invalid CSRF token');
        // }
            // User::delete($id);
        User::deleteUser($id);
        header('Location: /users');
    }

    public function show($id)
    {
        $user = User::getUserById($id);
        require 'app/views/users/show.php';
    }
}
