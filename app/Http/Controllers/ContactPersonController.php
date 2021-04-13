<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ContactPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactPersons = User::all();

        return view('frontend.contact_person.index')->with('contactPersons', $contactPersons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactPerson = new User();

        return view('frontend.contact_person.create')->with('contactPerson', $contactPerson);
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
            'name' => 'required|max:40',
            'email' => 'required|email|max:30|unique:users,email',
        ]);

        $contactPerson = new User();
        $contactPerson->setAttributes($request->all());

        try {
            $contactPerson->save();
            session()->flash('success', 'Kapcsolattarttó felvitele megtörtént');
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
            $contactPerson = User::findOrFail($id);

            return view('frontend.contact_person.show')->with('contactPerson', $contactPerson);
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
            $contactPerson = User::findOrFail($id);
            return view('frontend.contact_person.edit')->with('contactPerson', $contactPerson);
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
            'name' => 'required|max:40',
            'email' => 'required|email|max:30|unique:users,email,' . $id,
        ]);

        try {
            $contactPerson = User::findOrFail($id);
            $contactPerson->setAttributes($request->all());

            try {
                $contactPerson->save();
                session()->flash('success', 'Kapcsolattartó módosítva');
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        try {
            $contactPerson = User::findOrFail($id);
            //$contactPerson->delete();

            return response()->json(['message' => 'A kapcsolattartó törölve']);
        } catch (\Exception $e) {
            return response()->json(['err' => $e->getMessage()]);
        }
    }
}
