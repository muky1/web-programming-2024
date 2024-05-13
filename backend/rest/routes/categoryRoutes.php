<?php

require_once __DIR__ . "/../services/CategoriesService.class.php";

Flight::group("/categories", function (){

    /**
     * @OA\Get(
     *     path="/categories/all",
     *     tags={"Categories"},
     *     summary="Retrieve all categories",
     *     @OA\Response(
     *         response=200,
     *         description="An array of all categories"
     *     )
     * )
     */
    Flight::route('GET /all', function() {
        $category_service = new CategoriesService();
        $category = $category_service->get_all_categories();
        Flight::json($category, 200);
    });

    /**
     * @OA\Get(
     *     path="/categories/category/{category_id}",
     *     summary="Get a category by its ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category_id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of category",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Technology"),
     *             @OA\Property(property="description", type="string", example="Category focusing on technology news and reviews")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Category not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="An unexpected error occurred")
     *         )
     *     )
     * )
     */
    Flight::route("GET /category/@category_id", function($category_id) {
        $category_service = new CategoriesService();
        try {
            $category =  $category_service->get_category_by_id($category_id);
            if(!$category) {
                Flight::json(["message" => "Category not found."], 404);
            } else {
                Flight::json($category, 200);
            }
        } catch (Exception $e) {
            Flight::json(["message" => $e->getMessage(), "error" => $e->getCode()]);
        }
    });
});