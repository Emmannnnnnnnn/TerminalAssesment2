<?php namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'course_id', 'grade', 'semester'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getGradesWithDetails()
    {
        return $this->select('grades.*, students.first_name, students.last_name, courses.course_name')
                    ->join('students', 'students.id = grades.student_id')
                    ->join('courses', 'courses.id = grades.course_id')
                    ->findAll();
    }
}