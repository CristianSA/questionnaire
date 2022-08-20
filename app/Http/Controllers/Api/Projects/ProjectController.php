<?php

namespace App\Http\Controllers\Api\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Models\Project\Password;
use App\Imports\Projects\PasswordsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{

    public function projects()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $status = $request->status == 'true' ? true : false;

        $project                        = new Project();
        $project->name                  = $request->name;
        $project->start                 = $request->start;
        $project->end                   = $request->end;
        $project->attempts              = $request->attempt;
        $project->type                  = $request->type;
        $project->status                = $status;

        $project->save();

        if($project->type == "ONLY"){
            $project_password                   = new Password();
            $project_password->password         = $request->password_project;
            $project_password->type             = $project->type;
            $project_password->project_id       = $project->id;
            $project_password->save();
        }

        if($project->type == "MULTIPLE"){
            (new PasswordsImport)->import(request()->file('file'));
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

    public function analytics(Project $project)
    {
        //objetivo: obtener los resultados de los estudiantes
            //1 Mostrar si un estudiante ha aprobado o no
        //Estudiantes que pertenecen al projecto
        $students = $project->students;

        //Para saber que esta aprobado
            // buscar las respuestas correctas de cada intento / cantidad de preguntas del modulo * 100, 0 round
        /* $modules = $project->modules;
        $correct_answers = $modules->map(function($item) use ($students){
            return $item->answers()
                ->correctAnswers()
                ->byStudents($students->pluck('id'))
                ->get();
        })->values()->flatten()->groupBy(['student_id', 'attempt']); */
        //$module->answers()->correctAnswers()->byAttempt(1)->count();
        $answers = $students->map(function($item){
            return $item->answers()->get()->groupBy('attempt');
        })->values();


        $correct_answers = $students->map(function($item){
            return $item->answers()->correctAnswers()->get()->groupBy('attempt');
        })->values();

        $wrong_answers = $students->map(function($item){
            return $item->answers()->correctAnswers()->get()->groupBy('attempt');
        })->values();

        $answers->map(function($item) use($project){




            dd($item);
        });

        /* for($a=0;$a < $answers->count(); $a++){
            //x = 1 porque nunca habra 0 intentos?
            for($x=1;$x < $project->attempts; $x++){

                for($m=0;$m < count($answers[$a][$x]); $m++){
                    //if question is correct
                    if($answers[$a][$x][$m]['correct']){

                    }
                }
            }

        } */
        /* $answers->map(function($item){
            dd($item[1]);//by attempt?
        }); */
        /* $correct_answers = collect([]);

        foreach($answers as $answer){

            foreach($answer as $attempt){
                //dd($attempt);
                //if($attempt->correct) $correct_answers->push($attempt);
                //dd($attempt)
            }
        } */
        /* $object = new \stdClass();
        $object */

        //crear un objeto donde enviaremos dicha informacion
        return $answers;
    }
}
