<?php

namespace Lcn\WYSIHTML5Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WYSIHTML5Type extends AbstractType
{

    /**
     * @var array
     */
    protected $options;

    public function __construct(array $options) {
        $this->options = $options;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this->options['purifier_transformer']);
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'lcn_wysihtml5';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $options = array_merge($this->options, $options);

        $view->vars['commands'] = $options['commands'];
        $view->vars['i18n_domain'] = $options['i18n_domain'];
        $view->vars['controls_stylesheets'] = $options['controls_stylesheets'];
        $view->vars['content_stylesheets'] = $options['content_stylesheets'];
        $view->vars['parser_rules'] = $options['parser_rules'];
    }
}