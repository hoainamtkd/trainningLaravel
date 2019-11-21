<?php
namespace App\Http\Utils; 
class Response
{
    public static function success( $data = [], $msg = 'successfully')
    {
        return response()->json([
            'code' => 200,
            'msg' => $msg,
            'response' => $data, 
        ]);
    }

    public static function error($msg = 'error', $code = 500)
    {
        return response()->json([
            'code' => $code,
            'msg' => $msg
        ]);
    }

    public static function not_found($msg = 'not found')
    {
        return self::error($msg, 404);
    }

    public static function not_permission($msg = 'can not access')
    {
        return self::error($msg, 403);
    }

    public static function exists($msg = 'can not access')
    {
        return self::error($msg, 409);
    }
}