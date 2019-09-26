<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Chat;
use App\User;
use App\Notice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $contract = null;
        $date = null;
        $file_id = null;
        $file = null;
        $resident = null;
        $owner = null; 
        $administrator = null;
        $owners = null;
        $current_user = null;
        $this_building = null;
        $flats = null;
        $residents_in_flats = [];
        $chats = null;
        $communities = null;
        $noticeboard = null;
        $notices = null;
        $residents  = null; 
        $users = null;




        //Speciální data dostupná pouze danému profilu
        if (DB::table('owners')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $owner         = DB::table('owners')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'owner';
            $building = $owner->building_id;
            $owners         = DB::table('owners')->where('building_id', '=', $building)->get();
            $this_building  = DB::table('buildings')->where('id', '=', $building)->first();
            $flats          = DB::table('flats')->where('building_id', '=', $building)->get();
            $noticeboard    = DB::table('noticeboards')->where('building_id', '=', $building)->first();
            $notices        = DB::table('notices')->where('noticeboard_id', '=', $noticeboard->id)->get();
            $residents      = DB::table('residents')->where('building_id', '=', $building)->get();
            $users          = DB::table('users')->get();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "žádná pravidla" ;
            foreach ($residents as $resid) {
                $residents_in_flats[$resid->flat_id] = DB::table('users')->where('id', '=', $resid->user_id)->first();
            }
            $community      = DB::table('communities')->where('building_id', '=', $building)->orderBy('id')->first();
            $communities    = DB::table('communities')->where('building_id', '=', $building)->get();
            foreach ($communities as $community)
            {
                $chats[]    = DB::table('chats')->where('community_id', '=', $community->id)->orderBy('created_at', 'asc')->get();
            }
        } elseif (DB::table('administrators')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $administrator = DB::table('administrators')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'administrator';
            $building = $administrator->building_id;
            $rentcontracts  = DB::table('contracts')->where('type', '=', 'Nájemní')->get();
            $owners         = DB::table('owners')->where('building_id', '=', $building)->get();
            $this_building  = DB::table('buildings')->where('id', '=', $building)->first();
            $flats          = DB::table('flats')->where('building_id', '=', $building)->get();
            $noticeboard    = DB::table('noticeboards')->where('building_id', '=', $building)->first();
            $notices        = $noticeboard !== null ? DB::table('notices')->where('noticeboard_id', '=', $noticeboard->id)->get() : null;
            $residents      = DB::table('residents')->where('building_id', '=', $building)->get();
            $users          = DB::table('users')->get();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "žádná pravidla" ;
            $last_flat_number = DB::table('flats')->where("building_id", "=", $building)->orderBy("number", 'desc')->first();
            foreach ($residents as $resid) {
                $residents_in_flats[$resid->flat_id] = DB::table('users')->where('id', '=', $resid->user_id)->first();
            }
            $community      = DB::table('communities')->where('building_id', '=', $building)->orderBy('id')->first();
            $communities    = DB::table('communities')->where('building_id', '=', $building)->get();
            foreach ($communities as $community)
            {
                $chats[]    = DB::table('chats')->where('community_id', '=', $community->id)->orderBy('created_at', 'asc')->get();
            }
        } elseif (DB::table('residents')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $resident      = DB::table('residents')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'resident';
            $building = $resident->building_id;
            $contract       = DB::table('contracts')->where('id', '=', $resident->contract_id)->first();
            $date           = explode('-' ,$resident->begining_of_current_rent);
            $date           = "{$date[2]}. {$date[1]}. {$date[0]}";     //Převedení data z formátu YY-mm-dd na formát dd. mm. YY
            $file_id        = $resident->id;
            $file           = Storage::url("contract/{$file_id}.pdf");
            $rentcontracts  = DB::table('contracts')->where('type', '=', 'Nájemní')->get();
            $current_user   = DB::table('users')->where('id', '=', Auth::user()->id)->first();
            $noticeboard    = DB::table('noticeboards')->where('building_id', '=', $building)->first();
            $notices        = DB::table('notices')->where('noticeboard_id', '=', $noticeboard->id)->get();
            $residents      = DB::table('residents')->where('building_id', '=', $building)->get();
            $users          = DB::table('users')->get();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "žádná pravidla" ;
            foreach ($residents as $resid) {
                $residents_in_flats[$resid->flat_id] = DB::table('users')->where('id', '=', $resid->user_id)->first();
            }
            $community      = DB::table('communities')->where('building_id', '=', $building)->orderBy('id')->first();
            $communities    = DB::table('communities')->where('building_id', '=', $building)->get();
            foreach ($communities as $community)
            {
                $chats[]    = DB::table('chats')->where('community_id', '=', $community->id)->orderBy('created_at', 'asc')->get();
            }
        } elseif (DB::table('superusers')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $profil = 'superuser';
            $users          = DB::table('users')->get();
            $allresidents   = DB::table('residents')->get();
            $allowners      = DB::table('owners')->get();
            $alladmins      = DB::table('administrators')->get();
            $allbuildings   = DB::table('buildings')->get();
            $allflats       = DB::table('flats')->get();
        }
        
        return view('auth/home', compact('chats', 'users', 'communities', 'current_user', 'resident', 'date', 'contract', 'building', 'notices', 'noticeboard', 'flats', 'rentcontracts', 'file', 'file_id', 'this_building', 'residents', 'owners', 'rules', 'profil', 'allresidents', 'allowners', 'alladmins', 'allbuildings', 'community', 'allflats'));
    }

    public function api()
    {
        $contract = null;
        $date = null;
        $file_id = null;
        $file = null;
        $resident = null;
        $owner = null; 
        $administrator = null;
        $owners = null;
        $current_user = null;
        $this_building = null;
        $flats = null;
        $residents_in_flats = [];
        $rentcontracts = null;

        //Speciální data dostupná pouze danému profilu
        if (DB::table('owners')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $owner         = DB::table('owners')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'owner';
            $building = $owner->building_id;
            $owners         = DB::table('owners')->where('building_id', '=', $building)->get();
            $this_building  = DB::table('buildings')->where('id', '=', $building)->first();
            $flats          = DB::table('flats')->where('building_id', '=', $building)->get();
            $current_user   = DB::table('users')->where('id', '=', Auth::user()->id)->first();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "House rules empty. No rules. Anarchy!!!" ;
        } elseif (DB::table('administrators')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $administrator = DB::table('administrators')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'administrator';
            $building = $administrator->building_id;
            $rentcontracts  = DB::table('contracts')->where('type', '=', 'Nájemní')->get();
            $owners         = DB::table('owners')->where('building_id', '=', $building)->get();
            $this_building  = DB::table('buildings')->where('id', '=', $building)->first();
            $flats          = DB::table('flats')->where('building_id', '=', $building)->get();
            $current_user   = DB::table('users')->where('id', '=', Auth::user()->id)->first();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "House rules empty. No rules. Anarchy!!!" ;
        } elseif (DB::table('residents')->where('user_id', '=', Auth::user()->id)->first() != null) {
            $resident      = DB::table('residents')->where('user_id', '=', Auth::user()->id)->first();
            $profil = 'resident';
            $building = $resident->building_id;
            $contract       = DB::table('contracts')->where('id', '=', $resident->contract_id)->first();
            $date           = explode('-' ,$resident->begining_of_current_rent);
            $date           = "{$date[2]}. {$date[1]}. {$date[0]}";     //Převedení data z formátu YY-mm-dd na formát dd. mm. YY
            $file_id        = $resident->id;
            $file           = Storage::url("contract/{$file_id}.pdf");
            $rentcontracts  = DB::table('contracts')->where('type', '=', 'Nájemní')->get();
            $current_user   = DB::table('users')->where('id', '=', Auth::user()->id)->first();
            $rules          = Storage::exists("house_rules/{$building}.txt") ? Storage::get("house_rules/{$building}.txt") : "House rules empty. No rules. Anarchy!!!" ;
        }
                        
        $chats          = DB::table('chats')->orderBy('created_at', 'asc')->get();
        $communities    = DB::table('communities')->where('building_id', '=', $building)->get();
        $noticeboard    = DB::table('noticeboards')->where('building_id', '=', $building)->first();
        $notices        = DB::table('notices')->where('noticeboard_id', '=', $noticeboard->id)->get();
        $residents      = DB::table('residents')->where('building_id', '=', $building)->get();
        $users          = DB::table('users')->get();

        foreach ($residents as $resid) {
            $residents_in_flats[$resid->flat_id] = DB::table('users')->where('id', '=', $resid->user_id)->first();
        }

        $data = (object) [
            "profile" => $profil,
            "residents" => $residents,
            "owners" => $owners,
            "communities" => $communities,
            "chats" => $chats,
            "current_user" => $current_user,
            "this_building" => $this_building,
            "noticeboard" => $noticeboard,
            "notices" => $notices,  
            "rentcontracts" => $rentcontracts,
            "flats" => $flats,
            "contract" => $contract,
            "date" => $date,
            "contract_id" => $file_id,
            "contract_url" => $file,
            "residents_in_flat" => $residents_in_flats,
            "users"=>$users,
            "rules"=>$rules
        ];
        return response()->json($data, 200);
    }




    public function store (Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birth_date = $request->birth_date;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(action('HomeController@index'));
    }

    public function edit (Request $request ,$id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date, 
                'phone_number' => $request->phone_number, 
                'email' => $request->email, 
                'email' => $request->email]);
            return redirect(action('HomeController@index'));
    }

    public function destroy ($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();
            return redirect(action('HomeController@index'));
    }

    public function bedit ($id)
    {
            $flats          = DB::table('flats')->where('building_id', '=', $id)->get();
            $last_flat_number = DB::table('flats')->where('building_id', '=', $id)->orderBy("number", "desc")->value('number');
            $building  = DB::table('buildings')->where('id', '=', $id)->first();
            $residents      = DB::table('residents')->where('building_id', '=', $id)->get();
            $users          = DB::table('users')->get();
            $rentcontracts  = DB::table('contracts')->where('type', '=', 'Nájemní')->get();
            $profil = 'superuser';
            return view("auth/building", compact('flats', 'building', 'profil', 'last_flat_number', 'users', 'rentcontracts', 'residents'));
    }
}
