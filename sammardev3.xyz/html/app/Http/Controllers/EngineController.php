<?php

namespace App\Http\Controllers;

use App\Engine;
use Illuminate\Http\Request;
use DB;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engines = Engine::latest()->paginate(5);

        return view('engines.index',compact('engines'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('engines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $namecheck = $request->name;

        if (DB::table('engines')->where('name', $namecheck )->exists()) {
            return redirect()->route('engines.index')
            ->with('success','Vehicle Engine already exists! No record was created');
        }else{

        Engine::create($request->all());
        return redirect()->route('engines.index')
                        ->with('success','Engine created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function show(Engine $engine)
    {
        return view('engines.show',compact('engine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function edit(Engine $engine)
    {
        return view('engines.edit',compact('engine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engine $engine)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $namecheck = $request->name;
        $status = $request->status;

        if (DB::table('engines')->where('name', $namecheck )->where('status', $status )->exists()) {
            return redirect()->route('engines.index')
            ->with('success','Nothing changed');
        }else{

        $engine->update($request->all());

        return redirect()->route('engines.index')
                        ->with('success','Engine updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engine $engine)
    {
        $engine->delete();

        return redirect()->route('engines.index')
                        ->with('success','Engine deleted successfully');
    }

    /**
     * Update Status
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $engine = Engine::findOrFail($request->engine_id);
        $engine->status = $request->status;
        $engine->save();

        return response()->json(['message' => 'Engine status updated successfully.']);
    }
}
