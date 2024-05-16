<?php

require_once __DIR__ . "/../services/AuthService.class.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group("/auth", function(){

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Authentication"},
     *     summary="Authenticate user and provide a JWT",
     *     description="Logs in a user by email and password, returning a JWT if authentication is successful.",
     *     @OA\RequestBody(
     *         description="User credentials needed to obtain JWT",
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com", description="User's email address"),
     *             @OA\Property(property="password", type="string", example="yourPassword123", description="User's password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="JWT returned upon successful authentication",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", description="User details without password"),
     *             @OA\Property(property="token", type="string", description="JWT token for authenticated sessions")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid username or password"
     *     )
     * )
     */
    Flight::route("POST /login", function(){
        $auth_service = new AuthService();
        $data = Flight::request()->data->getData();
        $user = $auth_service->get_user_by_email($data["email"]);

        if(!$user || !password_verify($data["password"], $user["password"])) {
            Flight::halt(401, "Invalid username or password");
        }
            
        unset($user["password"]);

        $jwt_payload = [
            "user" => $user,
            "iat" => time(),
            "exp" => (time() + (60 * 60))
        ];

        $token =JWT::encode(
            $jwt_payload,
            JWT_SECRET,
            "HS256"
        );

        Flight::json(
            array_merge($user, ['token' => $token])
        );
    });

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout user and invalidate JWT",
     *     description="Logs out a user by invalidating the JWT provided in the authentication header.",
     *     security={{"jwt":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout with decoded token data",
     *         @OA\JsonContent(
     *             @OA\Property(property="jwt_decoded", type="object", description="Details of the decoded JWT"),
     *             @OA\Property(property="user", type="object", description="Details of the user extracted from JWT")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Missing or invalid authentication token"
     *     )
     * )
     */
    Flight::route("/logout", function(){
        try {
            $token = Flight::request()->getHeader("authentication");
            if(!$token) {
                Flight::halt(401, "Missing authentication header.");
            }

            $decoded_token = JWT::decode($token, new Key(JWT_SECRET, "HS256"));

            Flight::json([
                'jwt_decoded' => $decoded_token,
                'user' => $decoded_token->user
            ]);
        } catch (Exception $e) {
            Flight::halt($e->getCode(), $e->getMessage());
        }
    });
});