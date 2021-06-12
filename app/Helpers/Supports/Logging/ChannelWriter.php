<?php

namespace App\Helpers\Supports\Logging;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Monolog\Logger;


class ChannelWriter
{
    /**
     * The Log channels.
     *
     * @var array
     */
    protected $channels = [
        'debug' => [
            'path' => 'debug.log',
            'level' => Logger::INFO
        ],
        'info' => [
            'path' => 'info.log',
            'level' => Logger::INFO
        ],
        'error' => [
            'path' => 'error.log',
            'level' => Logger::INFO
        ],
        'warning' => [
            'path' => 'warning.log',
            'level' => Logger::INFO
        ],
    ];

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct() {}

    /**
     * Write to log based on the given channel and log level set
     *
     * @param type $channel
     * @param type $message
     * @param array $context
     * @throws InvalidArgumentException
     */
    public function writeLog($channel, $level, $message, array $context = [])
    {
        //check channel exist
        if( !in_array($channel, array_keys($this->channels)) ){
            throw new InvalidArgumentException('Invalid channel used.');
        }

        $path = 'logs/backend/' . date('Y-m-d');
        $path = storage_path($path, '/');

        if(!file_exists($path)) {
            // path does not exist
            mkdir($path, 0777, true);
        }

        //lazy load logger
        if( !isset($this->channels[$channel]['_instance']) ){
            //create instance
            $this->channels[$channel]['_instance'] = new Logger($channel);
            //add custom handler
            $this->channels[$channel]['_instance']->pushHandler(
                new ChannelStreamHandler(
                    $channel,
                    $path . '/' . $this->channels[$channel]['path'],
                    $this->channels[$channel]['level']
                )
            );
        }

        //write out record
        $this->channels[$channel]['_instance']->{$level}($message, $context);
    }

    public function write($channel, $message, array $context = []){
        //get method name for the associated level
        $level = array_flip( $this->levels )[$this->channels[$channel]['level']];
        //write to log
        $this->writeLog($channel, $level, $message, $context);
    }

    //alert('event','Message');
    function __call($func, $params){
        if(in_array($func, array_keys($this->levels))){
            return $this->writeLog($params[0], $func, $params[1]);
        }
    }
}