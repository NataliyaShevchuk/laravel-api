<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        
        $types = Type::all();
        
        $technologies = Technology::all();

        // $projects = Project::paginate();
        
        return view('admin.projects.index', [
            'project' => $project,
            'types' => $types,
            'technologies' => $technologies,
            // 'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', [
            'types' => $types,
            'technologies' => $technologies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request, Project $project)
    {

        // $secureData = $request->validated();
        
        $secureData = $request->all();
        


        // dd($secureData['name']);


        // Salviamo il file nello storage e recuperiamo il path
        $path = Storage::put("projects", $secureData["cover_img"]);


        // usiamo il path per salvarlo a db
        // $project->new_cover_img = $path;
        // $project->save();

        // dd($path);

        // Prende ogni chiave dell'array associativo e ne assegna il valore all'istanza del prodotto

        // $project->save();

        // carico il file SOLO se ne ricevo uno
        // if (key_exists("new_cover_img", $secureData)) {
            // carico il nuovo file
            // salvo in una variabile temporanea il percorso del nuovo file
            // $path = Storage::disk('public')->put('projects', $secureData['new_cover_img']);


            // Dopo aver caricato la nuova immagine, PRIMA di aggiornare il db,
            // cancelliamo dallo storage il vecchio file.
            // $post->cover_img // vecchio file

        // }



        // $project = new Project();
        $project->fill($secureData);
        $project->cover_img = $path;
        $project->save();
        // $project = $project->create([
        //     "name" => $secureData['name'] ,
        //     "new_cover_img" => $path ?? ' '
        // ]);
        // dd($path);
        // $project->save();
        if ($request->has('technologies')){
            $project->technologies()->attach($secureData["technologies"]);
        }

        return redirect()->route("admin.projects.show", compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', [
            'project' => $project,
            'types' => $types,
            'technologies' => $technologies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $project->technologies()->sync("technologies");

        return redirect()->route("admin.projects.show", $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->cover_img) {
            Storage::delete($project->cover_img);
        }

        $project->technologies()->detach();

        $project->delete();

        return redirect()->route("admin.projects.index", $project->id);
    }
}
