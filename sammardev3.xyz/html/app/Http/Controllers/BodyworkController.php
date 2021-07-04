<?php

namespace App\Http\Controllers;

use App\Bodywork;
use Illuminate\Http\Request;
use DB;

class BodyworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodyworks = Bodywork::latest()->paginate(5);

        return view('bodyworks.index',compact('bodyworks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bodyworks.create');
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
        
        if (DB::table('bodyworks')->where('name', $namecheck )->exists()) {
            return redirect()->route('bodyworks.index')
            ->with('success','Bodywork already exists! No record was created');
        }else{

        Bodywork::create($request->all());

        return redirect()->route('bodyworks.index')
                        ->with('success','Bodywork created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bodywork  $bodywork
     * @return \Illuminate\Http\Response
     */
    public function show(Bodywork $bodywork)
    {
        return view('bodyworks.show',compact('bodywork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bodywork  $bodywork
     * @return \Illuminate\Http\Response
     */
    public function edit(Bodywork $bodywork)
    {
        return view('bodyworks.edit',compact('bodywork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bodywork  $bodywork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bodywork $bodywork)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $namecheck = $request->name;
        $status = $request->status;  
        
        if (DB::table('bodyworks')->where('name', $namecheck )->where('status', $status )->exists()) {
            return redirect()->route('bodyworks.index')
            ->with('success','Nothing changed');
        }else{

        $bodywork->update($request->all());

        return redirect()->route('bodyworks.index')
                        ->with('success','Bodywork updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bodywork  $bodywork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bodywork $bodywork)
    {
        $bodywork->delete();

        return redirect()->route('bodyworks.index')
                        ->with('success','Bodywork deleted successfully');
    }

     /**
     * Update Status
     *
     * @param  \App\Bodywork  $bodywork
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $bodywork = Bodywork::findOrFail($request->bodywork_id);
        $bodywork->status = $request->status;
        $bodywork->save();

        return response()->json(['message' => 'Bodywork status updated successfully.']);
    }
}
