<?php

namespace App\Models\Project\Module\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Module\Module;
use App\Models\Student\Answer\Answer;

class Question extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

}
