<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 9/09/14
 * Time: 4:00 PM
 */

namespace Multiverse\Components\MatrixBundle\Form\Type\Matrix;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatrixType extends CollectionType {

    protected $cols = array();
    protected $_name = '';

    public function setName($name) {
        $this->_name = $name;
    }

    public function addColumn($name, $type = null, array $options = array()) {

        $col = array(
            'name' => $name,
            'type' => $type,
            'options' => $options
        );

        $this->cols[$name] = $col;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $e) {
            $input = $e->getData();

            if (null === $input) {
                $input = array();
            }

            $output = array();

            foreach ($input as $value) {
                $outputRow = array();
                foreach($value as $colName => $col) {
                    $outputRow[$colName] = $value[$colName];
                }
                $output[] = $outputRow;
            }

            $e->setData($output);
        }, 1);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'type' => 'matrix_row',
            'value_type' => 'matrix_row',
            'allow_add' => true,
            'allow_delete' => true,
            'allowed_keys' => null,
            'use_container_object' => false,
            'options' => array('columns' => $this->cols)
        ));
    }

    public function getParent()
    {
        return 'collection';
    }

    public function getName()
    {
        return $this->_name;
    }
} 