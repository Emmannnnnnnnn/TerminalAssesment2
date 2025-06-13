<?php 
// app/Controllers/Api/UserController.php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    public function index()
    {
        return $this->respond([
            'status' => 'success',
            'data' => ['users' => []]
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON();
        return $this->respondCreated([
            'status' => 'success',
            'message' => 'User created',
            'data' => $data
        ]);
    }
}