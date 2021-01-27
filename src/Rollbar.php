<?php
namespace pump\yii\rollbar;

/**
 * Custom Component to init the \Rollbar\Rollbar class using configured settings in the Yii BaseObject($config) style
 */
class Rollbar extends \yii\base\BaseObject
{
    public $enabled = true;
    public $access_token;
    public $base_api_url = 'https://api.rollbar.com/api/1/';
    public $batch_size;
    public $batched;
    public $branch;
    public $code_version;
    public $environment;
    public $host;
    public $included_errno;
    public $logger;
    public $person_fn;
    public $root = '@app';
    public $scrub_fields = ['passwd', 'password', 'secret', 'auth_token', '_csrf'];
    public $timeout = 3;
    public $proxy;
    public $enable_utf8_sanitization = true;

    /**
     * @var array Exceptions to be ignored by yii2-rollbar
     * Format: ['name of the exception class', 'exception_property' => ['range', 'of', 'values], ...]
     */
    public $ignore_exceptions = [
        ['yii\web\HttpException', 'statusCode' => [404]],
    ];

    /**
     * Inits the \Rollbar\Rollbar static class
     * @return void
     */
    public function init(): void
    {
        \Rollbar\Rollbar::init([
            'enabled' => $this->enabled,
            'access_token' => $this->access_token,
            'base_api_url' => $this->base_api_url,
            'batch_size' => $this->batch_size,
            'batched' => $this->batched,
            'branch' => $this->branch,
            'code_version' => $this->code_version,
            'environment' => $this->environment,
            'host' => $this->host,
            'included_errno' => $this->included_errno,
            'logger' => $this->logger,
            'person_fn' => $this->person_fn,
            'root' => !empty($this->root) ? \Yii::getAlias($this->root) : null,
            'scrub_fields' => $this->scrub_fields,
            'timeout' => $this->timeout,
            'proxy' => $this->proxy,
            'enable_utf8_sanitization' => $this->enable_utf8_sanitization,
        ], false, false, false);
    }
}
