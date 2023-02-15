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

        return response()->json($projects);
    }

    public function show(Project $projects){
        $projects = Project::paginate(3);
        $projects->load("type", "technologies");

        return response()->json($projects);
    }
}


