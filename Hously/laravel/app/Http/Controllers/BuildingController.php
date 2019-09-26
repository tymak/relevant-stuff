<?php

namespace App\Http\Controllers;

use App\Building;
use App\Noticeboard;
use App\Community;
use Illuminate\Http\Request;
use DB;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $building = new Building;
        $building->city = $request->city;
        $building->street = $request->street;
        $building->house_number = $request->house_number;
        $building->postal = $request->postal;
        $building->construction_date = $request->construction_date;
        $building->floors_above_ground = $request->floors_above_ground;
        $building->floors_bellow_ground = $request->floors_bellow_ground;
        $building->gas = $request->gas == "on" ? 1 : 0 ;
        $building->heating = $request->heating == "on" ? 1 : 0 ;
        $building->elevator = $request->elevator;
        $building->save();

        $thisbuilding =  DB::table('buildings')->orderBy('id', 'desc')->first();

        $noticeboard = new Noticeboard;
        $noticeboard->building_id = $thisbuilding->id;
        $noticeboard->save();

        $community = new Community;
        $community->community_name = "Obecná komunita";
        $community->building_id = $thisbuilding->id;
        $community->save();

        return redirect(action('HomeController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Building $building, $id)
    {
        DB::table('buildings')
        ->where('id', $id)
        ->update([
            'city' => $request->city,
            'street' => $request->street, 
            'house_number' => $request->house_number, 
            'postal' => $request->postal, 
            'owner_id' => $request->owner_id,
            'floors_above_ground' => $request->floors_above_ground, 
            'floors_bellow_ground' => $request->floors_bellow_ground, 
            'heating' => $request->heating, 
            'gas' => $request->gas, 
            'elevator' => $request->elevator]);
        return redirect(action('HomeController@index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $request->file('file')->storeAs(
            'house_rules', "{$request->id}.txt"
        );
        return redirect(action('HomeController@index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building, $id)
    {
        DB::table('buildings')
        ->where('id', $id)
        ->delete();
        return redirect(action('WebController@index'));
    }
}
