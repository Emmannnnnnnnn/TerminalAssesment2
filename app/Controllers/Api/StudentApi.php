<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\CourseModel;
use CodeIgniter\API\ResponseTrait;

class StudentApi extends BaseController
{
    use ResponseTrait;

    protected $studentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }

    /**
     * GET /api/students
     * List all students
     */
    public function index()
    {
        $students = $this->studentModel->getStudentsWithCourse();
        return $this->respond($students);
    }

    /**
     * GET /api/students/(id)
     * Get single student
     */
    public function show($id = null)
    {
        $student = $this->studentModel->getStudentWithCourse($id);
        
        if (!$student) {
            return $this->failNotFound('Student not found');
        }
        
        return $this->respond($student);
    }

    /**
     * POST /api/students
     * Create new student
     */
    public function create()
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'age' => 'required|numeric|greater_than[0]|less_than[120]',
            'course_id' => 'required|numeric|is_not_unique[courses.id]',
            'email' => 'required|valid_email|is_unique[students.email]|max_length[100]',
            'phone' => 'required|max_length[20]',
            'address' => 'required|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);

        $db = db_connect();
        $db->transStart();

        try {
            $id = $this->studentModel->insert($data);
            $db->transCommit();
            
            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Student created successfully',
                'data' => ['id' => $id]
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Failed to create student: ' . $e->getMessage());
        }
    }

    /**
     * PUT /api/students/(id)
     * Update student
     */
    public function update($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return $this->failNotFound('Student not found');
        }

        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'age' => 'required|numeric|greater_than[0]|less_than[120]',
            'course_id' => 'required|numeric|is_not_unique[courses.id]',
            'email' => "required|valid_email|is_unique[students.email,id,{$id}]|max_length[100]",
            'phone' => 'required|max_length[20]',
            'address' => 'required|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);

        $db = db_connect();
        $db->transStart();

        try {
            $this->studentModel->update($id, $data);
            $db->transCommit();
            
            return $this->respond([
                'status' => 'success',
                'message' => 'Student updated successfully'
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Failed to update student: ' . $e->getMessage());
        }
    }

    /**
     * DELETE /api/students/(id)
     * Delete student
     */
    public function delete($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return $this->failNotFound('Student not found');
        }

        $db = db_connect();
        $db->transStart();

        try {
            $this->studentModel->delete($id);
            $db->transCommit();
            
            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'Student deleted successfully'
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->failServerError('Failed to delete student: ' . $e->getMessage());
        }
    }
}