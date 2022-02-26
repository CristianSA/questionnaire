<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project\Project;
use App\Models\Project\PivotProjectStudent;

class Student extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guard = 'student';

    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password'
    ];

    public function projects()
    {
        /* return $this->belongsToMany(Project::class, 'user_project', 'user_id', 'project_id'); */
        return $this->belongsToMany(Project::class, 'project_students', 'student_id', 'project_id')->using(PivotProjectStudent::class);
    }
}
