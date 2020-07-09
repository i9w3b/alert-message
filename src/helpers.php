<?php

if (! function_exists('toastr')) {
    function toastr($message = null, $title = null, $options = [])
    {

        $notifier = app('alert-message');

        if (!is_null($message)) {

            return $notifier->add('success', $message, $title, $options);
        }

        return $notifier;
    }
}
