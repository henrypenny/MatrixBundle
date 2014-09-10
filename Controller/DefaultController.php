<?php

namespace Multiverse\Components\MatrixBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $matrix = array('test' =>
            array(
                array('name' => 'joob', 'value' => new \DateTime(), 'extra' => 'xtr'),
                array('name' => 'joob', 'value' => new \DateTime(), 'extra' => 'xtr'),
                array('name' => 'joob', 'value' => new \DateTime(), 'extra' => 'xtr'),
                array('name' => 'joob', 'value' => new \DateTime(), 'extra' => 'xtr'),
                array('name' => 'joob', 'value' => new \DateTime(), 'extra' => 'xtr')
            )
        );
        $form = $this->createFormBuilder($matrix)
            ->add('test', 'matrix', array())
            ->add('save', 'submit', array('label' => 'Create Post'))
            ->getForm();
        $formView = $form->createView();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            echo '';
        }

        return $this->render('MultiverseComponentsMatrixBundle:Default:index.html.twig', array('form' => $formView));
    }

}
