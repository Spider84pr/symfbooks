<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Book;
use AppBundle\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(Request $request)
    {
    	$em = $this->get('doctrine')->getManager();
		$repository = $em->getRepository('AppBundle:Book');
		$book = $repository->findAll();
		$arr=array();
		// Собироем данные для вывода ккниг
		foreach ($book as $value) {
 		
 			$auth=array();
			$arr[$value->getId()]['id']=$value->getId();
			$arr[$value->getId()]['name']=$value->getName();
			 foreach ($value->getAuthor() as $val1) {
			$arr[$value->getId()]['auth'][]=$val1->getName();
			}
			$arr[$value->getId()]['isbn']=$value->getIsbn();
			$arr[$value->getId()]['pages']=$value->getPages();
			$arr[$value->getId()]['year']=$value->getYear();
			$arr[$value->getId()]['pic']=$value->getPic();
		}
		$repository = $em->getRepository('AppBundle:Author');
		$auth = $repository->findAll();
		
		$arr2=array();
		// Собироем данные для вывода авторов
		foreach ($auth as $value) {
			$arr2[$value->getId()]['id']=$value->getId();
			$arr2[$value->getId()]['name']=$value->getName();
			}		


        //
        return $this->render('default/index.html.twig', array('book' => $arr, 'auth' => $arr2));
    }
}
