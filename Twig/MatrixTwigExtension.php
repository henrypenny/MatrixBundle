<?php
/**
 * Created by PhpStorm.
 * User: henrypenny
 * Date: 10/09/14
 * Time: 7:19 AM
 */

namespace Multiverse\Components\MatrixBundle\Twig;


use Doctrine\Common\Persistence\ObjectManager;

class MatrixTwigExtension extends \Twig_Extension {

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function getFunctions() {

        $functions = array();
        $functions['resolve_object'] = new \Twig_SimpleFunction('resolve_object', array($this, 'resolveObject'));
        return $functions;
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

    public function resolveObject($entityAry) {
        if($entityAry == null || !isset($entityAry['__matrix__class__']) || $entityAry['__matrix__class__'] == null || $entityAry['__matrix__class__'] == '') {
            return null;
        }
        $repo = $this->om->getRepository($entityAry['__matrix__class__']);
        $object = $repo->find($entityAry['id']);
        return $object;
    }
}