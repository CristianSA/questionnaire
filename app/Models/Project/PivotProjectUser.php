<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_users';
    protected $fillable = ['user_id', 'project_id'];
}
