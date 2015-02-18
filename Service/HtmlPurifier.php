<?php

namespace Lcn\WYSIHTML5Bundle\Service;

class HtmlPurifier
{

    /**
     * @var array
     */
    protected $options;

    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    public function purify($dirtyHtml, array $options = array()) {
        require_once __DIR__.'/../vendor/htmlpurifier/library/HTMLPurifier.auto.php';
        $options = array_merge($this->options, $options);

        $config = \HTMLPurifier_Config::createDefault();

        if (array_key_exists('config', $options) && is_array($options['config'])) {
            foreach ($options['config'] as $key => $value) {
                $config->set($key, $value);
            }
        }

        $htmlPurifier = new \HTMLPurifier($config);

        return $htmlPurifier->purify($dirtyHtml);
    }

}