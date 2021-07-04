<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use App\Vehicle;
use App\Brand;
use App\Bodywork;
use App\Color;
use App\Engine;
use App\VehicleModel;
use Illuminate\Http\Request;
use DataTables;
use DB;
use File;
use DateTime;
use Carbon;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(20);

        $brandsactive = Brand::where('status', 1)->get();


        $brands =  Brand::get();
        foreach ($brands as $brand) {
           $brandname = $brand->name;
           $brandid = $brand->id;
        }

        $vehiclemodels =  VehicleModel::get();
        foreach ($vehiclemodels as $vehiclemodel) {
           $vehiclemodel = $vehiclemodel->name;
        }

        $bodyworks =  Bodywork::get();
        $colors =  Color::get();
        $engines =  Engine::get();

        // return view('vehicles.index',compact('vehicles', 'brandsactive', 'brands', 'vehiclemodels'))
        // ->with('i', (request()->input('page', 1) - 1) * 20);

        // return view ( 'vehicles.index' )->withBrands($brands)->withVehicleModels($vehiclemodels);

        return view('vehicles.index',compact('vehicles', 'brandsactive', 'brands', 'vehiclemodels', 'bodyworks', 'colors', 'engines'));

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

        $vehiclemodels =  VehicleModel::get();
        foreach ($vehiclemodels as $vehiclemodel) {
           $vehiclemodel = $vehiclemodel->name;
        }

        $bodyworks =  Bodywork::get();
        $colors =  Color::get();
        $engines =  Engine::get();
    
        return view('vehicles.create',compact('brands', 'vehiclemodels', 'bodyworks', 'colors','engines' ));
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
            'version' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'color_id' => 'required',
            'engine_id' => 'required',
            'bodywork_id' => 'required',
            'image' => 'required',
        ]);
        
        $brandcheck = $request->brand_id;
        $modelcheck = $request->model_id;
        $bodywork = $request->bodywork_id;
        $engine = $request->engine_id;
        $color = $request->color_id;

      
        if (DB::table('vehicles')->where('brand_id', $brandcheck)->where('model_id', $modelcheck )->where('bodywork_id', $bodywork )->where('engine_id', $engine )->where('color_id', $color )->exists()) {
            return redirect()->route('vehicles.create')
            ->with('success','Vehicle already exists! No record was created');
        }else{
        

            if ($files = $request->file('image')) {
            
                $file = $request->image->getClientOriginalName(); 

                $extension = $request->image->getClientOriginalExtension(); 

                $image = $file;  

                $destinationPath = 'uploads/images/'; 
        
                $files->move($destinationPath, $image);
                
                // $update['image'] = $image;
            }

            Vehicle::insert($request->all());

            // Vehicle::create($request->all());

            return redirect()->route('vehicles.index')
                            ->with('image',$image)
                            ->with('success','Vehicle created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show',compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {   
        $brands =  Brand::get();
        foreach ($brands as $brand) {
           $brandname = $brand->name;
           $brandid = $brand->id;
        }

        $vehiclemodels =  VehicleModel::get();
        foreach ($vehiclemodels as $vehiclemodel) {
           $vehiclemodel = $vehiclemodel->name;
        }

        $bodyworks =  Bodywork::get();
        $colors =  Color::get();
        $engines =  Engine::get();

        return view('vehicles.edit',compact('vehicle', 'brands', 'vehiclemodels', 'bodyworks', 'colors','engines' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'version' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'color_id' => 'required',
            'engine_id' => 'required',
            'bodywork_id' => 'required',
        ]);

        $brandcheck = $request->brand_id;
        $modelcheck = $request->model_id;
        $bodywork = $request->bodywork_id;
        $engine = $request->engine_id;
        $color = $request->color_id;
        $version = $request->version;
        $info = $request->info;
        $status = $request->status;

      
        if (DB::table('vehicles')->where('brand_id', $brandcheck)->where('model_id', $modelcheck )->where('bodywork_id', $bodywork )->where('engine_id', $engine )->where('color_id', $color )->where('version', $version)->where('info', $info)->where('status', $status )->exists()) {
            $path = '/vehicles/'.$vehicle->id.'/edit';
            return redirect($path)
            ->with('success','Try changing something - or navigate back');
        }else{


        if ($files = $request->file('image')) {

            $destinationPath = 'uploads/images/'; 

            $nameimage = $request->image->getClientOriginalName(); 

            $extension = $request->image->getClientOriginalExtension();  

            $image = $nameimage;  

            $files->move($destinationPath, $image);
            $update['image'] = $image;
        }

        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')
                        ->with('success','Vehicle updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
                        ->with('success','Vehicle deleted successfully');
    }

    /**
     * Update Status
     *
     * @param  \App\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {   
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $vehicle->status = $request->status;
        $vehicle->save();

        return response()->json(['message' => 'Vehicle status updated successfully.']);
    }


    public function getModels($id) 
    {        
       
        $vmodels = DB::table("vehicle_models")
        ->where("brand_id",$id)
        ->where('status', '=', 1)
        ->pluck("name","id");

        return json_encode($vmodels);
    }



    /**
     * getvehicles
     *
     * @param  \App\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function getvehicles(Request $request)
    {       
            $vehicles_data = Vehicle::latest()->paginate(50);
            $brandsactive_data = Brand::where('status', 1)->get();
            $brands_data =  Brand::get();
            $vehiclemodels_data =  VehicleModel::get();
            
            $bodyworks =  Bodywork::get();
            $colors =  Color::get();
            $engines =  Engine::get();                
      
            $date = Input::get('from_date');     
                        
            if( $date != ''){

            $arrStart = explode("/", Input::get('from_date'));
            $arrEnd = explode("/", Input::get('to_date'));
    
            $from_date = Carbon::create($arrStart[2], $arrStart[0], $arrStart[1], 0, 0, 0);
            $to_date = Carbon::create($arrEnd[2], $arrEnd[0], $arrEnd[1], 23, 59, 59);
            
            $vehicles = Vehicle::between($from_date, $to_date);

            }else{

            $vehicles = Vehicle::select(['id', 'brand_id', 'model_id', 'bodywork_id', 'engine_id', 'color_id', 'created_at', 'updated_at', 'status', 'imageurl'])->with('vehiclebrand', 'vehiclemodel', 'vehiclebodywork', 'vehicleengine', 'vehiclecolor')->orderBy('id', 'desc');

            }


            return Datatables::of($vehicles)
            ->addColumn('id', function($row){
                return $row->id;
            })
            ->addColumn('imageurl', function($row){
                return '<img src="uploads/images/'. $row->imageurl .'" height="75" width="100" alt="" />';
            })
            ->addColumn('vehiclebrand', function($row){
                $brands_data =  Brand::get();
                foreach ($brands_data as $brand) {
                    if($brand->id == $row->brand_id ){
                        $row->brand_id = $brand->name;
                    }
                 }

                return  $row->brand_id;
            })
            ->addColumn('vehiclemodel', function($row){
                $vehiclemodels_data =  VehicleModel::get();
                foreach ($vehiclemodels_data as $model) {
                    if($model->id == $row->model_id ){
                        $row->model_id = $model->name;
                    }
                 }

                return $row->model_id;
            })
            ->addColumn('vehiclebodywork', function($row){
                $bodyworks =  Bodywork::get();
                foreach ($bodyworks as $bodywork) {
                    if($bodywork->id == $row->bodywork_id ){
                        $row->bodywork_id = $bodywork->name;
                    }
                 }

                return $row->bodywork_id;
            })
            ->addColumn('vehicleengine', function($row){
                $engines =  Engine::get();
                foreach ($engines as $engine) {
                    if($engine->id == $row->engine_id ){
                        $row->engine_id = $engine->name;
                    }
                 }

                return $row->engine_id;
            })
            ->addColumn('vehiclecolor', function($row){
                $colors =  Color::get();
                foreach ($colors as $color) {
                    if($color->id == $row->color_id ){
                        $row->color_id = $color->name;
                    }
                 }

                return $row->color_id;
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('m/d/y');
            })
            ->addColumn('updated_at', function($row){
                return $row->updated_at->format('m/d/y');
            })
            ->addColumn('status', function($row){
                if($row->status == 1){
                    $checked = 'checked';
                    $status = 'active';
                    $class = 'bg-warning';
                }else{
                    $checked = '';
                    $status = 'active';
                    $class = 'bg-danger';
                }
                // return '<span style="text-align:right;">Status: <input type="checkbox" data-id="'. $row->id . '" name="status" class="js-switch" '.$checked.'> <span style="padding:2px 10px; color:white;" class="statsbox '.$class.'">'.$status.'</span></span>';
                
                return '<input id="'. $row->id . '" data-id="'. $row->id . '" name="status" class="my_switch js-switch" type="checkbox" '.$checked.' data-toggle="toggle" data-on="Active" data-off="Disabled" data-onstyle="success" data-offstyle="danger">';

            })
            ->addColumn('action', function($row){

                return '<form action="/vehicles/'. $row->id . '" method="POST">
                <input type="hidden" name="_token" value=" ' . csrf_token() . ' ">
                <a href="/vehicles/' . $row->id . '/edit" class="btn btn-xs btn-primary">Edit</a>
                <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-danger">Delete</button>
                </form>';
            })
            //ADDITIONAL FILTER STATUS ->orWhere('model_id','=', $model_id)
            ->filter(function ($vehicles) use ($request) {
                if ($request->get('status') == '0' || $request->get('status') == '1') {
                    $vehicles->where('status', $request->get('status'));
                }
                // elseif($request->get('model_id')){
                //     $vehicles->where('model_id', $request->get('model_id'));
                // }elseif($request->get('bodywork_id')){
                //     $vehicles->where('bodywork_id', $request->get('bodywork_id'));
                // }
                elseif($request->get('engine_id')){
                    $vehicles->where('engine_id', $request->get('engine_id'));
                }elseif($request->get('color_id')){
                    $vehicles->where('color_id', $request->get('color_id'));
                }
                // elseif($request->get('brand_id')){
                //     $vehicles->where('brand_id', $request->get('brand_id'));
                // }
                elseif (!empty($request->get('search_id'))) {
                   //START
                    $brands =  Brand::get();
                    $models =  VehicleModel::get();
                    $bodyworks =  Bodywork::get();
                    $colors =  Color::get();
                    $engines =  Engine::get();

                      //  $q = Input::get ( 'search' );
                        $q = $request->get('search');
                        $brand_id = DB::table('brands')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
                        $model_id = DB::table('vehicle_models')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
                        $color_id = DB::table('colors')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
                        $engine_id = DB::table('engines')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
                        $bwork_id = DB::table('bodyworks')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
                        
                        $vehicels = '';
                        $vehicles_get = '';

                        if ( sizeof($brand_id) ) { 
                            //var_dump($brand_id);
                            $vehicles->where('brand_id','=', $brand_id )->get();
                          //  $vehicles = $vehicles_get;
                        }
                        
                        if ( sizeof($model_id) ) { 
                            //var_dump($model_id);
                            $vehicles->where('model_id','=', $model_id )->get();
                          //  $vehicles = $vehicles_get;
                        }

                        if ( sizeof($color_id) ) { 
                            //var_dump($color_id);
                            $vehicles->where('color_id','=', $color_id )->get();   
                         //   $vehicles = $vehicles_get;
                        }

                        if ( sizeof($engine_id) ) { 
                            //var_dump($engine_id);
                            $vehicles->where('engine_id','=', $engine_id )->get();
                          //  $vehicles = $vehicles_get;
                        }

                        if ( sizeof($bwork_id) ) { 
                            //var_dump($bwork_id);
                            $vehicles->where('bodywork_id','=', $bwork_id )->get();
                          //  $vehicles = $vehicles_get;
                        }

                   //END
               }elseif($request->get('bodywork_id') && $request->get('brand_id') && $request->get('model_id')){
                
                $vehicles->where('bodywork_id', $request->get('bodywork_id'))->where('brand_id', $request->get('brand_id'))->where('model_id', $request->get('model_id'));
                
               }elseif($request->get('brand_id') && $request->get('model_id')){

                $vehicles->where('brand_id', $request->get('brand_id'))->where('model_id', $request->get('model_id'));
      
               }elseif($request->get('brand_id')){
                    $vehicles->where('brand_id', $request->get('brand_id'));
                }

            })
            //ADDITIONAL FILTER END
            ->rawColumns(['imageurl', 'action', 'status', 'brand_id'])
            ->make(true);

    }


    
    public function scopeBetween($query, Carbon $from_date, Carbon $to_date)
    {
            $query->whereBetween('created_at', [$from_date, $to_date]);
    }


}


