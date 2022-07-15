<?php

namespace App\Models\Student\Answer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Module\Module;
use App\Models\Project\Module\Question\Question;
use App\Models\Student\Student;
use App\Models\Project\Project;

class Answer extends Model
{
    use HasFactory;

    protected $appends = ['student_name', 'student_email'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    //SCOPES

    public function scopeByQuestion($query, $question_id)
    {
        return $query->where('question_id', $question_id);
    }

    public function scopeByModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }

    public function scopeByProject($query, $project_id)
    {
        return $query->where('project_id', $project_id);
    }

    public function scopeCorrectAnswers($query)
    {
        return $query->where('correct', true);
    }

    public function scopeWrongAnswers($query)
    {
        return $query->where('correct', false);
    }

    public function scopeByAttempt($query, $attempt)
    {
        return $query->where('attempt', $attempt);
    }

    public function scopeByStudent($query, $student_id)
    {
        if($student_id)
            return $query->where('student_id', $student_id);
    }

    public function scopeByStudents($query, $students)
    {
        return $query->whereIn('student_id', $students);
    }

    //MUTATOR

    

    public function getStudentNameAttribute()
    {
        return $this->student()->first()->name;
    }

    public function getStudentEmailAttribute()
    {
        return $this->student()->first()->email;
    }
}
