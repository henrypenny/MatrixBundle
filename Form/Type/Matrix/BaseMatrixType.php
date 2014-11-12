<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 24/09/14
 * Time: 3:41 PM
 */

namespace Multiverse\Components\MatrixBundle\Form\Type\Matrix;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BaseMatrixType extends AbstractType {

    protected $modelTransformer;
    protected $viewTransformer;

    public function __construct($modelTransformer, $viewTransformer) {
        $this->modelTransformer = $modelTransformer;
        $this->viewTransformer = $viewTransformer;
    }

    public function getParent() {
        return 'collection';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'matrix';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'matrix_model_transformers' => array($this->modelTransformer),
            'matrix_view_transformers' => array($this->viewTransformer)
        ));
    }
}