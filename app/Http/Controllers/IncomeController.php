<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    function incomeListDisplay(Request $request){
        $user_id = $request->header('id');

       $result = Income::with('user')->where('user_id', '=', $user_id)->get();

       return $result;
    }


    function incomeCreation(Request $request){
        try{
            $user_id = $request->header('id');
        // Add the income
             Income::create([            
                'user_id'=>$user_id,
                'amount'=>$request->input('amount'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'category'=>$request->input('category')
                
            ]);
    
            return response()->json([
                'status' =>'success',
                'message' => 'New income has been added successfully'
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'An error ocurred while adding income'
            ], 401);
        }
    }

    
    function incomeUpdating(Request $request){
       try{
            $user_id = $request->header('id');
            $income_id = $request->input('id');

            $income = Income::where('id', '=', $income_id)->where('user_id', '=', $user_id)
            ->update([
                'amount'=>$request->input('amount'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'category'=>$request->input('category')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Income has been updated '
            ]);

       }
       catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Income has not been updated'
            ]);
       }
        
    }


    function incomeDeleting(Request $request){
        try{
            $user_id = $request->header('id');
            $income_id = $request->input('id');

            Income::where('id', '=', $income_id)->where('user_id', '=', $user_id)->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'The Income has been deleted'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail to delete the income'
            ]);
        }
    }


    function incomeByIdShow(Request $request){
            $user_id = $request->header('id');
            $income_id = $request->input('id');

            $result = Income::where('id', '=', $income_id)->where('user_id', '=', $user_id)->first();

            return $result;
    }




    




}
