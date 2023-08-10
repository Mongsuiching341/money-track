<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    public function addExpense(Request $request)
    {
        $userid = $request->header('user_id');


        DB::transaction(
            function () use ($userid, $request) {

                $expense = $request->input('expense');
                $category_id = $request->input('categories');

                $currentBlnc = Income::where('user_id', $userid)->first()->income;

                $newBlnc = $currentBlnc - $expense;

                Income::where('user_id', $userid)->update(['income' => $newBlnc]);

                Expense::create([
                    'expense' => $expense,
                    'user_id' => $userid,
                    'category_id' => $category_id
                ]);

                //  return Inertia('Home', ['msg' => 'Expense added']);

                return response()->json(['msg' => 'Expense added']);
                // return redirect('/')->with(['msg' => 'Expense added']);
            }
        );
    }


    public function expenseList(Request $request)
    {
        // sleep(2);
        $userid = $request->header('user_id');

        $expenseList = Expense::where('user_id', $userid)->with('category')->orderBy('expense', 'asc')->get();

        return response()->json(['expenseList' => $expenseList]);
    }
}
