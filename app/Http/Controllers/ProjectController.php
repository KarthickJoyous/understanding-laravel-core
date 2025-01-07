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
                //'property:id,project_id,name',
                //'propertyBroker:id,name', // Will give error
                'propertyBroker' => function ($query) {
                    $query->select('brokers.id', 'brokers.name');
                },
                //'property.broker:id,property_id,name' // Nested
            ])
            ->get();
    }

    public function show(Project $project)
    {
        return $project;
    }
}
