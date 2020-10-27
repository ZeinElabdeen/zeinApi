<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class bankAccountModel extends Model
{
    //
    public static function allBankAcc()
    {
        return DB::select('SELECT * FROM bank_accounts ');
    }
    public static function deleteAcc($id)
    {
        return DB::delete('DELETE FROM bank_accounts WHERE account_id = ?', [$id]);
    }
    public static function addBankAcc($data)
    {
        return DB::insert('INSERT INTO bank_accounts (account_name, account_number,bank_name,statement) values (?, ?, ?, ?)',
         [$data['account_name'],$data['account_number'],$data['bank_name'],$data['statement']]);
    }
    public static function showAccount($id)
    {
        return DB::select('SELECT * FROM bank_accounts WHERE account_id = ?', [$id]);
    }
    public static function updateBankAcc($data,$id)
    {
        return DB::table('bank_accounts')->where('account_id',$id)->update($data);
    }
}
