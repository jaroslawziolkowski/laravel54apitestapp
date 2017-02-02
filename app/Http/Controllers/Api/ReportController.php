<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostReport;

class ReportController extends BaseController{

  /*
  * Get report based on parameters
  */
  public function postReport(PostReport $request){
    try{
      return response()->json(\App\Models\BankingHistory
      ::report($request->json()->all()));
    }catch(\Exception $e){
      return response()->json($this->makeException($e));
    }
  }
}
