<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 9/09/14
 * Time: 5:41 PM
 */

namespace Multiverse\Components\MatrixBundle\Form\Type\Matrix;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatrixRowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(is_array($options['columns'])) {
            $columns = $options['columns'];
        }
        else if(is_object($options['columns']) && ($options['columns'] instanceof \Closure)) {
            $columns = $options['columns']();
        }
        else {
            $columns = array();
        }

        foreach($columns as $name => $column) {
            $builder->add($column['name'], $column['type'], $column['options']);
            if(isset($column['transformers'])) {
                foreach($column['transformers'] as $transformer) {
                    $builder->addModelTransformer($transformer);
                }
            }
        }
    }

    public function getName()
    {
        return 'matrix_row';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array('columns'));
    }
}
