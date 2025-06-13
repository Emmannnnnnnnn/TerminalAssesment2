<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class TestApi extends ResourceController
{
    public function index()
    {
        return $this->respond([
            'status'  => 200,
            'message' => 'API is working!',
            'data'    => [
                'timestamp' => date('Y-m-d H:i:s'),
                'version'   => \CodeIgniter\CodeIgniter::CI_VERSION
            ]
        ]);
    }
}