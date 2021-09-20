<?php
namespace App\Traits;
use Crypt;

trait Encryptable
{
     public static function c_encode($string=''){
        $encrypted = Crypt::encryptString($string);
        return $encrypted;
     }

     public static function c_decode($string=''){
        try{
        $decrypted = $string;
        $decrypted = Crypt::decryptString($string);
        }catch(Exception $ex){

        }finally{
            return $decrypted;
        }
        return $decrypted;
     }
}