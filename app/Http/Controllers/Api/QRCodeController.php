<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QRCodeController extends Controller
{
    static public function getQRCode()
    {
        // \QrCode::generate('Make me into a QrCode!', '../public/qrcodes/qrcode.svg');
        // return \QrCode::size(300)
        //              ->format('png')
        //              ->generate('A simple example of QR code');
    }
}
