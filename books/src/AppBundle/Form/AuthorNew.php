<?php
// src/AppBundle/Form/AuthorNew.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AuthorNew extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
	   $builder->add('name',TextType::class, array('label' => 'Полное имя ФИО'))->add('Сохранить', SubmitType::class);
    }
}