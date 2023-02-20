<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();

        $projects->load("type", "technologies");

        return response()->json($projects);
    }

    public function show(Project $project){
        // $projects = Project::paginate(3);
        $project->load("type", "technologies");

        return response()->json($project);
    }
}


