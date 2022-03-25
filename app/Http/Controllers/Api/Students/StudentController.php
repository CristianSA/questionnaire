<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use App\Models\Student\Answer\Answer;
use App\Models\Project\Project;
use App\Models\Project\Module\Question\Question;
use App\Models\Project\Module\Module;

class StudentController extends Controller
{
    public function projectsByStudent(Student $student)
    {
        return $student->projects;
    }

    public function modulesByProjects(Project $project)
    {
        return $project->modules;
    }

    public function testing(Request $request)
    {
        $student = Student::find($request->student_id);

        //que queremos mostrar
        // 1 mostrar los modulos del proyecto al que esta registrado el usuario
        // de cada modulo mostrar el resultado del questionario mostrando: cantidad respondidas / total preg
        // mostrar el porcentaje y mostrar si esta aprobado o no


        $projects = $student->projects;
        //los id de los modules que corresponden al proyecto del usuario
        $modules = $projects->map(function($item){
            return $item->modules->pluck('id');
        })->values();

        return $modules;

        $collection = collect([
            'projects' => $projects,
        ]);
        //get projects
        //get modules

        return $collection;
        /* $question_id = 2;
        $question = Question::find($question_id);
        $is_correct = $question->answer == 'A' ? 1 : 0;
        $module_id = 1;
        $module = Module::find($module_id);
        $project = Project::find(1);
        $student = Student::find($request->student_id); */
        /* return $student->ids_questions; */
        /* $attempt = $student->answers()
                    ->byProject(1)
                    ->byModule(1)
                    ->byQuestion(2)
                    ->pluck('attempt')
                    ->max();
        return $attempt; */
        /* return $module->answers()->correctAnswers()->byAttempt(1)->count();  *///sale 0 porque esa si la he fallado
        /* return $question->answers()->correctAnswers()->count(); */
        /* if($attempt && $attempt == $project->attempts) return 'Ya no continua '.$attempt.' <= '.$project->attempts;

        if(!$attempt){
            $answer = new Answer();
            $answer->answer = 'A';
            $answer->module_id = $module_id;
            $answer->question_id = $question_id;
            $answer->student_id = $student->id;
            $answer->attempt = 1;
            $answer->correct = $is_correct;
            $answer->save();

            return 'primer intento';
        }

        if($attempt <= $project->attempts){
            $answer = new Answer();
            $answer->answer = 'A';
            $answer->module_id = $module_id;
            $answer->question_id = $question_id;
            $answer->student_id = $student->id;
            $answer->attempt = $attempt + 1;
            $answer->correct = $is_correct;
            $answer->save();
            return 'menor igual '. $attempt. ' <= '.$project->attempts;
        } */
        /* return $project; */
    }

    public function attemptsByStudent(Student $student, Request $request)
    {
        $module = Module::find($request->module_id);
        $attempt = $student->answers()
                    ->byProject($module->project_id)
                    ->byModule($module->id)
                    ->pluck('attempt')
                    ->max();
        return $attempt;
    }

    public function answerQuestion(Request $request)
    {
        $student            = Student::find($request->student_id);
        $question           = Question::find($request->question_id);
        $project            = Project::find($question->project_id);
        $is_correct         = $question->answer == $request->answer ? 1 : 0;
        $attempt = $student->answers()
                    ->byQuestion($question->id)
                    ->byModule($question->module_id)
                    ->byProject($question->project_id)
                    ->pluck('attempt')
                    ->max();
        if(!$attempt){
            $answer = new Answer();
            $answer->answer                 = $request->answer;
            $answer->module_id              = $question->module_id;
            $answer->question_id            = $request->question_id;
            $answer->project_id             = $question->project_id;
            $answer->student_id             = $student->id;
            $answer->attempt                = 1;
            $answer->correct                = $is_correct;
            $answer->save();

            return $answer;
        }

        if($attempt <= $project->attempts){
            $answer = new Answer();
            $answer->answer                 = $request->answer;
            $answer->module_id              = $question->module_id;
            $answer->question_id            = $question->id;
            $answer->project_id             = $question->project_id;
            $answer->student_id             = $student->id;
            $answer->attempt                = $attempt + 1;
            $answer->correct                = $is_correct;
            $answer->save();
            
            return $answer;
        }

    }

    public function studentProjectResults(Student $student,Request $request)
    {
        $modules = Module::byProject($request->project_id)
            ->orderBy('order')
            ->get();
        
        $answers = $modules->map(function($item) use ($student) {
            return $item->answers()
                ->byStudent($student->id)
                ->get()
                ->groupBy('attempt');
        })->values();

        //

        $object = new \stdClass();
        $object->modules = $modules;
        $object->answers = $answers;
        return $object;
    }

}
