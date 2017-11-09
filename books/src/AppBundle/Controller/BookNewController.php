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

class BookNewController extends Controller
{
	/**
    * @Route("/booknew", name="booknew")
    * Контроллер создания новой книги
	 * Проверяем наличие книги по условиям ТЗ и если такой книги нет собираем данные с форм и сохраняем в базу
	 * , после чего редиректим на главную с соответствующим сообщеиием
	 * upd,
	 * Последним пунктом на доделку оставил ззаливку обложки и ожидаемо засел на этом.
	 * Но за 2 дня  ууудалось разобраться что там в кормне иной подход к сбору даанныых с форм
	 *   этой строко	
	 * $form = $this->createForm(BookNew::class, $book);
	 * свяязываем форму и переееменную, после ччего нам не нужно сссобирать данные с формы , достаточно лишь сделать сохранение
	 * 	        $em->persist($book);
	 *       $em->flush();
	 * Старыв код оставил закооментированным
	 * */
    public function newAction(Request $request)
    {
    $book = new Book();
     $form = $this->createForm(BookNew::class, $book);
	 $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid()) {
		$name = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneByName($book->getName());
		$isbn = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneByIsbn($book->getIsbn());
		// проверяем на наличией такой книги  в каталоге
		if (isset($name))
		{
			if($book->getName()==$name->getYear())  // Если в базе нашлась книга с таким же названием и годоом издзания
			{
				 $this->addFlash('notice','Такая книга уже есть!'); 
			}
		}
		 if(isset($isbn)) // если в базе нашлась книга с таким же ISBN
		 {
		 	 $this->addFlash('notice','Такая книга уже есть!');
		 }
		 else
		 {
		 	// Устарело - проверка показала что такой книги нет - собираем данные с формы и заносим в БД
			/*$book->setName($dt['name']);
			$book->setYear($dt['year']);
			$book->setPages($dt['pages']);
			$book->setIsbn($dt['isbn']);
			$book->setAuthor($dt['author']);*/
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
		    $file = $book->getPic();
		    $fileName = md5(uniqid()).'.jpg';
            $file->move($this->getParameter('upld'), $fileName);
            $book->setPic($fileName);
			$em = $this->get('doctrine')->getManager();
	        $em->persist($book);
	        $em->flush();
			$this->addFlash('notice','Книга добавлена');
			return $this->redirect('/');
		 }
    }
        return $this->render('book/create.html.twig',  array(
        'form' => $form->createView(),
    ));
    }
}

