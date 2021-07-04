<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use DB;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::latest()->paginate(5);

        return view('colors.index',compact('colors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colors.create');
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
        
        if (DB::table('colors')->where('name', $namecheck )->exists()) {
            return redirect()->route('colors.index')
            ->with('success','Color already exists! No record was created');
        }else{

        Color::create($request->all());

        return redirect()->route('colors.index')
                        ->with('success','Color created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        return view('colors.show',compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('colors.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $namecheck = $request->name;
        $status = $request->status;    
        
        if (DB::table('colors')->where('name', $namecheck )->where('status', $status )->exists()) {
            return redirect()->route('colors.index')
            ->with('success','Nothing changed');
        }else{
         
        $color->update($request->all());

        return redirect()->route('colors.index')
                        ->with('success','Color updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index')
                        ->with('success','Color deleted successfully');
    }

     /**
     * Update Status
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $color = Color::findOrFail($request->color_id);
        $color->status = $request->status;
        $color->save();

        return response()->json(['message' => 'Color status updated successfully.']);
    }

    /**
     * Update Finish
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function updateFinish(Request $request)
    {
        $color = Color::findOrFail($request->color_id);
        $color->metallic = $request->metallic;
       
        if($request->metallic == 1){
            $new_name = $color->name . ' - metallic';
            $color->name = $new_name;
        }else{
            $current_name = $color->name;
            $new_name = str_replace(' - metallic', '', $current_name);
            $color->name = $new_name;
        }

        $color->save();

        return response()->json(['message' => 'Color finish updated successfully.']);
    }
}
