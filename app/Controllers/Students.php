<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;
use CodeIgniter\Files\File;

class Students extends BaseController
{
    protected $studentModel;
    protected $courseModel;
    protected $uploadPath;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
        $this->uploadPath = WRITEPATH . 'uploads/students/';

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    public function index()
    {
        $students = $this->studentModel->getStudentsWithCourse();

        if (!is_array($students)) {
            $students = [];
        }

        $students = array_map(function ($student) {
            return (array) $student;
        }, $students);

        foreach ($students as &$student) {
            $student['photo_url'] = $this->getPhotoUrl($student['profile_photo'] ?? null);
        }

        $data = [
            'title' => 'Student List',
            'students' => $students
        ];

        return view('students/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add New Student',
            'courses' => $this->courseModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('students/add', $data);
    }

    public function store()
    {
        $validationRules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'age' => 'required|numeric|greater_than[0]|less_than[120]',
            'course_id' => 'required|numeric|is_not_unique[courses.id]',
            'email' => 'required|valid_email|is_unique[students.email]|max_length[100]',
            'phone' => 'required|max_length[20]',
            'address' => 'required|max_length[255]'
        ];

        $file = $this->request->getFile('profile_photo');
        if ($file && $file->isValid()) {
            $validationRules['profile_photo'] = [
                'rules' => 'mime_in[profile_photo,image/jpg,image/jpeg,image/png]|max_size[profile_photo,2048]|is_image[profile_photo]',
                'errors' => [
                    'max_size' => 'The profile photo must not exceed 2MB.',
                    'mime_in' => 'Only JPG, JPEG, and PNG files are allowed.'
                ]
            ];
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'first_name' => esc($this->request->getPost('first_name')),
            'last_name' => esc($this->request->getPost('last_name')),
            'age' => (int)$this->request->getPost('age'),
            'course_id' => (int)$this->request->getPost('course_id'),
            'email' => esc($this->request->getPost('email')),
            'phone' => esc($this->request->getPost('phone')),
            'address' => esc($this->request->getPost('address')),
            'profile_photo' => null
        ];

        $newFileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $newFileName = $file->getRandomName();
                $file->move($this->uploadPath, $newFileName);
                $data['profile_photo'] = $newFileName;
            } catch (\Exception $e) {
                log_message('error', 'File upload error: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to upload profile photo.');
            }
        }

        $db = db_connect();
        $db->transStart();

        try {
            $this->studentModel->insert($data);
            $db->transCommit();
            return redirect()->to('/students')->with('success', 'Student added successfully.');
        } catch (\Exception $e) {
            $db->transRollback();
            if ($newFileName && file_exists($this->uploadPath . $newFileName)) {
                @unlink($this->uploadPath . $newFileName);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to add student.');
        }
    }

    public function edit($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $student['photo_url'] = $this->getPhotoUrl($student['profile_photo'] ?? null);

        $data = [
            'title' => 'Edit Student',
            'student' => $student,
            'courses' => $this->courseModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('students/edit', $data);
    }

    public function update($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $validationRules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'age' => 'required|numeric|greater_than[0]|less_than[120]',
            'course_id' => 'required|numeric|is_not_unique[courses.id]',
            'email' => "required|valid_email|is_unique[students.email,id,{$id}]|max_length[100]",
            'phone' => 'required|max_length[20]',
            'address' => 'required|max_length[255]'
        ];

        $file = $this->request->getFile('profile_photo');
        if ($file && $file->isValid()) {
            $validationRules['profile_photo'] = [
                'rules' => 'mime_in[profile_photo,image/jpg,image/jpeg,image/png]|max_size[profile_photo,2048]|is_image[profile_photo]',
                'errors' => [
                    'max_size' => 'The profile photo must not exceed 2MB.',
                    'mime_in' => 'Only JPG, JPEG, and PNG files are allowed.'
                ]
            ];
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'first_name' => esc($this->request->getPost('first_name')),
            'last_name' => esc($this->request->getPost('last_name')),
            'age' => (int)$this->request->getPost('age'),
            'course_id' => (int)$this->request->getPost('course_id'),
            'email' => esc($this->request->getPost('email')),
            'phone' => esc($this->request->getPost('phone')),
            'address' => esc($this->request->getPost('address'))
        ];

        $db = db_connect();
        $db->transStart();

        try {
            $removePhoto = $this->request->getPost('remove_photo') == '1';
            $oldPhoto = $student['profile_photo'] ?? null;
            $newPhoto = null;

            if ($removePhoto) {
                $data['profile_photo'] = null;
                if ($oldPhoto && file_exists($this->uploadPath . $oldPhoto)) {
                    @unlink($this->uploadPath . $oldPhoto);
                }
            } elseif ($file && $file->isValid() && !$file->hasMoved()) {
                $newPhoto = $file->getRandomName();
                $file->move($this->uploadPath, $newPhoto);
                $data['profile_photo'] = $newPhoto;
                if ($oldPhoto && file_exists($this->uploadPath . $oldPhoto)) {
                    @unlink($this->uploadPath . $oldPhoto);
                }
            }

            $this->studentModel->update($id, $data);
            $db->transCommit();
            return redirect()->to('/students')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            $db->transRollback();
            if ($newPhoto && file_exists($this->uploadPath . $newPhoto)) {
                @unlink($this->uploadPath . $newPhoto);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to update student.');
        }
    }

    public function view($id = null)
    {
        $student = $this->studentModel->getStudentWithCourse($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $student['photo_url'] = $this->getPhotoUrl($student['profile_photo'] ?? null);

        $data = [
            'title' => 'Student Details',
            'student' => $student
        ];

        return view('students/view', $data);
    }

    public function delete($id = null)
    {
        $student = $this->studentModel->find($id);
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $db = db_connect();
        $db->transStart();

        try {
            if (!empty($student['profile_photo']) && file_exists($this->uploadPath . $student['profile_photo'])) {
                @unlink($this->uploadPath . $student['profile_photo']);
            }

            $this->studentModel->delete($id);
            $db->transCommit();
            return redirect()->to('/students')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('/students')->with('error', 'Failed to delete student.');
        }
    }

    public function photo($filename = null)
    {
        if (!$filename) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = $this->uploadPath . $filename;

        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->file($filePath);

        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Length', filesize($filePath))
            ->setHeader('Cache-Control', 'public, max-age=31536000')
            ->setBody(file_get_contents($filePath));
    }

    public function getPhotoUrl($filename)
    {
        if (empty($filename)) {
            return base_url('assets/images/default-avatar.png');
        }
        return base_url('students/photo/' . $filename);
    }
    
}