<?php

namespace App\Http\Controllers;

use App\Models\BrakeAmount;
use Illuminate\Http\Request;

class BrakeAmountController extends Controller
{

    protected $model;

    public function __construct(BrakeAmount $model){
        return $this->model = $model;
    }

    public function index(){
        $brake_amount = $this->model::first();

        return response()->json([
            'brake_amount' => $brake_amount
        ]);
    }

    public function update(Request $request,$id){
        $this->model->find($id)->update([
            'amount' => $request->amount
        ]);

        return response()->json([
            'update' => 'successfully'
        ]);
    }
}
