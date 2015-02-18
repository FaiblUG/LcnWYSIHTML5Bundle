<?php

namespace Lcn\WYSIHTML5Bundle\Form\Transformer;

use Lcn\WYSIHTML5Bundle\Service\HtmlPurifier;
use Symfony\Component\Form\DataTransformerInterface;

class HtmlPurifierTransformer implements DataTransformerInterface
{
    protected $htmlPurifier;

    /**
     * Constructor.
     *
     * @param HtmlPurifier $htmlPurifier
     */
    public function __construct(HtmlPurifier $htmlPurifier)
    {
        $this->htmlPurifier = $htmlPurifier;
    }

    /**
     * @see Symfony\Component\Form\DataTransformerInterface::transform()
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @see Symfony\Component\Form\DataTransformerInterface::reverseTransform()
     */
    public function reverseTransform($value)
    {
        return $this->htmlPurifier->purify($value);
    }
}