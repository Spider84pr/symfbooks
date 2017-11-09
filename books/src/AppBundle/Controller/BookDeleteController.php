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

class BookDeleteController extends Controller
{
	/**
    * @Route("/bookdelete/{id}", name="bookdelete")
	 * Контроллер удаления книги
	 * Тут все просто  принимаем ИД и вызываем соответствующий меторм ORM
	 * после чего редиректим на главную с соответствующим сообщеиием
    */
    public function newAction(Request $request, $id)
    {
     $curbook = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneById($id);
	 $em = $this->get('doctrine')->getManager();
	 $em->remove($curbook);
	 $em->flush();
     $this->addFlash('notice','Книга удалена');
	return $this->redirect('/');
    }
}

