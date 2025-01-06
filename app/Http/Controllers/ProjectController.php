<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::query()
            ->with([
                'property:id,project_id,name',
                'propertyBroker'
                //'property.broker:id,property_id,name'
            ])
            ->get();
    }

    public function show(Project $project)
    {
        return $project;
    }
}
