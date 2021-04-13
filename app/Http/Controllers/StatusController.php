<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();

        return view('frontend.status.index')
            ->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $status = new Status();

            return view('frontend.status.create')
                ->with('status', $status);

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
            'name' => 'required|max:50|unique:statuses,name',
        ]);

        $status = new Status();
        $status->setAttributes($request->all());

        try {
            $status->save();
            session()->flash('success', 'Státusz elmentve');
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

            $status = Status::findOrFail($id);

            return view('frontend.status.show')
                ->with('status', $status);

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
            $status = Status::findOrFail($id);

            return view('frontend.status.edit')
                ->with('status', $status);

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
            'name' => 'required|max:50|unique:statuses,name,' . $id
        ]);

        try {
            $status = Status::findOrFail($id);
            $status->setAttributes($request->all());
            if (Status::whereHas('projects', function ($q) use ($id) {
                    $q->where('status_id', '=', $id);
                })->first() == null) {
                try {
                    $status->save();
                    session()->flash('success', 'Státusz módosítva');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Módosítás elutasítva: projekthez rendelve.");
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
            $status = Status::findOrFail($id);

            if (Status::whereHas('projects', function ($q) use ($id) {
                    $q->where('status_id', '=', $id);
                })->first() == null) {
                try {
                    $status->delete();
                    session()->flash('success', 'Státusz törölve');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Törlés elutasítva: projekthez rendelve.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
