<?php


namespace App\Helpers;

use Illuminate\Http\Request;

/**
 *
 */
trait MyUtils
{
    public function commonData($request )
    {
        return [
            'user_ip' => $request->N_USER_IP,
            'user_agent' => $request->N_USER_AGENT,
            'session_id' =>  $request->N_USER_SESSION,
            'user_id' =>  $request->N_USER_ID,
        ];
    }
}
