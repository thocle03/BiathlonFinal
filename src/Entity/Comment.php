<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity()]
#[ORM\Table(name: "comment")]
class Comment
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[Assert\NotBlank(message: "Le nom ne peut pas etre vidé")]
    #[Assert\Length(
        min: 5,
        max: 70,
        minMessage: "Le nom est trop court",
        maxMessage: "Le nom est trop long",
    )]

    #[ORM\Column()]
    private string $content;
    #[ORM\Column()]
    private string $name;

    #[ORM\Column()]
    private DateTime $createAt;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Course", inversedBy: "comments")]
    private $course;


    public function __construct()
    {
        $this->setCreateAt(new \DateTime("now"));
    }
    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of createAt
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set the value of createAt
     *
     * @return  self
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }


    /**
     * Get the value of position
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of course
     */ 
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set the value of course
     *
     * @return  self
     */ 
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
