<?php

namespace App\Controllers;

use Core\Controller;

use \App\Models\User;



class AuthController extends Controller
{


     public function login()
     {
          $errors = [];

          // Validate inputs
          $email = $_POST["email"] ?? null;
          $password = $_POST["password"] ?? null;


          if (empty($email) || empty($password)) {
               $errors[] = "All fields are required.";
               return $this->view("home/login", ["errors" => $errors]);
          }
          // Check if email already exists and return to register page

          $user = User::findByEmail($email);
          if (!$user) {
               $errors[] = "This email does not exist. Please register.";
               return $this->view("home/register", ["errors" => $errors]);
          }
          $user = new User($user["id"], $user["email"], $user["username"], $user["password"], $user["role"]);
          // Verify password
          if (!password_verify($password, $user->getPassword())) {
               $errors[] = "Invalid password.";
               return $this->view("home/login", ["errors" => $errors]);
          }

          // Store session
          $_SESSION["user_id"] = $user->getId();
          $_SESSION["user_email"] = $user->getEmail();
          $_SESSION["user_role"] = $user->getRole();

          // Redirect after successful login
          header("Location: /dashboard");
          exit;
     }

     public function register()
     {
          $errors = [];
          $success = [];

          // Validate inputs
          $email = $_POST["email"] ?? null;
          $username = $_POST["username"] ?? null;
          $password = $_POST["password"] ?? null;

          if (empty($email) | empty($username) | empty($password)) {
               $errors[] = "All fields are required.";
          }

          // check if email aleardy exists

          // Check if email already exists and return to register page
          if (User::findByEmail($email)) {
               $errors[] = "Email already exists.";
               $this->view("home/register", ["errors" => $errors]);
          }



          $hashed_password = password_hash($password, PASSWORD_BCRYPT);
          $user = new User(null, $email, $username, $hashed_password);
          if ($user->save()) {
               $success[] = "User Created Succcsfly";
          }
          // Store user session
          $_SESSION["user_id"] = $user->getId();
          $_SESSION["user_email"] = $user->getEmail();
          $_SESSION["user_role"] = $user->getRole();
          // Redirect after successful registration

          header("Location: /dashboard");
          exit;
     }
}
