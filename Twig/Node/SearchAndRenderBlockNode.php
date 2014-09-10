<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 10/09/14
 * Time: 10:27 AM
 */

namespace Multiverse\Components\MatrixBundle\Twig\Node;


class SearchAndRenderBlockNode extends \Twig_Node_Expression_Function {
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        $compiler->raw('$this->env->getExtension(\'form\')->renderer->searchAndRenderBlock(');

       //preg_match('/_([^_]+)$/', $this->getAttribute('name'), $matches);

        $label = null;
        $arguments = iterator_to_array($this->getNode('arguments'));
        //$blockNameSuffix = $matches[1];

        if (isset($arguments[0])) {
            $compiler->subcompile($arguments[0]);
            $compiler->raw(', \''. $this->getAttribute('name') .'\'');

            if (isset($arguments[1])) {
                $compiler->raw(', ');

                if (null !== $arguments[1]) {
                    $compiler->subcompile($arguments[1]);
                }
            }
        }

        $compiler->raw(")");
    }
}
