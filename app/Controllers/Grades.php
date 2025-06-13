<?php namespace App\Controllers;

use App\Models\GradeModel;
use App\Models\StudentModel;
use App\Models\CourseModel;

class Grades extends BaseController
{
    protected $gradeModel;
    protected $studentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->gradeModel = new GradeModel();
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Grade List',
            'grades' => $this->gradeModel->getGradesWithDetails()
        ];
        return view('grades/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add New Grade',
            'students' => $this->studentModel->findAll(),
            'courses' => $this->courseModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('grades/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'student_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'grade' => 'required|decimal',
            'semester' => 'required'
        ])) {
            return redirect()->to('/grades/add')->withInput();
        }

        $this->gradeModel->save([
            'student_id' => $this->request->getVar('student_id'),
            'course_id' => $this->request->getVar('course_id'),
            'grade' => $this->request->getVar('grade'),
            'semester' => $this->request->getVar('semester')
        ]);

        session()->setFlashdata('message', 'Grade added successfully');
        return redirect()->to('/grades');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Grade',
            'grade' => $this->gradeModel->find($id),
            'students' => $this->studentModel->findAll(),
            'courses' => $this->courseModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('grades/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'student_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'grade' => 'required|decimal',
            'semester' => 'required'
        ])) {
            return redirect()->to("/grades/edit/$id")->withInput();
        }

        $this->gradeModel->save([
            'id' => $id,
            'student_id' => $this->request->getVar('student_id'),
            'course_id' => $this->request->getVar('course_id'),
            'grade' => $this->request->getVar('grade'),
            'semester' => $this->request->getVar('semester')
        ]);

        session()->setFlashdata('message', 'Grade updated successfully');
        return redirect()->to('/grades');
    }

    public function delete($id)
    {
        $this->gradeModel->delete($id);
        session()->setFlashdata('message', 'Grade deleted successfully');
        return redirect()->to('/grades');
    }
}