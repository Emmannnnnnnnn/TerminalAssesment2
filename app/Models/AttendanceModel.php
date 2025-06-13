<?php namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'date', 'status', 'remarks'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAttendanceWithStudent()
    {
        return $this->select('attendance.*, students.first_name, students.last_name')
                    ->join('students', 'students.id = attendance.student_id')
                    ->orderBy('date', 'DESC')
                    ->findAll();
    }
}