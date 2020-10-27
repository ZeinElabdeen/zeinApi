<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class locationModel extends Model
{
    //
    public static function allCountry()
    {
        return DB::select('SELECT * FROM institute_location ');
    }
    public static function cityOfCountry($id)
    {
        return DB::select('SELECT * FROM institutes_citites WHERE location_id = ?', [$id]);
    }
    public static function allcities()
    {
        return DB::select('SELECT * FROM institutes_citites ');
    }
    public static function countryID()
    {
        return DB::table('institute_location')->select('location_id')->pluck('location_id')->first();
        // return DB::select('SELECT location_id FROM institute_location');
    }
    public static function addCity($data)
    {
        return DB::insert('INSERT INTO institutes_citites (city_name, city_name_ar,location_id) values (?, ?, ?)', [$data->city_name,$data->city_name_ar,$data->location_id]);
    }
    public static function addCountry($data)
    {
        return DB::insert('INSERT INTO institute_location (country, country_ar) values (?, ?)', [$data->country,$data->country_ar]);
    }
    public static function showContry($id)
    {
        return DB::table('institute_location')->select('*')->where('location_id','=',$id)->first();
    }
    public static function updateCountry($data,$id)
    {
        return DB::update('UPDATE institute_location SET country = ? ,country_ar = ? WHERE location_id = ?', [$data->country,$data->country_ar,$id]);
    }
    public static function updateCity($data,$id)
    {
        return DB::update('UPDATE institutes_citites SET city_name = ? ,city_name_ar = ? WHERE city_id = ?', [$data->city_name,$data->city_name_ar,$id]);

    }
    public static function showCity($id)
    {
        return DB::table('institutes_citites')->select('*')->where('city_id','=',$id)->first();
    }

    public static function deleteCity($id)
    {
        return DB::delete('DELETE FROM institutes_citites WHERE city_id = ?', [$id]);
    }
    public static function deleteCountry($id)
    {
        return DB::delete('DELETE FROM institute_location WHERE location_id = ?', [$id]);
    }
    public static function deleteCityOfCountry($id)
    {
        return DB::delete('DELETE FROM institutes_citites WHERE location_id = ?', [$id]);
    }
}
