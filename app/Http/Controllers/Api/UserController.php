<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostUserCreate;
use App\Http\Requests\PutUserEdit;

class UserController extends Basecontroller{

  /*
  * Create new user in DB
  */
  public function postCreate(PostUserCreate $request)
  {
    try{
      // Generate random bonus between 5 and 20%
      $bonus = rand(5,20)/100;
      // Merge data sent by user with default data for account.
      // Of course possible is also this default data set as DB
      // default values

      $data = array_merge($request->json()->all(),
      ['bonus' => $bonus, 'deposit_period' => 0, 'balance' => 0,
      'bonus_balance' => 0]);

      $userInstance = \App\Models\User::create($data);

      if($userInstance->id > 0){
        return response()->json($userInstance->toArray());
      }else{
        throw new \Exception("User has been not created.", 422);
      }
    }catch(\Exception $e){
      return response()->json($this->makeException($e));
    }
  }


/*
* Update user data. Update only data what exists.
*/
public function putEdit(PutUserEdit $request)
{
  try{
      // Update data
      $userInstance = \App\Models\User::where('id','='
      ,$request->input('id'))
      ->update(array_filter(
          // Get only inputs from list
          $request->only(['email','first_name','last_name','email'
          ,'country','gender','bonus']),
          // return only array element where value isn't null
          function($value){
            if(!is_null($value)){
              return $value;
            }
          }
      ));

      return response()->json($userInstance);
  }catch(\Exception $e){
    return response()->json($this->makeException($e));
  }
}

}
