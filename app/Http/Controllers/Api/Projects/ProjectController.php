<?php

namespace App\Http\Controllers\Api\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Models\Project\Password;

class ProjectController extends Controller
{
    public function projects()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $project                        = new Project();
        $project->name                  = $request->name;
        $project->start                 = $request->start;
        $project->end                   = $request->end;
        $project->attempts              = $request->attempt;
        $project->type                  = $request->type;
        $project->status                = $request->status;

        $project->save();

        if($project->type == "ONLY"){
            $project_password                   = new Password();
            $project_password->password         = $request->password_project;
            $project_password->type             = $project->type;
            $project_password->project_id       = $project->id;
            $project_password->save();
        }

        return $project;
    }

    public function update(Request $request, Project $project)
    {
        $project->name                  = $request->name;
        $project->start                 = $request->start;
        $project->end                   = $request->end;
        $project->attempts              = $request->attempt;
        $project->type                  = $request->type;
        $project->status                = $request->status;

        $project->save();

        return $project;
    }

    public function destroy(Project $project)
    {
        $project->delete();
    }
}
