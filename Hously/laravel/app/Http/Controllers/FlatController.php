<?php

namespace App\Http\Controllers;

use App\Flat;
use DB;
use Illuminate\Http\Request;

class FlatController extends Controller
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
        

        $flat = new Flat;
        $flat->building_id = $request->building_id;
        $flat->floor = $request->floor;
        $flat->number = $request->number;
        $flat->residential = $request->residential;
        $flat->save();

        $id = $request->building_id;
        return redirect(action('HomeController@bedit', compact("id")));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Flat $flat, $id)
    {
        DB::table('flats')
        ->where('id', $id)
        ->update([
            'number' => $request->number,
            'floor' => $request->floor,
            'residential' => $request->residential,]);
        
            $id = $request->building_id;
            return redirect(action('HomeController@bedit', compact("id")));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat, $id, Request $request)
    {
        DB::table('flats')
        ->where('id', $id)
        ->delete();

        $id = $request->building_id;
        return redirect(action('HomeController@bedit', compact("id")));
    }
}
