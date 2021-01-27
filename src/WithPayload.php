<?php
namespace pump\yii\rollbar;

interface WithPayload
{
    /**
     * @return array|null Payload data to be sent to Rollbar
     */
    public function rollbarPayload();
}
