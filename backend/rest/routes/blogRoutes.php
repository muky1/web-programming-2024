<?php

require_once __DIR__ . "/../services/BlogService.class.php";

Flight::group("/blogs", function() {

    /**
    * @OA\Get(
    *     path="/blogs/all",
    *     tags={"Blogs"},
    *     summary="List all blogs",
    *     @OA\Response(
    *         response=200,
    *         description="An array of all blog posts"
    *     )
    * )
    */
    Flight::route('GET /all', function() {
        $blog_service = new BlogService();
        $blog = $blog_service->get_all_blogs();
        Flight::json($blog, 200);
    });

    /**
    * @OA\Get(
    *     path="/blogs/blog",
    *     tags={"Blogs"},
    *     summary="Retrieve a single blog by query parameter ID",
    *     @OA\Parameter(
    *         name="blog_id",
    *         in="query",
    *         required=true,
    *         description="The ID of the blog to retrieve",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Detailed information about a single blog"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Blog not found"
    *     )
    * )
    */
    Flight::route("GET /blog", function() {
        $body = Flight::request()->query;
        $blog_service = new BlogService();
        $blog = $blog_service->get_blog_by_id($body["blog_id"]);
        Flight::json($blog, 200);
    });

    /**
     * @OA\Get(
     *      path="/blogs/blog/{blog_id}",
     *      tags={"Blogs"},
     *      summary="Get a single blog by ID",
     *      @OA\Parameter(
     *          name="blog_id",
     *          in="path",
     *          required=true,
     *          description="The ID of the blog to retrieve",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="A single blog post",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Blog not found"
     *      )
     * )
     */
    Flight::route("GET /blog/@blog_id", function($blog_id) {
        $blog_service = new BlogService();
        try {
            $blog = $blog_service->get_blog_by_id($blog_id);
            if (!$blog) {
                Flight::json(["message" => "Blog not found"], 404);
            } else {
                Flight::json($blog, 200);
            }
        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 500);
        }
    });

    /**
    * @OA\Get(
    *     path="/blogs/blog/{blog_id}/comments",
    *     tags={"Blogs"},
    *     summary="Retrieve all comments for a single blog by path parameter ID",
    *     @OA\Parameter(
    *         name="blog_id",
    *         in="path",
    *         required=true,
    *         description="The blog ID to retrieve comments for",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="An array of comments associated with the blog"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Blog not found or no comments available"
    *     )
    * )
    */
    Flight::route("GET /blog/@blog_id/comments", function($blog_id) {
        $blog_service = new BlogService();
        try {
            $blog = $blog_service->get_all_comments_by_blog_id($blog_id);
            if(!$blog) {
                Flight::json(["message" => "Blog not found"], 404);
            } else {
                Flight::json($blog, 200);
            }
        } catch (Exception $e) {
            Flight::json(["message" => $e->getMessage(), "error" => $e->getCode()]);
        }
    });

    /**
    * @OA\Post(
    *     path="/blogs/add",
    *     tags={"Blogs"},
    *     summary="Add a new blog",
    *     @OA\RequestBody(
    *         description="Data format for adding a blog",
    *         required=true,
    *         @OA\JsonContent(
    *             required={"title","content","category_id"},
    *             @OA\Property(property="title", type="string", example="New Blog Title"),
    *             @OA\Property(property="content", type="string", example="This is a new blog content"),
    *             @OA\Property(property="category_id", type="integer", example=1)
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Blog successfully added"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Required parameters are missing"
    *     )
    * )
    */
    Flight::route('POST /add', function () {
        $payload = Flight::request()->data->getData();
        if($payload['title'] == NULL || $payload['content'] == NULL || $payload['category_id'] == NULL) {
            Flight::halt(500, "Required parameters are missing!");
        }
        unset($payload['id']);
        $blog_service = new BlogService();
        $blog = $blog_service->add_blog($payload);
        Flight::json(['data' => $blog, 'message' => "You have successfully added the blog post."]);
    });

    /**
    * @OA\Delete(
    *     path="/blogs/delete/{blog_id}",
    *     tags={"Blogs"},
    *     summary="Delete a blog by ID",
    *     @OA\Parameter(
    *         name="blog_id",
    *         in="path",
    *         required=true,
    *         description="The ID of the blog to delete",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Blog successfully deleted"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Required parameters are missing or incorrect ID"
    *     )
    * )
    */
    Flight::route('DELETE /delete/@blog_id', function ($blog_id) {
        if($blog_id == NULL || $blog_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $blog_service = new BlogService();
        $blog_service->delete_blog_by_id($blog_id);
        
        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the blog post."]);
    });
});