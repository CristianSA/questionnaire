<?php

namespace App\Models\Project\Module;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Project;
use App\Models\Project\Module\Question\Question;
use App\Models\Student\Answer\Answer;

class Module extends Model
{
    use HasFactory;

    protected $appends = ['attempt'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'module_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'module_id');
    }

    //MUTATOR
    
    public function getAttemptAttribute()
    {
        $project = $this->project()->first();
        return $project ? $project->attempts : 0;
    }


}
