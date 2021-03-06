<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 9/09/14
 * Time: 4:00 PM
 */

namespace Multiverse\Components\MatrixBundle\Form\Type\Matrix;

use Multiverse\Components\MatrixBundle\Form\DataTransformer\TestTransformer;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatrixType extends CollectionType {

    protected $cols = array();
    protected $_name = '';

    public function __construct(array $cols = array()) {
        $this->cols = $cols;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function addColumn($name, $type = null, array $options = array(), array $transformers = array()) {

        $col = array(
            'name' => $name,
            'type' => $type,
            'options' => $options,
            'transformers' => $transformers
        );

        $this->cols[$name] = $col;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $e) {
//            $input = $e->getData();
//
//            if (null === $input) {
//                $input = array();
//            }
//
//            $output = array();
//
//            if(is_array($input)) {
//                foreach ($input as $value) {
//                    if(is_array($value)) {
//                        $outputRow = array();
//
//                        foreach($value as $colName => $col) {
//                            $outputRow[$colName] = $value[$colName];
//                        }
//                        $output[] = $outputRow;
//                    }
//                }
//            }
//
//            $e->setData($output);
//        }, 1);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {

            $data = $event->getData();
            $_data = array();

            foreach($data as $datum) {
                $_data[$datum['__rowOrder']] = $datum;
                unset($_data[$datum['__rowOrder']]['__rowOrder']);
            }

            $event->setData($_data);
        });

        foreach($options['matrix_model_transformers'] as $transformer) {
            $builder->addModelTransformer($transformer);
        }
        foreach($options['matrix_view_transformers'] as $transformer) {
            $builder->addViewTransformer($transformer);
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options) {
        if(isset($options['columns'])) {
            $view->vars = array_merge($view->vars, array('columns' => $this->cols));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'type' => 'matrix_row',
            'allow_add' => true,
            'allow_delete' => true,
            'allowed_keys' => null,
            'use_container_object' => false,
            'columns' => function() {
                return $this->cols;
            },
            'options' => array('columns' => function() {
                return $this->cols;
            })
        ));

        $resolver->setRequired(array('columns'));
    }

    public function getParent()
    {
        return 'matrix';
    }

    public function getName()
    {
        return $this->_name;
    }
} 