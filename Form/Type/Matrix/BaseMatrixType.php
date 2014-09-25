<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 24/09/14
 * Time: 3:41 PM
 */

namespace Multiverse\Components\MatrixBundle\Form\Type\Matrix;


use Symfony\Component\Form\AbstractType;

class BaseMatrixType extends AbstractType {

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
}