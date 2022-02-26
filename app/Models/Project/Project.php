<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project\PivotProjectStudent;
use App\Models\Project\Password;
use App\Models\Student\Student;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['password', 'it_is_accesible', 'is_active'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_students', 'project_id','student_id')->using(PivotProjectStudent::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class, 'project_id');
    }

    //Scopes

    public function scopeUserRegisteredInProject($query, $email)
    {
        return $query->whereHas('students', function($q) use ($email){
            $q->where('email', $email);
        })->exists();
    }

    //Mutators

    public function getIsActiveAttribute()
    {
        if($this->status) return true;

        return false;
    }

    public function getItIsAccesibleAttribute()
    {
        $now = Carbon::now()->format('Y-m-d');

        if(strtotime($now) >= strtotime($this->start) && strtotime($now) <= strtotime($this->end)) 
            return true;
        
        return false;
    }

    public function getPasswordAttribute()
    {
        $password = $this->passwords()->first();
        return $password ? $password->password : null;
    }


}
