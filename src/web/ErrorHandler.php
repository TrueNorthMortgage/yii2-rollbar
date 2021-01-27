<?php
namespace pump\yii\rollbar\web;

/**
 * For sending web errors to Rollbar
 */
class ErrorHandler extends \yii\web\ErrorHandler
{
    use \pump\yii\rollbar\ErrorHandlerTrait;
}
