<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muzaki;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\CreateMuzakiRequest;
use App\Http\Requests\UpdateMuzakiRequest;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

class MuzakiController extends Controller
{

    public function fetch()
    {
        // $limit = $request->input('limit', 10);

        $muzaki = DB::table('muzakis')->orderBy('nama', 'asc')->paginate();
    
        return ResponseFormatter::success($muzaki, 'Muzaki Found');
    }


 
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMuzakiRequest $request)
    {


        try {
            $muzaki = Muzaki::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'noTelp' => $request->noTelp,
                'npwp' => $request->npwp
            ]);
            
            if(!$muzaki)
            {
                throw new Exception('Muzaki not created');
            }
    
            return ResponseFormatter::success($muzaki, 'Muzaki successfully added');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMuzakiRequest $request, $id)
    {
        try {
            $muzaki = Muzaki::find($id);

            if(!$muzaki)
            {
                throw new Exception('Muzaki not created');
            }

            //update muzaki
            $muzaki->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'noTelp' => $request->noTelp,
                'npwp' => $request->npwp
            ]);

            return ResponseFormatter::success($muzaki, 'Muzaki updated');

        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //Get muzaki
            $muzaki = Muzaki::find($id);

            //check if muzaki exists
            if (!$muzaki) {
                throw new Exception('Muzaki not Found');
            }

            //Delete muzaki
            $muzaki->delete();

            return ResponseFormatter::success('Muzaki deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(),500);
        }
    }
}

