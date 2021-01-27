<?php
namespace pump\yii\rollbar\console;

/**
 * For sending console errors to Rollbar
 */
class ErrorHandler extends \yii\console\ErrorHandler
{
    use \pump\yii\rollbar\ErrorHandlerTrait;
}
