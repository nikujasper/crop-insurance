<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;


class anoController extends Controller
{
    //
    public function getcrop(Request $request)
    {

        $input = $request->all();
        $res = DB::table('crop')
            ->select('cname', 'cid')
            ->where('sid', $input['season'])->get();
        return response()->json($res);
    }

    public function getseason()
    {
        $res = DB::table('season')->get();
        return response()->json($res);
    }

    public function submitdetails(Request $request)
    {
        $message = '';

        if ($input = $request->all()) {

            $aadhar = DB::table('details')
                ->where('aadhar', $input['aadhar'])
                ->where('cid', $input['crop'])
                ->first();

            if (!$aadhar) {
                DB::table('details')->insert([
                    'sid' => $input['season'],
                    'cid' => $input['crop'],
                    'farmername' => $input['farmer'],
                    'aadhar' => $input['aadhar'],
                    'fathername' => $input['father'],
                    'address' => $input['address'],
                    'category' => $input['category'],
                ]);
                $message = "Insurence Done..!!";
            } else {
                $message = "Same Aadhaar will not be allowed for same crop.";
            }
        }

        $result = DB::table('details')
            ->join('season', 'details.sid', '=', 'season.sid')
            ->join('crop', 'details.cid', '=', 'crop.cid')
            ->select(
                'season.sname',
                'crop.cname',
                'details.fathername',
                'details.farmername',
                'details.aadhar',
                'details.address',
                'details.category'
            )->get();


        return view('index', ['message' => $message, 'result' => $result]);
    }
}
