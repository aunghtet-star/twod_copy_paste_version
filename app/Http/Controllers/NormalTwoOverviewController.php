<?php

namespace App\Http\Controllers;

use App\Models\BrakeAmount;
use App\Models\NormalTwo;
use App\Models\NormalTwoOverview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NormalTwoOverviewController extends Controller
{
    public function overview(){
        $normal_two_sum = NormalTwo::select('two','amount','date')->where('date',now()->format('Y-m-d'))->get();

        $normal_two_overview = NormalTwo::select('two',DB::raw('SUM(amount) as total'))->groupBy('two')->orderBy('two','ASC')->get();

        $total = NormalTwo::select('amount')->sum('amount');

        $brake_amount = BrakeAmount::find(1)->amount;


        return response()->json([
            'two_overview' => $normal_two_overview,
            'total' => number_format($total),
            'brake_amount' => $brake_amount
        ],200);

    }

    public function clean(){
       DB::table('normal_twos')->truncate();

       return response()->json([
           'success' => 'clean successfully'
       ],200);
    }
}
