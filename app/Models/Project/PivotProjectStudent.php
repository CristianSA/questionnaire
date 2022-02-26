<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PivotProjectStudent extends Pivot
{
    use HasFactory;

    protected $table = 'project_student';
    protected $fillable = ['student_id', 'project_id'];
}
