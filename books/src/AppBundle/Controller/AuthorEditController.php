<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Form\AuthorNew;

class AuthorEditController extends Controller
{
	/**
    * @Route("/authoredit/{id}", name="authoredit")
    */
    public function newAction(Request $request, $id)
    {
	$curauth = $this->getDoctrine()->getRepository('AppBundle:Author')->findOneById($id);
     $form =  $this->createForm(AuthorNew::class, array('name' => $curauth->getName()));
	 $form->handleRequest($request);

   if ($form->isSubmitted() && $form->isValid()) {
        $dt = $form->getData();
	
		$auth1 = $this->getDoctrine()->getRepository('AppBundle:Author')->findOneByName($dt['name']);
		
		 if((isset($auth1))&&($auth1->getId()!=$id))
		 {
		 	 $this->addFlash('notice','Такой автор уже есть!');
		 
		 }
		 else
		 {
			$curauth->setName($dt['name']);
			$em = $this->get('doctrine')->getManager();
	        $em->persist($curauth);
	        $em->flush();
			
		 }
    }

        return $this->render('author/create.html.twig',  array(
        'form' => $form->createView(),
    ));
    }
}

