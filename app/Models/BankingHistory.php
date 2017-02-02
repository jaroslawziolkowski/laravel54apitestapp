<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankingHistory extends Model
{
    protected $table = 'banking_history';
    public $timestamps = true;
    protected $fillable = ['user_id', 'type', 'amount', 'bonus_amount',
  'created_at', 'updated_at'];

  /*
  * Create new deposit in database
  */
  public static function createDeposit($data){

      try{

        // If any error wil throw all database operations will rollback
        $createData = \DB::transaction(function() use($data){
            $bonus = 0;
            $userInstance = User::findOrFail($data['user_id']);
            if($userInstance->deposit_period == 2){
              $bonus = ($bonus+$userInstance->bonus);
            }
            if($userInstance->deposit_period<3){
              $userInstance->deposit_period++;
            }else{
              $userInstance->deposit_period = 1;
            }
            $bonusAmount = round($data['amount']*$bonus,2);
            $createData = [
              'user_id' => $data['user_id'],
              'type' => $data['type'],
              'amount' => $data['amount']+$bonusAmount,
              'bonus_amount' => $bonusAmount
            ];
            $created = self::create($createData);

            if(!$created){
              throw new \Exception("Deposit has been not registered", 422);
            }

            $userInstance->balance = $userInstance->balance+$createData['amount'];

            $userInstance->bonus_balance = $userInstance->bonus_balance
            +$createData['bonus_amount'];

            $userInstanceSaved = $userInstance->save();

            if(!$userInstanceSaved){
              throw new \Exception("Deposit has been not registered", 422);
            }
            return $createData;
        });
        return $createData;

      }catch(\Exception $e){
        throw new \Exception($e->getMessage(), 422);
      }
  }

  /*
  * Create new withdraw in database
  */
  public static function createWithdraw($data){
    try{

      // If any error wil throw all database operations will rollback
      $createData = \DB::transaction(function() use($data){
          $bonus = 0;
          $userInstance = User::findOrFail($data['user_id']);

          if($data['amount'] > ($userInstance->balance - $userInstance->bonus_balance)){
            throw new \Exception("You can make only withdraw to "
            .($userInstance->balance-$userInstance->bonus_balance), 422);
          }

          $createData = [
            'user_id' => $data['user_id'],
            'type' => $data['type'],
            'amount' => $data['amount'],
            'bonus_amount' => 0
          ];
          $created = self::create($createData);

          if(!$created){
            throw new \Exception("Withdraw has been not registered", 422);
          }

          $userInstance->balance = $userInstance->balance-$createData['amount'];

          $userInstanceSaved = $userInstance->save();

          if(!$userInstanceSaved){
            throw new \Exception("Withdraw has been not registered", 422);
          }
          return $createData;
      });
      return $createData;

    }catch(\Exception $e){
      throw new \Exception($e->getMessage(), 422);
    }
  }

  /*
  * Get report from deposits and withdrawts
  * group by country and date
  */
  public static function report($data){
    try{
        // Start query builder
        $query =  \DB::table('banking_history')
        ->join('users','user_id','users.id');
        // String to use in subqueried. Define tables with aliases
        $fromSql = ' FROM `banking_history` as `bh` join `users` as `us`
        ON `bh`.`user_id` = `us`.`id` ';

        // init where array. it will use in subqueries as raw sql
        $arWhere = [
          '`us`.`country` = `users`.`country`'
        ];

        if(array_key_exists('from', $data) && array_key_exists('to', $data)){
          $query->whereRaw('DATE(banking_history.created_at)
          BETWEEN "'.$data['from'].'" AND "'.$data['to'].'"');

          // Add item to use in raw subqueries
          array_push($arWhere,'DATE(bh.created_at) BETWEEN "'.$data['from']
          .'" AND "'.$data['to'].'"');

        }elseif(array_key_exists('from', $data)){
          // Add item to use in raw subqueries
          array_push($arWhere,'DATE(bh.created_at) >= "'
          .$data['from'].'"');
          $query->whereRaw('DATE(banking_history.created_at) >= "'
          .$data['from'].'"');

        }elseif(array_key_exists('to',$data)){

          // Add item to use in raw subqueries
          array_push($arWhere,'DATE(bh.created_at) <= "'
          .$data['to'].'"');

          $query->whereRaw('DATE(banking_history.created_at) <= "'
          .$data['to'].'"');
        }

        if(array_key_exists('country',$data)){
          // Add item to use in raw subqueries
          array_push($arWhere,'country = "'.$data['country'].'"');

          $query->where('country','=', $data['country']);
        }

        if(array_key_exists('user_id',$data)){
          // Add item to use in raw subqueries
          array_push($arWhere,'user_id = '.$data['to']);

          $query->where('user_id','=', $data['user_id']);
        }
        $rawWhere = '';
        if(count($arWhere) > 0){
          $rawWhere = ' AND '.join(' AND ', $arWhere);
        }

        $query->distinct()->
        select(\DB::raw('DATE(banking_history.created_at) as created_at'),
        'users.country',
        \DB::raw('(count(distinct user_id)) as users_count'),
        \DB::raw('(SELECT count(`bh`.`id`) '.$fromSql.'
         WHERE type="deposit" '.$rawWhere.') as deposits'),
        \DB::raw('(SELECT count(`bh`.`id`)
         '.$fromSql.' WHERE type="withdraw" '.$rawWhere.') as withdraws'),
        \DB::raw('(SELECT sum(amount-bonus_amount)
        '.$fromSql.' WHERE type="deposit" '.$rawWhere.') as deposits_amount'),
        \DB::raw('(SELECT sum(amount)
        '.$fromSql.' WHERE type="withdraw" '.$rawWhere.') as withdraws_amount')
      );

        $query->groupBy(\DB::raw('DATE(banking_history.created_at)'));
        $query->groupBy('country');

        $result = $query->get();
        return $result->toArray();

    }catch(\Exception $e){
      throw new \Exception($e->getMessage(), 422);
    }
  }


}
