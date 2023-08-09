<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $userid = $request->header('user_id');

        $totalBalance = Income::where('user_id', $userid)->first()->income;


        $expenses = Expense::where('user_id', $userid)->get();
        $totalExpense = 0;
        foreach ($expenses as $ex) {
            $totalExpense += $ex->expense;
        }

        //
        $categories = Category::all();




        return Inertia('Home', ['totalBalance' => $totalBalance, 'totalExpense' => $totalExpense, 'categories' => $categories]);
    }
}
