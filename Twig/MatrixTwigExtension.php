<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 10/09/14
 * Time: 7:19 AM
 */

namespace Multiverse\Components\MatrixBundle\Twig;


class MatrixTwigExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('matrix_widget_tuple', null, array('node_class' => 'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', 'is_safe' => array('html'))),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'matrix_extension';
    }
}