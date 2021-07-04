<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\BodyworkController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleController;
use App\Vehicle;
use App\Brand;
use App\Bodywork;
use App\Color;
use App\Engine;
use App\VehicleModel;
use Illuminate\Support\Facades\Input;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('dashboard');
});

Route::resource('brands','BrandController');
Route::get('/brand-status/update', 'BrandController@updateStatus')->name('brands.update.status');

Route::resource('engines','EngineController');
Route::get('/engine-status/update', 'EngineController@updateStatus')->name('engines.update.status');

Route::resource('bodyworks','BodyworkController');
Route::get('/bodywork-status/update', 'BodyworkController@updateStatus')->name('bodyworks.update.status');

Route::resource('colors','ColorController');
Route::get('/color-finish/update', 'ColorController@updateFinish')->name('colors.update.finish');
Route::get('/color-status/update', 'ColorController@updateStatus')->name('colors.update.status');

Route::resource('vehiclemodels','VehicleModelController');
Route::get('/vehiclemodel-status/update', 'VehicleModelController@updateStatus')->name('vehiclemodels.update.status');


Route::resource('vehicles','VehicleController');
Route::get('/vehicle-status/update', 'VehicleController@updateStatus')->name('vehicles.update.status');
Route::get('/vehicles/getmodels/{id}','VehicleController@getModels');
// Route::get('/vehicles/getmodelsbyname/{id}','VehicleController@getModelsName');
Route::get('/getvehicles', 'VehicleController@getvehicles')->name('vehicles.getvehicles');


Route::any('/search',function(){
    //TEST SEARCH
   $vehicles = Vehicle::latest()->paginate(50);

   $brands =  Brand::get();
   $models =  VehicleModel::get();
   $bodyworks =  Bodywork::get();
   $colors =  Color::get();
   $engines =  Engine::get();

     $q = Input::get ( 'search' );

     $brand_id = DB::table('brands')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
     $model_id = DB::table('vehicle_models')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
     $color_id = DB::table('colors')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
     $engine_id = DB::table('engines')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
     $bwork_id = DB::table('bodyworks')->where('name', 'LIKE','%'.$q.'%')->pluck('id');
    
     $vehicels = '';
     $vehicles_get = '';

     if ( sizeof($brand_id) ) { 
        //var_dump($brand_id);
        $vehicles_get = Vehicle::where('brand_id','=', $brand_id )->get();
        $vehicles = $vehicles_get;
     }
     
     if ( sizeof($model_id) ) { 
        //var_dump($model_id);
        $vehicles_get = Vehicle::where('model_id','=', $model_id )->get();
        $vehicles = $vehicles_get;
     }

     if ( sizeof($color_id) ) { 
        //var_dump($color_id);
        $vehicles_get = Vehicle::where('color_id','=', $color_id )->get();   
        $vehicles = $vehicles_get;
     }

     if ( sizeof($engine_id) ) { 
        //var_dump($engine_id);
        $vehicles_get = Vehicle::where('engine_id','=', $engine_id )->get();
        $vehicles = $vehicles_get;
     }

     if ( sizeof($bwork_id) ) { 
        //var_dump($bwork_id);
        $vehicles_get = Vehicle::where('bodywork_id','=', $bwork_id )->get();
        $vehicles = $vehicles_get;
     }

    

   //$vehicles = Vehicle::where('brand_id','=', $brand_id )->orWhere('model_id','=', $model_id)->orWhere('color_id','=', $bodywork_id)->orWhere('bodywork_id','=', $color_id)->orWhere('engine_id','=', $engine_id)->get();

    if(count($vehicles) > 0)

    return view('vehicles.index')->withDetails($vehicles)->withBrands($brands)->withModels($models)->withBodyworks($bodyworks)->withColors($colors)->withEngines($engines)->withQuery ( $q );
    else return view ('vehicles.search')->withMessage('No results. Try to search again !');


});











