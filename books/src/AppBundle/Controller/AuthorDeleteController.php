<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Form\AuthorNew;

class AuthorDeleteController extends Controller
{
	/**
    * @Route("/authordelete/{id}", name="authordelete")
    */
    public function newAction(Request $request, $id)
    {
	    $curauth = $this->getDoctrine()->getRepository('AppBundle:Author')->findOneById($id);
		$em = $this->get('doctrine')->getManager();
		$em->remove($curauth);
	 	$em->flush();
     	$this->addFlash('notice','Автор удален');
		return $this->redirect('/');
    }
}

