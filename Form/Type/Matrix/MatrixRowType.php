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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatrixRowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach($options['columns'] as $name => $column) {
            $builder->add($column['name'], $column['type'], $column['options']);
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
