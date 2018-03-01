<?php

namespace App\Http\Controllers;

use App\Expenses as ExpensesModel;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        return response(ExpensesModel::all(),200);
    }

    public function show(Request $request,ExpensesModel $expense)
    {
        $requestedExpense = $expense::find($request->get('id'));

        if (!isset($requestedExpense)){
            return response()->json("Resource does not exist 404!",404);
        }

        return response()->json($requestedExpense,200);
    }

    public function create(Request $request)
    {

        ExpensesModel::create($request->all());

        return response()->json("Resource created successfully 201",201);
    }

    public function update(Request $request, ExpensesModel $expense)
    {

        $entryId = $request->get('id');
        $requestedExpense = $expense::find($entryId);

        if (empty($requestedExpense)){
            return response()->json("Resource does not exist 404!",404);
        }

        $requestedExpense->update($request->all());

        return response()->json("The entry $entryId has been successfully updated!",200);
    }

    public function delete(Request $request,ExpensesModel $expense)
    {
        $requestedExpense = $expense::find($request->get('id'));

        if (empty($requestedExpense)){
            return response()->json("Resource does not exist 404!",404);
        }

        $requestedExpense->delete();
        return response()->json('',204);
    }

    public function weekly(ExpensesModel $expenses)
    {
        $sundayLastWeek = date("Y-m-d", strtotime("last sunday"));
        $mondayLastWeek = date("Y-m-d", strtotime("last week monday"));

        $lastWeekData = $expenses::where('date', '>=', $mondayLastWeek)
            ->where('date', '<=', $sundayLastWeek)
            ->get();

        if (isset($lastWeekData)) {
            return response()->json($lastWeekData,200);
        }

        return response()->json("Resource does not exist 404!",404);

    }
}
