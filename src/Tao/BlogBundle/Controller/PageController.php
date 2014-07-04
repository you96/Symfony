<?php
/**
 * Created by PhpStorm.
 * User: jintao
 * Date: 23/06/2014
 * Time: 12:26
 */

namespace Tao\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tao\BlogBundle\Entity\Enquiry;
use Tao\BlogBundle\Form\EnquiryType;

class PageController extends Controller {
    public function indexAction()
    {
        $em = $this->getDoctrine()
                    ->getManager();
        $blogs = $em->getRepository('TaoBlogBundle:Blog')
                    ->getLastestBlogs();
        return $this->render('TaoBlogBundle:Page:index.html.twig', array(
            'blogs'     => $blogs
        ));
    }
    public function aboutAction()
    {
        return $this->render('TaoBlogBundle:Page:about.html.twig');
    }
    public function contactAction()
    {
        //return $this->render('TaoBlogBundle:Page:contact.html.twig');
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if($request->getMethod()=='POST'){
            $form->bind($request);
            if($form->isValid()){
                $message= \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from tao blog')
                    ->setFrom('q963052097@sina.com')
                    ->setTo('91474@supinfo.com')
                    ->setBody($this->renderView('TaoBlogBundle:Page:contactEmail.txt.twig', array('enquiry'=>$enquiry)));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                return $this->redirect($this->generateUrl('contact'));
            }
        }
        return $this->render('TaoBlogBundle:Page:contact.html.twig',array(
            'form'  =>  $form->createView()
        ));

    }
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $blog = $em->getRepository('TaoBlogBundle:Blog')->find($id);
        if(!$blog){
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        return $this->render('TaoBlogBundle:Page:show.html.twig',array(
            'blog'  => $blog,
        ));
    }
} 