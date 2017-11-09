<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
    	$s='';
    	$nm=explode(' ', $this->name);
        $s=$nm[0];
        if (isset($nm[1])) $s.=' '.mb_substr($nm[1],0,1,'UTF-8').'. ';
		if (isset($nm[2])) $s.=mb_substr($nm[2],0,1,'UTF-8').'.';
		
        
        return $s;
    }
}

