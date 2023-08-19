<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function expenseListDisplay(Request $request){
        $user_id = $request->header('id');

        $result = Expense::where('user_id', '=', $user_id)->get();

        return $result;
    }


    function expenseCreation(Request $request){
        try{
            $user_id = $request->header('id');

           $expense = Expense::create([
                'user_id'=>$user_id,
                'amount'=>$request->input('amount'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'category'=>$request->input('category')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Expense has been added successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Expense has not been added'
            ]);
        }
    }


    function expenseUpdating(Request $request){
        try{
            $user_id = $request->header('id');
            $expense_id = $request->input('id');

             Expense::where('id', '=', $expense_id)->where('user_id', '=', $user_id)
            ->update([
                'amount'=>$request->input('amount'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'category'=>$request->input('category')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Expense has been updated successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Expense has not been updated'
            ]);
        }
    }


    function expenseDeleting(Request $request){
        try{
            $user_id = $request->header('id');
            $expense_id = $request->input('id');

            Expense::where('id', '=', $expense_id)->where('user_id', '=', $user_id)->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'Expense has been deleted successfully'
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to delete the expense'
            ]);
        }
    }


    function expenseByIdShow(Request $request){
            $user_id = $request->header('id');
            $expense_id = $request->input('id');

            return Expense::where('id', '=', $expense_id)->where('user_id', '=', $user_id)->first();
    }













}
