<?php \defined('BASEPATH') || exit(HTTP_UNAUTHORIZED);

/**
 * The Home Controller Class is used to demonstrate how to interact with
 * a basic REST API endpoint
 */
class HomeController extends MY_Controller
{
    /**
     * Index method
     *
     * @method GET
     */
    public function index_get()
    {
        $this->response([
            'message' => 'Welcome to the API',
            'success' => true,
            'status'  => HTTP_OK,
        ], HTTP_OK);
    }

    // ------------------------------------------------------------------------
}
