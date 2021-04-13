<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $numberOfStatutes = Status::count();
        $users = User::count();

        return view('frontend.project.index')
            ->with('projects', $projects)
            ->with('numberOfStatutes', $numberOfStatutes)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {
            $project = new Project();
            $statuses = Status::orderBy('name')->get();
            $contactPersons = User::orderBy('name')->get();

            return view('frontend.project.create')
                ->with('project', $project)
                ->with('statuses', $statuses)
                ->with('contactPersons', $contactPersons);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:projects,name',
            'description' => 'required|min:10',
            'status_id' => 'required|not_in:0',
            'contact_persons' => 'required|array|min:1',
        ]);

        $project = new Project();
        $project->setAttributes($request->all());

        try {
            $project->save();
            $project->users()->attach($request->input('contact_persons'));

            session()->flash('success', 'Projekt elmentve');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $project = Project::findOrFail($id);
            $statutes = Status::orderBy('name')->get();
            $contactPersons = User::orderBy('name')->get();


            return view('frontend.project.show')
                ->with('project', $project)
                ->with('statuses', $statutes)
                ->with('contactPersons', $contactPersons);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $project = Project::findOrFail($id);
            $statuses = Status::orderBy('name')->get();
            $contactPersons = User::orderBy('name')->get();

            return view('frontend.project.edit')
                ->with('project', $project)
                ->with('statuses', $statuses)
                ->with('contactPersons', $contactPersons);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:projects,name,' . $id,
            'description' => 'required|min:10',
            'status_id' => 'required|not_in:0',
            'contact_persons' => 'required|array|min:1'
        ]);

        try {
            $project = Project::findOrFail($id);
            $project->setAttributes($request->all());

            try {

                Status::findOrFail($request->input('status_id'));

                try {

                    $project->save();
                    $project->users()->sync($request->input('contact_persons'));
                    session()->flash('success', 'Projekt módosítva');

                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }

            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $project = Project::findOrFail($id);
            $project->users()->detach();

            $project->delete();

            return response()->json(['message' => 'A kapcsolattartó törölve']);
        } catch (\Exception $e) {
            return response()->json(['err' => $e->getMessage()]);
        }
    }
}
