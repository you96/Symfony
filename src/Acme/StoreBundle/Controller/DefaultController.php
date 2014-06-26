<?php

namespace Acme\StoreBundle\Controller;

use Acme\StoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }
    public function createAction(){
        $product = new Product();
        $product->setName('baguette');
        $product->setPrice('0.99');
        $product->setDescription('da fa gun');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Create product id'.$product->getId());
    }
    public function showAction($id){
        $product = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Product')
            ->find($id);
        if(!$product){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
    }
}
