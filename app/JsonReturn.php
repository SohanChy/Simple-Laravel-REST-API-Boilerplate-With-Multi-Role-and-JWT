<?php

namespace App;

class JsonReturn
{
    /**
     * @param $message
     * @param $success
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successMessage($message)
    {
        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = "Sorry, the request was not successfull", $statusCode = 500)
    {
        return response()->json(['success' => false, 'error' => $message], $statusCode);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notFoundError($id = "the item")
    {
        return response()->json(['success' => false, 'error' => "Sorry, {$id} was not found"], 404);
    }


    /**
     * @param $thing
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($thing = [])
    {
        $thing = self::arrayFication($thing);

        $thing['success'] = true;
        return response()->json($thing);
    }

    private static function arrayFication($data)
    {
        if (is_callable([$data, 'toArray'])) {
            $data = $data->toArray();
        } else {
            $data = (array)$data;
        }

        return $data;
    }

    public static function successData($data = [])
    {
        $data = self::arrayFication($data);

        $thing['success'] = true;
        $thing['data'] = $data;

        return response()->json($thing);
    }

}
