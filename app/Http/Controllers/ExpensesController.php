<?php

namespace App\Http\Controllers;

use App\Expenses as ExpensesModel;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Returns all available expenses entries from the db
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response(ExpensesModel::all(),200);
    }

    /**
     * Return only one entry determined by the ID
     *
     * @param Request $request
     * @param ExpensesModel $expense
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request,ExpensesModel $expense)
    {
        $requestedExpense = $expense::find($request->get('id'));

        if (!isset($requestedExpense)){
            return response()->json("Resource does not exist 404!",404);
        }

        return response()->json($requestedExpense,200);
    }

    /**
     * Create a new entry using JSON standard structure
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        ExpensesModel::create($request->all());

        return response()->json("Resource created successfully 201",201);
    }

    /**
     * Updates a existing entry using the ID and standard JSON structure
     *
     * @param Request $request
     * @param ExpensesModel $expense
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Deletes a cost entry using the ID
     *
     * @param Request $request
     * @param ExpensesModel $expense
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,ExpensesModel $expense)
    {
        $requestedExpense = $expense::find($request->get('id'));

        if (empty($requestedExpense)){
            return response()->json("Resource does not exist 404!",404);
        }

        $requestedExpense->delete();
        return response()->json('',204);
    }

    /**
     * Returns the costs from the previous week
     *
     * @param ExpensesModel $expenses
     * @return \Illuminate\Http\JsonResponse
     */
    public function weekly(ExpensesModel $expenses)
    {
        $sundayLastWeek = date("Y-m-d", strtotime("last sunday"));
        $mondayLastWeek = date("Y-m-d", strtotime("last week monday"));

        $lastWeekData = $expenses::orderBy('date')
            ->where('date', '>=', $mondayLastWeek)
            ->where('date', '<=', $sundayLastWeek)
            ->get();

        $pluckedWeekData = $lastWeekData->pluck('date','cost')->all();
        $returnData = $this->mergeLastWeekCosts($pluckedWeekData);

        if (isset($lastWeekData)) {
            return response()->json($returnData,200);
        }

        return response()->json("Resource does not exist 404!",404);

    }

    /**
     * Totals each days costs eliminating multiple entries from the chart
     *
     * @param array $data
     * @return array
     */
    private function mergeLastWeekCosts(array $data)
    {
        $monday = 0;
        $tuesday = 0;
        $wednesday= 0;
        $thursday = 0;
        $friday = 0;
        $saturday = 0;
        $sunday = 0;

        foreach ($data as $cost => $day){
            $stringDay = date("l", strtotime($day));

            switch ($stringDay){
                case "Monday":
                    $monday += $cost;
                    break;
                case "Tuesday":
                    $tuesday += $cost;
                    break;
                case "Wednesday":
                    $wednesday += $cost;
                    break;
                case "Thursday":
                    $thursday += $cost;
                    break;
                case "Friday":
                    $friday += $cost;
                    break;
                case "Saturday":
                    $saturday += $cost;
                    break;
                case "Sunday":
                    $sunday += $cost;
                    break;
            }
        }

        return [
            'Monday' => $monday,
            'Tuesday' => $tuesday,
            'Wednesday' => $wednesday,
            'Thursday'=> $thursday,
            'Friday' => $friday,
            'Saturday' => $saturday,
            'Sunday' => $sunday
        ];

    }
}
