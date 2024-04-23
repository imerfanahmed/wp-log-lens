<?php

namespace Imerfanahmed\WpLogLens;

final class WPLogLensClass{

    private $patterns = [
        'logs' => '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?\].*/',
        'current_log' => [
            '/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?)\](?:.*?(\w+)\.|.*?)',
            ': (.*?)( in .*?:[0-9]+)?$/i'
        ],
        'files' => '/\{.*?\,.*?\}/i',
    ];
    private function __construct() {
        $requestUri = $_SERVER['REQUEST_URI'];

        //reading logs file from wp-content
        $logs = fopen(ABSPATH . 'wp-content/debug.log', 'r');
        $logData = fread($logs, filesize(ABSPATH . 'wp-content/debug.log'));
        fclose($logs);

        //match the logs data with patterns
        preg_match_all($this->patterns['logs'], $logData, $matches);
        ray($matches);


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
