<?php

namespace Tao\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TaoBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
