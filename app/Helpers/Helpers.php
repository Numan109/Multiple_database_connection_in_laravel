<?php

/**
 * Predefined Messages
 */
define('FETCH_SUCCESS', 'Data retrieve successfully');
define('FETCH_FAIL', 'Opps! NO data available.');
define('VALIDATION_ERROR', 'Validation Error');
define('SUCCESS', 'Successfully created');
define('FAIL', 'Failed to create');
define('UPDATE_SUCCESS', 'Successfully updated');
define('UPDATE_FAIL', 'Failed to update');
define('SERVER_ERROR', 'Internal server error!');
define('DELETE_SUCCESS', 'Successfully deleted');
define('DELETE_FAIL', 'Failed to delete');
define('UNAUTHORIZED', 'These credentials do not match our records.');
define('PERMISSION_DENIED', 'Insufficient Permissions!');
define('PAGINATE_LIMIT', 10);

/**
 * common json response with datas
 */
if(!function_exists('respond')){
    function respond($data, $key = "data", $code = 200, $status = true)
    {
        return response()->json([
            'status' => $status,
            "{$key}" => $data,
        ], $code);
    }
}
/**
 * common json success response
 */
if(!function_exists('respondSuccess')){
    function respondSuccess($message, $data = [], $code = 200, $status = true)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }
}

/**
 * common json error response
 */

if(!function_exists('respondError')){
    function respondError($message, $messages = [], $code = 500, $status = false)
    {
        $response = [
            'status' => $status,
            'message' => $message
        ];
        !empty($messages) ? $response['errors'] = $messages : null;
        return response()->json($response, $code);
    }
}


if(!function_exists('getMonth')){
    function getMonth()
    {
        return $months = ['01'=>'January', '02'=>'February', '03'=>'March', '04'=>'April', '05'=>'May', '06'=>'June', '07'=>'July', '08'=>'August', '09'=>'September', '10'=>'October', '11'=>'November', '12'=>'December'];
    }
}



