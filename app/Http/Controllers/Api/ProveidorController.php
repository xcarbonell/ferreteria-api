<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Proveidor;
use Illuminate\Http\Request;

class ProveidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveidor = Proveidor::all();

        if (!$proveidor) {
            return response()->json([
                'success' => false,
                'message' => 'No proveidors'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $proveidor->toArray()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|max:50',
            'city' => 'required|max:50',
            'speciality' => 'required|max:50'
        ]);

        $proveidor = Proveidor::create([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'speciality' => $validated['speciality']
        ]);

        if ($proveidor->save()) {
            return response()->json([
                'success' => true,
                'data' => 'Proveidor saved'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $proveidor = Proveidor::where('id', $id)->get();

        //si no hay atributos quiere decir que el registro no existe en la BBDD
        if ($proveidor[0]->attributes) {
            return response()->json([
                'success' => false,
                'message' => 'Proveidor with id ' . $id . ' not found'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $proveidor->toArray()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $proveidor = Proveidor::find($id);

        $validated = $request->validate([
            'name' => 'required|max:50',
            'city' => 'required|max:255',
            'speciality' => 'required|max:50'
        ]);

        $proveidor->name = $validated['name'];
        $proveidor->city = $validated['city'];
        $proveidor->speciality = $validated['speciality'];

        if (!$proveidor->update($request->all())) {
            return response()->json([
                'success' => false,
                'message' => 'Proveidor with id ' . $id . ' can not be updated'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => 'Proveidor updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $proveidor = Proveidor::where('id', $id)->delete();

        if (!$proveidor) {
            return response()->json([
                'success' => false,
                'message' => 'Proveidor with id ' . $id . ' not found'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => 'Proveidor deleted'
        ], 200);
    }
}
