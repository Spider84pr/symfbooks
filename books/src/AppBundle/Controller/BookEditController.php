<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Form\BookNew;

class BookEditController extends Controller
{
	/**
    * @Route("/bookedit/{id}", name="bookedit")
	 * Контроллер редактирования.
	 * принимаеам параметр ИД книги -  и выводим ее данныев
	 * после чего сохраняем изменения внесенные польлзователем.
    */
    public function newAction(Request $request, $id)
    {
     $curbook = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneById($id);
     $form =  $this->createForm(BookNew::class, $curbook);
   $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid()) {
      /*  $dt = $form->getData();
		$book = new Book();

			$book->setName($dt['name']);
			$book->setYear($dt['year']);
			$book->setPages($dt['pages']);
			$book->setIsbn($dt['isbn']);
			$book->setAuthor($dt['author']);
			$book->setPic("test");*/

			$em = $this->get('doctrine')->getManager();
	        $em->persist($curbook);
	        $em->flush();
			$this->addFlash('notice','Книга отредактироваа');
			return $this->redirect('/');
			
    }

        return $this->render('book/create.html.twig',  array(
        'form' => $form->createView(),
    ));
    }
}

