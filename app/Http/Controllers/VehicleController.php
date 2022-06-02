<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Official;
use App\Models\Resident;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function identify_plate(Request $request){
        date_default_timezone_set('America/Mexico_city');
        $date = Date("Y-m-d H:i:s");
        $hour = Date("H:i:s");

        $isOfficial = Official::where('plate', $request->plate)->first();
        $isResident = Resident::where('plate', $request->plate)->first();

        if ($isOfficial) {
            DB::table('record_official')->insert(
            ['id_official' => $isOfficial->id, 'in' => $hour, 'created_at' => $date]);
            return response()->json(['OK']);  
            
        }else if($isResident){
            $exist = DB::table('record_residents')
                ->where('id', '=', $isResident->id)
                ->get();
            if (count($exist) < 1) {
                DB::table('record_residents')->insert(
                    ['id_resident' => $isResident->id, 'time' => 0, 'in' => $hour, 'created_at' => $date]);
                return response()->json(['OK']);    
                
            }else{
                DB::table('record_residents')
                ->where('id_resident', $isResident->id)
                ->update(['in' => $hour]);
                return response()->json(['OK']);
            }    
        }else{
            Vehicle::create([
                'plate' => $request->plate,
                'checkin' => $hour,
                'created_at' => $date,
            ]);
            return response()->json(['OK']);
        }
    }

    public function checkout(Request $request){

        date_default_timezone_set('America/Mexico_city');
        $date = Date("Y-m-d H:i:s");
        $hour = Date("H:i:s");

        $isOfficial = Official::where('plate', $request->plate)->first();
        $isResident = Resident::where('plate', $request->plate)->first();

        if ($isOfficial) {
            $last = DB::table('record_official')
                ->where('id_official', '=', $isOfficial->id)
                ->orderByDesc('id')
                ->limit(1)
                ->get();
    
            DB::table('record_official')
                ->where('id', $last[0]->id)
                ->update(['out' => $hour]);
            return response()->json(['OK']);  
            
        }else if($isResident){
            $row =  DB::table('record_residents')
            ->where('id_resident', '=', $isResident->id)
            ->get();

            $start = strtotime($row[0]->in);
            $end = strtotime($hour);
            $minutes = round(abs($end - $start) / 60,0);
            $total_time = $row[0]->time + $minutes;

            DB::table('record_residents')
                ->where('id_resident', $isResident->id)
                ->update(['out' => $hour,
                          'time' => $total_time,                
            ]);

            return response()->json(['OK']);  
        }else{
            $row =  DB::table('vehicles')
            ->where('plate', '=', $request->plate)
            ->orderByDesc('id')
            ->limit(1)
            ->get();

            $start = strtotime($row[0]->checkin);
            $end = strtotime($hour);
            $minutes = round(abs($end - $start) / 60,0);
            $total_to_pay = $minutes * 0.5;

            DB::table('vehicles')
                ->where('id', $row[0]->id)
                ->update(['checkout' => $hour,
            ]);

            return response()->json([$total_to_pay]);
        }
    }

    public function reset_month(){
        DB::table('record_official')->delete();

        DB::table('record_residents')
                ->update(['time' => 0,
            ]);
        
        return response()->json(['OK']);      
    }
}
