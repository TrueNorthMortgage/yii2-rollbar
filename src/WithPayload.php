<?php
namespace pump\yii\rollbar;

/**
 * Interface for adding additional data to the rollbar report. Create an exception which implements this interface
 * ```
 * class SomeException extends \Exception implements \pump\yii\rollbar\WithPayload;
 * {
 *     public function rollbarPayload()
 *     {
 *         return ['foo' => 'bar'];
 *     }
 * }
 * ```
 */
interface WithPayload
{
    /**
     * @return array|null Payload data to be sent to Rollbar
     */
    public function rollbarPayload();
}
