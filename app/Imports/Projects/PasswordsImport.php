<?php

namespace App\Imports\Projects;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Project\Password;
use App\Models\Project\Project;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasswordsImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    */
    public function model(array $row)
    {
        $project_id = Project::get()->max('id');
        
        return new Password([
            'password' => $row['passwords'],
            'type' => 'MULTIPLE',
            'project_id' => $project_id,
        ]);
    }
}
