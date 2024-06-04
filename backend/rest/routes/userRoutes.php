<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . "/../services/UserService.class.php";

Flight::group("/user", function(){
    Flight::route("POST /register", function () {
        $payload = Flight::request()->data->getData();
        if($payload['first_name'] == NULL || $payload['last_name'] == NULL ||
            $payload['email'] == NULL || $payload['password'] == NULL ||
            $payload['confirm_password'] == NULL) {
            Flight::halt(400, "All fields are required!");
        }

        if (!filter_var($payload['email'], FILTER_VALIDATE_EMAIL)) {
            Flight::halt(400, "Invalid email format.");
        }
    
        if ($payload['password'] !== $payload['confirm_password']) {
            Flight::halt(400, "Passwords do not match.");
        }

        $hashedPassword = password_hash($payload['password'], PASSWORD_BCRYPT);

        $user = [
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'email' => $payload['email'],
            'password' => $hashedPassword
        ];
        $user_service = new UserService();
        try {
            $newUser = $user_service->add_user($user);
            Flight::json(['message' => "Registration successful.", 'user' => $newUser]);
        } catch (Exception $e) {
            //throw $th;
            Flight::halt(409, "An account with this email already exists!");
        }
    });
});