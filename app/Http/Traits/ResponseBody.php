<?php

namespace App\Http\Traits;
/**
 * Трейт возвращающий структуру тела ответа
 *
 * @author REDHEAD_DEV => Kravchenko Dmitriy
 */
class ResponseBody
{

    /**
     * @param $data
     * @param bool $status
     * @param $message
     * @return mixed
     */
    public static function getBody($data, bool $status = true, $message = null): array
    {
        return [
            'success'   => $status,
            'message'   => $message,
            'data'      => $data
        ];
    }
}
