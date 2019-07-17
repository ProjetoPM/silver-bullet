<?php

namespace App\Http\Requests;

use App\Project;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('project_edit');
    }

    public function rules()
    {
        return [
            'title'       => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'visibility'  => [
                'required',
            ],
        ];
    }
}
