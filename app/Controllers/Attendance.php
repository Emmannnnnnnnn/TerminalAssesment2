<?php namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\StudentModel;

class Attendance extends BaseController
{
    protected $attendanceModel;
    protected $studentModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Attendance Records',
            'attendance' => $this->attendanceModel->getAttendanceWithStudent()
        ];
        return view('attendance/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Attendance Record',
            'students' => $this->studentModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('attendance/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'student_id' => 'required|numeric',
            'date' => 'required|valid_date',
            'status' => 'required|in_list[Present,Absent,Late]',
            'remarks' => 'permit_empty'
        ])) {
            return redirect()->to('/attendance/add')->withInput();
        }

        $this->attendanceModel->save([
            'student_id' => $this->request->getVar('student_id'),
            'date' => $this->request->getVar('date'),
            'status' => $this->request->getVar('status'),
            'remarks' => $this->request->getVar('remarks')
        ]);

        session()->setFlashdata('message', 'Attendance record added successfully');
        return redirect()->to('/attendance');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Attendance Record',
            'attendance' => $this->attendanceModel->find($id),
            'students' => $this->studentModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('attendance/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'student_id' => 'required|numeric',
            'date' => 'required|valid_date',
            'status' => 'required|in_list[Present,Absent,Late]',
            'remarks' => 'permit_empty'
        ])) {
            return redirect()->to("/attendance/edit/$id")->withInput();
        }

        $this->attendanceModel->save([
            'id' => $id,
            'student_id' => $this->request->getVar('student_id'),
            'date' => $this->request->getVar('date'),
            'status' => $this->request->getVar('status'),
            'remarks' => $this->request->getVar('remarks')
        ]);

        session()->setFlashdata('message', 'Attendance record updated successfully');
        return redirect()->to('/attendance');
    }

    public function delete($id)
    {
        $this->attendanceModel->delete($id);
        session()->setFlashdata('message', 'Attendance record deleted successfully');
        return redirect()->to('/attendance');
    }
}