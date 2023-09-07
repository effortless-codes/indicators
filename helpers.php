<?php

use Illuminate\Foundation\Application;

if (!function_exists('sendIndicator')) {

    /**
     * Convert Array into Object in deep
     *
     * @param string $title
     * @param string $text
     * @param bool $isToast
     * @return \Illuminate\Contracts\Foundation\Application|Application|mixed
     */
    function sendIndicator(string $title, string $text, bool $isToast = false): mixed
    {
        $notify = app('notify');
        if (!is_null($title)) {
            return $notify->indicator(title: $title, text: $text, isToast: $isToast);
        }
        return $notify;
    }
}
