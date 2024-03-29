<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project\PivotProjectStudent;
use App\Models\Project\Password;
use App\Models\Student\Student;
use App\Models\Project\Module\Module;
use App\Models\Project\Module\Answer\Answer;
use App\Models\Image\Image;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = ['password', 'it_is_accesible', 'is_active', 'ids_modules', 'is_delete', 'project_status'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'project_students', 'project_id','student_id')->using(PivotProjectStudent::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class, 'project_id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'project_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'project_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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

    public function getIdsModulesAttribute()
    {
        $modules = $this->modules()->get();
        return $modules ? $modules->pluck('id') : [];
    }

    public function getIsDeleteAttribute()
    {
        if($this->status)
            return false;

        return true;
    }

    public function getProjectStatusAttribute()
    {
        if($this->status)
            return 'Public';
        return 'Private';
    }


}
