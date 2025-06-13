<?php namespace App\Controllers;

use App\Models\CourseModel;

class Courses extends BaseController
{
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Course List',
            'courses' => $this->courseModel->findAll()
        ];
        return view('courses/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add New Course',
            'validation' => \Config\Services::validation()
        ];
        return view('courses/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'course_name' => 'required|min_length[3]',
            'course_code' => 'required|min_length[2]|is_unique[courses.course_code]',
            'description' => 'required'
        ])) {
            return redirect()->to('/courses/add')->withInput();
        }

        $this->courseModel->save([
            'course_name' => $this->request->getVar('course_name'),
            'course_code' => $this->request->getVar('course_code'),
            'description' => $this->request->getVar('description')
        ]);

        session()->setFlashdata('message', 'Course added successfully');
        return redirect()->to('/courses');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Course',
            'course' => $this->courseModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('courses/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'course_name' => 'required|min_length[3]',
            'course_code' => "required|min_length[2]|is_unique[courses.course_code,id,$id]",
            'description' => 'required'
        ])) {
            return redirect()->to("/courses/edit/$id")->withInput();
        }

        $this->courseModel->save([
            'id' => $id,
            'course_name' => $this->request->getVar('course_name'),
            'course_code' => $this->request->getVar('course_code'),
            'description' => $this->request->getVar('description')
        ]);

        session()->setFlashdata('message', 'Course updated successfully');
        return redirect()->to('/courses');
    }

    public function delete($id)
    {
        $this->courseModel->delete($id);
        session()->setFlashdata('message', 'Course deleted successfully');
        return redirect()->to('/courses');
    }
}