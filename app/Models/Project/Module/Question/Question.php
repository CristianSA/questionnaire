<?php

namespace App\Models\Project\Module\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Module\Module;
use App\Models\Student\Answer\Answer;

class Question extends Model
{
    use HasFactory;

    protected $appends = ['total_correct_answers', 'total_wrong_answers'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    //MUTATORS

    public function getTotalCorrectAnswersAttribute()
    {
        return $this->answers()->correctAnswers()->count();
    }

    public function getTotalWrongAnswersAttribute()
    {
        return $this->answers()->wrongAnswers()->count();
    }

}
