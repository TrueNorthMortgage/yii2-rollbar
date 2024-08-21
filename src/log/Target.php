<?php
namespace truenorthmortgage\yii\rollbar\log;

use yii\log\Logger;

/**
 * Use to setup Rollbar as a yii log target
 */
class Target extends \yii\log\Target
{
    protected $request_id;

    /**
     * Generate a unique single request_id for all messages which may be sent by this one request
     */
    public function init()
    {
        // Create one request_id, so when we send multiple messages to Rollbar we can see the same request_id in the extra info
        // Maybe someday we can figure out how to group on this ID
        $this->request_id = uniqid();
        parent::init();
    }

    /**
     * Send each log message to Rollbar one at a time.
     * For each $message format, see https://www.yiiframework.com/doc/api/2.0/yii-log-logger#$messages-detail
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            $level_name = self::getLevelName($message[1]);

            \Rollbar\Rollbar::log($level_name, $message[0], [
                'category' => $message[2],
                'request_id' => $this->request_id
            ]);
        }
    }

    /**
     * Translate Yii Log Levels to acceptable Rollbar levels before sending
     * @param  int $level Logger::<level> sent by Yii - https://www.yiiframework.com/doc/api/2.0/yii-log-logger#$messages-detail
     * @return string  The text version of the error accepted by Rollbar: `error`, `warning`, `info`, `debug`
     */
    protected static function getLevelName($level): string
    {
        // Yii Logger levels to convert to the 'debug' level which Rollbar accepts
        $debug_levels = [Logger::LEVEL_PROFILE, Logger::LEVEL_PROFILE_BEGIN, Logger::LEVEL_PROFILE_END, Logger::LEVEL_TRACE];

        if (in_array($level, $debug_levels)) {
            return 'debug';
        }

        // will be `error`, `warning` or `info`
        return Logger::getLevelName($level);
    }
}
