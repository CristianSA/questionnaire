<?php

namespace App\Imports\Projects;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Project\Password;

class PasswordsImport implements ToModel
{
    public $project_id;

    public function __constructor($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
    * @param array $row
    */
    public function model(array $row)
    {
        return new Passwords([
            'password' => $row['password'],
            'type' => 'MULTIPLE',
            'project_id' => $this->project_id,
        ]);
    }
}
