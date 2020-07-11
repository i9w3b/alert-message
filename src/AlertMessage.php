<?php

namespace I9w3b\AlertMessage;

use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class AlertMessage
{
    /**
     * Added notifications
     *
     * @var array
     */
    protected $notifications = [];

    /**
     * Illuminate Session
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * Toastr config
     *
     * @var Illuminate\Config\Repository
     */
    protected $config;

    public function __construct(SessionManager $session, Repository $config) {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * Renderizar tag blade.
     *
     * @return string
     */
    public function bladeRender()
    {
        return view('alertmessage::messages');
    }

    public function alertConfig($config)
    {
        return config('alertmessage.' . $config);
    }

    public function info($message, $title = null, $options = []) {
        $this->add('info', $message, $title, $options);
    }

    public function warning($message, $title = null, $options = []) {
        $this->add('warning', $message, $title, $options);
    }

    public function success($message, $title = null, $options = []) {
        $this->add('success', $message, $title, $options);
    }

    public function error($message, $title = null, $options = []) {
        $this->add('error', $message, $title, $options);
    }

    /**
     * Add a notification
     *
     * @param string $type Could be error, info, success, or warning.
     * @param string $message The notification's message
     * @param string $title The notification's title
     *
     * @return bool Returns whether the notification was successfully added or
     * not.
     */
    public function add($type, $message, $title = null,$options = []) {

        $allowedTypes = ['error', 'info', 'success', 'warning'];
        if(!in_array($type, $allowedTypes)) return false;

        $this->notifications[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'options' => $options
        ];

        $this->session->flash('toastr::notifications', $this->notifications);
    }

    public function render() {

        $notifications = $this->session->get('toastr::notifications');

        if(empty($notifications)){
            return;
        }

        if(!$notifications) $notifications = [];

        $output = '<script type="text/javascript">';
        $lastConfig = [];
        foreach($notifications as $notification) {

            $config = $this->config->get('alertmessage.options');
            if(empty($config)){
                $config = [];
            }

            if(count($notification['options']) > 0) {
                // Merge user supplied options with default options
                $config = array_merge($config, $notification['options']);
            }

            // Config persists between toasts
            if($config != $lastConfig) {
                $output .= 'toastr.options = ' . json_encode($config) . ';';
                $lastConfig = $config;
            }

            // Toastr output
            $output .= 'toastr.' . $notification['type'] . "('" .  str_replace("'", "\\'", $notification['message']). "'" . (isset($notification['title']) ? ", '" . str_replace("'", "\\'", htmlentities($notification['title'])) . "'" : null) . ');';
        }

        $output .= '</script>';

        return $output;
    }

    public function jquery($src = null)
    {
        if(null === $src || $src === "") {
            $src = config('alertmessage.jquery_link');
        }
        return '<script type="text/javascript" src="'.$src.'"></script>';
    }

    public function toastrCss($href = null)
    {
        if(null === $href || $href === "") {
            $href = config('alertmessage.toastr_csslink');
        }
        return '<link rel="stylesheet" type="text/css" href="'.$href.'">';
    }

    public function toastrJs($src = null)
    {
        if(null === $src || $src === "") {
            $src = config('alertmessage.toastr_jslink');
        }
        return '<script type="text/javascript" src="'.$src.'"></script>';
    }

    /**
     * Clear all notifications
     */
    public function clear() {
        $this->notifications = [];
    }
}

