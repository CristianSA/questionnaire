<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project\PivotProjectUser;

class Project extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users', 'project_id','user_id')->using(PivotProjectUser::class);
    }
}
