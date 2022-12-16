<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table()]
class Course
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[Assert\NotBlank(message: "Le nom ne peut pas etre vidé")]
    #[Assert\Length(
        min: 3,
        max: 70,
        minMessage: "Le nom est trop court",
        maxMessage: "Le nom est trop long",
    )]
    #[ORM\Column()]
    private string $name;

    #[ORM\Column()]
    private string $image;

    #[ORM\Column()]
    private DateTime $createAt;

    #[ORM\OneToMany(targetEntity: "App\Entity\Comment", mappedBy: "course")]
    private $comments;

    #[ORM\OneToOne(targetEntity: "App\Entity\Classement", inversedBy: "course")]
    private Classement $classement;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of classement
     */
    public function getClassement()
    {
        return $this->classement;
    }

    /**
     * Set the value of classement
     *
     * @return  self
     */
    public function setClassement($classement)
    {
        $this->classement = $classement;

        return $this;
    }

    /**
     * Get the value of comments
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }
}
