<?php namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;
use App\Models\GradeModel;
use App\Models\AttendanceModel;

class Dashboard extends BaseController
{
    protected $studentModel;
    protected $courseModel;
    protected $gradeModel;
    protected $attendanceModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
        $this->gradeModel = new GradeModel();
        $this->attendanceModel = new AttendanceModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'studentCount' => $this->studentModel->countAll(),
            'courseCount' => $this->courseModel->countAll(),
            'gradeCount' => $this->gradeModel->countAll(),
            'attendanceCount' => $this->attendanceModel->countAll(),
            'recentStudents' => $this->studentModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recentAttendance' => $this->attendanceModel->orderBy('date', 'DESC')->limit(5)->find()
        ];
        return view('dashboard/index', $data);
    }
}