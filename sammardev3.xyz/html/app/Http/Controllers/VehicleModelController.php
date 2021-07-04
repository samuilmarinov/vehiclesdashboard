<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use App\Brand;
use Illuminate\Http\Request;
use DB;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $vehiclemodels = VehicleModel::latest()->paginate(5);

        $brands =  Brand::get();
    
        return view('vehiclemodels.index',compact('vehiclemodels', 'brands'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands =  Brand::get();
        foreach ($brands as $brand) {
           $brandname = $brand->name;
           $brandid = $brand->id;
        }
    
        return view('vehiclemodels.create',compact('brands'));
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
            'brand_id' => 'required',
        ]);

        $brandcheck = $request->brand_id;
        $namecheck = $request->name;

        if (DB::table('vehicle_models')->where('brand_id', $brandcheck)->where('name', $namecheck )->exists()) {
            return redirect()->route('vehiclemodels.index')
            ->with('success','Vehicle Model already exists! No record was created');
        }else{

        VehicleModel::create($request->all());

        return redirect()->route('vehiclemodels.index')
                        ->with('success','Model created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleModel  $vehiclemodel
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $vehiclemodel)
    {   
        return view('vehiclemodels.show',compact('vehiclemodel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleModel  $vehiclemodel
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleModel $vehiclemodel)
    {   
        $brands =  Brand::get();
        foreach ($brands as $brand) {
           $brandname = $brand->name;
           $brandid = $brand->id;
        }

        return view('vehiclemodels.edit',compact('vehiclemodel','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleModel  $vehiclemodel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $vehiclemodel)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
        ]);

        $brandcheck = $request->brand_id;
        $namecheck = $request->name;
        $status = $request->status;

        if (DB::table('vehicle_models')->where('status', $status)->where('brand_id', $brandcheck)->where('name', $namecheck )->exists()) {
            return redirect()->route('vehiclemodels.index')
            ->with('success','Nothing changed');
        }else{

        $vehiclemodel->update($request->all());

        return redirect()->route('vehiclemodels.index')
                        ->with('success','Model updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleModel  $vehiclemodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $vehiclemodel)
    {
        $vehiclemodel->delete();

        return redirect()->route('vehiclemodels.index')
                        ->with('success','Model deleted successfully');
    }

    /**
     * Update Status
     *
     * @param  \App\VehicleModel  $vehiclemodel
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $vehiclemodel = VehicleModel::findOrFail($request->vehiclemodel_id);
        $vehiclemodel->status = $request->status;
        $vehiclemodel->save();

        return response()->json(['message' => 'Model status updated successfully.']);
    }

}
