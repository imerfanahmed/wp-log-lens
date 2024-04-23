<?php

namespace Imerfanahmed\WpLogLens;

final class WPLogLensClass{

    private function __construct() {
        $requestUri = $_SERVER['REQUEST_URI'];

        //reading logs file from wp-content
        $logs = fopen(ABSPATH . 'wp-content/debug.log', 'r');
        $logData = fread($logs, filesize(ABSPATH . 'wp-content/debug.log'));
        fclose($logs);


        if( $requestUri === '/logs' ) {
            ob_start();
            require_once __DIR__ . '/views/index.php';
            $content = ob_get_clean();
            var_dump($logData);
            die();
        }
    }

    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}
