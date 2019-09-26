<?php

namespace App\Http\Controllers;

use App\Resident;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Auth;
use DB;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($file_id)
    {   
        return response((Storage::get("contract/{$file_id}.pdf")))->header('Content-Type', 'application/pdf');
        // return Storage::download("contract/{$file_id}.pdf");
        // return redirect(action('HomeController@index'));
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
        $resident = new Resident;
        $resident->user_id = $request->user_id;
        $resident->flat_id = $request->flat_id;
        $resident->building_id = $request->building_id;
        $resident->begining_of_first_rent = $request->begining_of_first_rent;
        $resident->begining_of_current_rent = $request->begining_of_current_rent;
        $resident->contract_id = $request->contract_id;
        $resident->end_of_current_rent = $request->end_of_current_rent == "null" ? null : $request->end_of_current_rent;
        $resident->number_of_residents = $request->number_of_residents;
        $resident->rental = $request->rental;
        if ($request->hasFile("file")) {
        $resident->file = $request->file('file')->storeAs('contract', "{$request->flat_id}.pdf");
        }   
        $resident->save();

        $id = $request->building_id;

        return redirect(action('HomeController@bedit', compact('id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Resident $resident, $id)
    {
        DB::table('residents')
        ->where('id', $id)
        ->update([
            'flat_id' => $request->flat_id,
            'building_id' => $request->building_id,
            'begining_of_first_rent' => $request->begining_of_first_rent,
            'begining_of_current_rent' => $request->begining_of_current_rent,
            'contract_id' => $request->contract_id,
            'end_of_current_rent' => $request->end_of_current_rent == "null" ? null : $request->end_of_current_rent,
            'number_of_residents' => $request->number_of_residents,
            'rental' => $request->rental,
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file')->storeAs('contract', "{$request->flat_id}.pdf");    
            }

            $id = $request->building_id;
        return redirect(action('HomeController@bedit', compact('id')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident, $resident_id, $user_id)
    {
        DB::table('residents')
        ->where('id', $resident_id)
        ->update([
            'flat_id' => $request->flat_id,
            'begining_of_first_rent' => $request->begining_of_first_rent,
            'begining_of_current_rent' => $request->begining_of_current_rent,
            'contract_id' => $request->contract_id,
            'rental' => $request->rental,
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file')->storeAs('contract', "{$request->flat_id}.pdf");    
            }

        DB::table('users')
        ->where('id', $user_id)
        ->update([
            'email' => $request->email,
            'phone_number' => $request->phone,
            ]);
            
        return redirect(action('WebController@dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident, $id, Request $request)
    {
        DB::table('residents')
        ->where('id', $id)
        ->delete();
        // Storage::delete("contract/{$request->flat_id}.pdf");

        $id = $request->building_id;
        return redirect(action('WebController@dashboard', compact('id')));
    }
}
