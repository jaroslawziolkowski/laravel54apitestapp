<?php
namespace App\Http\Controllers;

class BaseController extends Controller{

  public function makeException(\Exception $e){

    return [
      'success' => false,
      'error' => [
        'line' => $e->getLine(),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'message' => $e->getMessage()
      ]
    ];
  }

}
