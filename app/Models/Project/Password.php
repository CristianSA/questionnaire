<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Project;

class Password extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    //Scopes
    public function scopeByPassword($query, $password)
    {
        $query->where('password', $password);
    }
}
