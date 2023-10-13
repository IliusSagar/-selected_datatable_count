<?php

namespace App\Http\Controllers;
use App\Models\YourModel;
// use DataTables;


use Illuminate\Http\Request;

class DataTableController extends Controller
{

    public function index()
    {
        $items = YourModel::all(); // Fetch all items from the database

        return view('items', compact('items'));
    }

    public function updateAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
    
        // Update the 'status' column of YourModel for selected IDs
        YourModel::whereIn('id', $ids)->update(['status' => $status]);
    
        return response()->json(["success" => "Employees have been updated!"]);
    }


    // public function index()
    // {
    //     return view('data-table');
    // }

    public function data(Request $request)
    {
        $query = YourModel::query();

        // Apply filters here
        if ($request->has('column1')) {
            $query->where('column1', $request->input('column1'));
        }
        if ($request->has('column2')) {
            $query->where('column2', $request->input('column2'));
        }

        return DataTables::of($query)->make(true);
    }


}
