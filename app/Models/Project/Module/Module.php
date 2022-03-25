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

    protected $appends = ['attempt', 'number_of_questions'];

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

    //SCOPE

    public function scopeByProject($query, $project_id)
    {
        if($project_id)
            return $query->where('project_id', $project_id);
    }

    //MUTATOR
    
    public function getAttemptAttribute()
    {
        $project = $this->project()->first();
        return $project ? $project->attempts : 0;
    }

    public function getNumberOfQuestionsAttribute()
    {
        $questions = $this->questions()->get();
        return $questions ? $questions->count() : 0;
    }


}
