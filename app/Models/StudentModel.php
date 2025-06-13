<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'age',
        'course_id',
        'email',
        'phone',
        'address',
        'profile_photo'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation rules for API and web forms
    protected $validationRules = [
        'first_name' => 'required|min_length[2]|max_length[50]',
        'last_name' => 'required|min_length[2]|max_length[50]',
        'age' => 'required|numeric|greater_than[12]|less_than[100]',
        'course_id' => 'permit_empty|numeric',
        'email' => 'required|valid_email|max_length[100]',
        'phone' => 'permit_empty|max_length[20]',
        'address' => 'permit_empty|max_length[255]',
        'profile_photo' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get all students with course info (for API and web)
     */
    public function getStudentsWithCourse(array $options = []): array
    {
        $builder = $this->select('students.*, courses.course_name, courses.course_code')
                       ->join('courses', 'courses.id = students.course_id', 'left');

        // Add pagination for API
        if (isset($options['limit']) && isset($options['offset'])) {
            $builder->limit($options['limit'], $options['offset']);
        }

        // Add sorting
        $sortField = $options['sort'] ?? 'students.created_at';
        $sortDirection = $options['direction'] ?? 'DESC';
        $builder->orderBy($sortField, $sortDirection);

        $results = $builder->findAll();
        return is_array($results) ? $results : [];
    }

    /**
     * Get a single student with course info
     */
    public function getStudentWithCourse($id): ?array
    {
        return $this->select('students.*, courses.course_name, courses.course_code, courses.description as course_description')
                   ->join('courses', 'courses.id = students.course_id', 'left')
                   ->where('students.id', $id)
                   ->first();
    }

    /**
     * Search students by name, email, or course (enhanced for API)
     */
    public function searchStudents(string $keyword, array $options = []): array
    {
        $builder = $this->select('students.*, courses.course_name, courses.course_code')
                       ->join('courses', 'courses.id = students.course_id', 'left')
                       ->groupStart()
                           ->like('students.first_name', $keyword)
                           ->orLike('students.last_name', $keyword)
                           ->orLike('students.email', $keyword)
                           ->orLike('courses.course_name', $keyword)
                           ->orLike('courses.course_code', $keyword)
                       ->groupEnd();

        // Add pagination
        if (isset($options['limit']) && isset($options['offset'])) {
            $builder->limit($options['limit'], $options['offset']);
        }

        return $builder->orderBy('students.created_at', 'DESC')
                      ->findAll();
    }

    /**
     * Get students filtered by course (with pagination support)
     */
    public function getStudentsByCourse($courseId, array $options = []): array
    {
        $builder = $this->select('students.*, courses.course_name, courses.course_code')
                       ->join('courses', 'courses.id = students.course_id', 'left')
                       ->where('students.course_id', $courseId);

        // Add pagination
        if (isset($options['limit']) && isset($options['offset'])) {
            $builder->limit($options['limit'], $options['offset']);
        }

        return $builder->orderBy('students.last_name', 'ASC')
                      ->orderBy('students.first_name', 'ASC')
                      ->findAll();
    }

    /**
     * Get general statistics about students
     */
    public function getStudentStats(): array
    {
        $total = $this->countAllResults(false);

        $withPhotos = $this->where('profile_photo IS NOT NULL')
                          ->where('profile_photo !=', '')
                          ->countAllResults(false);

        $average = $this->selectAvg('age')->first();
        $avgAge = isset($average['age']) ? round($average['age'], 1) : 0;

        return [
            'total_students' => $total,
            'students_with_photos' => $withPhotos,
            'students_without_photos' => $total - $withPhotos,
            'average_age' => $avgAge
        ];
    }

    /**
     * Get the full name from a student array
     */
    public function getFullName($student): string
    {
        if (is_array($student)) {
            return trim(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? ''));
        }
        return '';
    }

    /**
     * Check email uniqueness excluding an optional student ID
     */
    public function isEmailUnique(string $email, $excludeId = null): bool
    {
        $builder = $this->where('email', $email);

        if (!empty($excludeId)) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() === 0;
    }

    /**
     * Find students with pagination (for API)
     */
    public function paginateStudents(int $limit, int $offset = 0): array
    {
        return $this->orderBy('created_at', 'DESC')
                   ->findAll($limit, $offset);
    }
}