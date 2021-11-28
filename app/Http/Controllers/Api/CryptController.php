<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\MCrypt;

class CryptController extends Controller
{
    /**
     * Encrypt array of strings
     */
    public function encrypt(Request $request)
    {
        $crypt = new MCrypt();
        $input = $request->all();
        $encryptions = [];
        foreach($input as $string)
        {
            $encrypted_string= $crypt->encrypt($string);
            $encryptions[$string]=$encrypted_string;
        }
        return response()->json([
            'message' =>'Strings encryted successfully',
            'data' => $encryptions,
        ]);
    }

    /**
     * Decrypt array of strings
     */
    public function decrypt(Request $request)
    {
        $crypt = new MCrypt();
        $input = $request->all();
        $decryptions = [];
        foreach($input as $string)
        {
            $decrypted_string= $crypt->decrypt($string);
            $decryptions[$string]=$decrypted_string;
        }
        return response()->json([
            'message' =>'Strings decryted successfully',
            'data' => $decryptions,
        ]);
    }

    

}
