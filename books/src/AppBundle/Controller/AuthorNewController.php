<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Form\AuthorNew;

class AuthorNewController extends Controller
{
	/**
    * @Route("/authornew", name="authornew")
    */
    public function newAction(Request $request)
    {
    
     $form = $this->createForm(AuthorNew::class);
	 $form->handleRequest($request);

   if ($form->isSubmitted() && $form->isValid()) {
        $dt = $form->getData();
		$auth = new Author();
		$auth1 = $this->getDoctrine()->getRepository('AppBundle:Author')->findOneByName($dt['name']);
		
		 if(isset($auth1))
		 {
		 	 $this->addFlash('notice','Такой автор уже есть!');
		 
		 }
		 else
		 {
			$auth->setName($dt['name']);
			$em = $this->get('doctrine')->getManager();
	        $em->persist($auth);
	        $em->flush();
			
		 }
    }

        return $this->render('author/create.html.twig',  array(
        'form' => $form->createView(),
    ));
    }
}

