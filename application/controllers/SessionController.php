<?php \defined('BASEPATH') || exit(HTTP_UNAUTHORIZED);

/**
 * The Sessions Controller Class is used to demonstrate how to interact with
 * a basic REST API and the `ci_sessions` database table
 */
class SessionController extends MY_Controller
{
    /**
     * In the constructor we load the `Sessions_model` class to use for gathering
     * our data for the API requests
     *
     * @throws RuntimeException
     */
    public function __construct()
    {
        // MY_Controller Class constructor
        parent::__construct();

        // Load the Sessions_model class
        load_model('Sessions_model');

        // Assign Sessions_model to $this->model
        $this->model = new Sessions_model();
    }

    // ------------------------------------------------------------------------

    /**
     * SELECT all records from the database
     *
     * @method GET
     */
    public function index_get(): void
    {
        // Build the SQL data
        $this->data = $this->model->as_array()->get_all();

        // Generate the response
        $this->data
            ? $this->response($this->data)
            : $this->response([
                'message' => 'Records Not Found',
                'success' => false,
                'status'  => HTTP_NOT_FOUND,
            ], HTTP_NOT_FOUND);
    }

    // ------------------------------------------------------------------------

    /**
     * SELECT a single record from the database
     *
     * @method GET
     *
     * @param  string $id
     */
    public function show_get(string $id): void
    {
        // Build the SQL data
        $this->data = $this->model->where('id', $id)->as_array()->get();

        // Generate the response
        $this->data
            ? $this->response($this->data)
            : $this->response([
                'message' => 'Record Not Found',
                'success' => false,
                'status'  => HTTP_NOT_FOUND,
            ], HTTP_NOT_FOUND);
    }

    // ------------------------------------------------------------------------

    /**
     * DELETE a single record from the database
     *
     * @method DELETE
     *
     * @param  string $id
     */
    public function destroy_delete(string $id): void
    {
        // Assign the query to see if a user exists
        $this->data = $this->model->where('id', $id)->get();

        // IF the database record is not found
        if (!$this->data) {
            $this->response([
                'message' => 'Record Not Found',
                'success' => false,
                'status'  => HTTP_NOT_FOUND,
            ], HTTP_NOT_FOUND);

        } else {
            // Build the DELETE query
            $this->data = $this->model->delete(['id' => $id]);

            // Generate the response
            if ($this->data) {
                $this->response([
                    'message' => 'Record deleted',
                    'success' => true,
                    'status'  => HTTP_OK,
                ], HTTP_OK);

            } else {
                $this->response([
                    'message' => 'Server Error',
                    'success' => false,
                    'status'  => HTTP_INTERNAL_SERVER_ERROR,
                ], HTTP_INTERNAL_SERVER_ERROR);

            }
        }
    }

    // ------------------------------------------------------------------------
}
