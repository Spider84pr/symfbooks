<?php
// src/AppBundle/Form/AuthorNew.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Book;

class BookNew extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	   $builder->add('name',TextType::class, array('label' => 'Название'))->add('author',EntityType::class, array(
        'label' => 'Автор',
    'class' => 'AppBundle:Author',
    'choice_label' => 'name',
    'multiple'  => 'true',
))->add('pages',IntegerType::class, array('label' => 'Кол-во страниц'))->add('year',IntegerType::class, array('label' => 'Год издания'))->add('isbn',TextType::class, array('label' => 'ISBN'))->add('pic',FileType::class, array('data_class' => null))->add('Сохранить', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Book::class,
        ));
    }
}