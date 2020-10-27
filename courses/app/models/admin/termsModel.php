<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class termsModel extends Model
{
    public static function getAllTerms () 
    {
        return DB::table('terms_conditions')->select('*')->get();
    }

    public static function insertTerm($data)
    {
      return DB::table('terms_conditions')->insert($data);
  
    }
    
    public static function getTerm($term_id)
    {
        return DB::table('terms_conditions')->select('*')->where('term_id', '=', $term_id)->first();
    }
    
  
    public static function editTerm($term_id,$data)
    {
        return DB::table('terms_conditions')->where('term_id',$term_id)->update($data);
    }

    public static function deleteTerm($term_id)
    {
        return DB::table('terms_conditions')->where('term_id', '=', $term_id)->delete();
    }
}
