<?php
/**
 * Created by PhpStorm.
 * User: jintao
 * Date: 18/06/2014
 * Time: 11:46
 */

namespace Acme\HelloBundle\Controller;
//use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller {
    public function indexAction($name){
        //return new Response('<html><body>Hello '.$name.'</body></html>');
        return $this->render(
            'AcmeHelloBundle:Hello:index.html.twig',
            array('name'=>$name)
        );
    }

} 