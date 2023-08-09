<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {

        $userid = $request->header('user_id');

        $totalBalance = Income::where('user_id', $userid)->first()->income;

        return $totalBalance;
    }

    public function addBalance(Request $request)
    {
        $userid = $request->header('user_id');

        $addBalance = $request->input('balance');


        if (Income::where('user_id', $userid)->first()) {
            $prevBalance = Income::where('user_id', $userid)->first()->income;

            $newBalance = $addBalance + $prevBalance;

            Income::where('user_id', $userid)->update(['income' => $newBalance]);
            return redirect('/')->with(['msg' => 'Balance added']);
        } else {
            Income::create([
                'income' => $addBalance,
                'user_id' => $userid,
            ]);

            return redirect('/')->with(['msg' => 'Balance added']);
        }
    }
}
