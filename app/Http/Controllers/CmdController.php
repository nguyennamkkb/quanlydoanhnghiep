<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CmdController extends Controller
{
    public static function GetIduser()
    {
        $date = new \DateTime();
        
        $iduser = md5(rand(10,99)."?@c" . $date->getTimestamp() . rand(10,99)."*!)");    

        return strtoupper($iduser);
    }
    public static function getCode()
    {
        $code = intval(rand(100000,999999));
        return $code;

    }
    public static function getDateTime()
    {
        $date = new \DateTime();
        $today = new \DateTime();
        $datetimeFormat = 'Y-m-d H:i:s';
        $date = $date->getTimestamp();
        $today->setTimestamp($date);
        $today = $today->format($datetimeFormat);


        return $today;
    }
}