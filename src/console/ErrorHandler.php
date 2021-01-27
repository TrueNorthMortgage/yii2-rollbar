<?php
namespace pump\yii\rollbar\console;

use pump\yii\rollbar\ErrorHandlerTrait;

class ErrorHandler extends \yii\console\ErrorHandler
{
    use ErrorHandlerTrait;
}
