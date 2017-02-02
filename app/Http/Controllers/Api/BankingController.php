<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostDepositCreate;
use App\Http\Requests\PostWithdrawCreate;

class BankingController extends BaseController{

  /**
  * Create new money deoposit
  */
  public function postDeposit(PostDepositCreate $request)
  {
      try{
          return response()->json(\App\Models\BankingHistory
          ::createDeposit($request->json()->all()));
      }catch(\Exception $e){
        return response()->json($this->makeException($e));
      }
  }

  /**
  * Create new money withdraw
  */
  public function postWithdraw(PostWithdrawCreate $request)
  {
    try{
      return response()->json(\App\Models\BankingHistory
      ::createWithdraw($request->json()->all()));
    }catch(\Exception $e){
      return response()->json($this->makeException($e));
    }
  }
}
