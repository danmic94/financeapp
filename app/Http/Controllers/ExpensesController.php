<?php

namespace App\Http\Controllers;

use App\Expenses as ExpensesModel;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        return ExpensesModel::all();
    }

    public function show(Request $request,ExpensesModel $expense)
    {
        return $expense::find($request->get('id'));
    }

    public function create(Request $request)
    {
        $expense = ExpensesModel::create($request->all());

        return response()->json($expense,201);
    }

    public function update(Request $request, ExpensesModel $expense)
    {
        $expense->update($request->all());

        return response()->json($expense,200);
    }

    public function delete(ExpensesModel $expense)
    {
        $expense->delete();

        return response()->json(null,204);
    }
}
