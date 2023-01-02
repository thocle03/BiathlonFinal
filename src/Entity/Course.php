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

    #[ORM\Column()]
    private string $classement1;

    #[ORM\Column()]
    private string $classement2;

    #[ORM\Column()]
    private string $classement3;

    #[ORM\Column()]
    private string $classement4;

    #[ORM\Column()]
    private string $classement5;

    #[ORM\Column()]
    private string $classement6;

    #[ORM\Column()]
    private string $classement7;

    #[ORM\Column()]
    private string $classement8;

    #[ORM\Column()]
    private string $classement9;

    #[ORM\Column()]
    private string $classement10;

    

    

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
    public function getClassement1()
    {
        return $this->classement1;
    }

    /**
     * Set the value of classement
     *
     * @return  self
     */
    public function setClassement1($classement1)
    {
        $this->classement1 = $classement1;

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

    /**
     * Get the value of classement2
     */ 
    public function getClassement2()
    {
        return $this->classement2;
    }

    /**
     * Set the value of classement2
     *
     * @return  self
     */ 
    public function setClassement2($classement2)
    {
        $this->classement2 = $classement2;

        return $this;
    }

    /**
     * Get the value of classement3
     */ 
    public function getClassement3()
    {
        return $this->classement3;
    }

    /**
     * Set the value of classement3
     *
     * @return  self
     */ 
    public function setClassement3($classement3)
    {
        $this->classement3 = $classement3;

        return $this;
    }

    /**
     * Get the value of classement4
     */ 
    public function getClassement4()
    {
        return $this->classement4;
    }

    /**
     * Set the value of classement4
     *
     * @return  self
     */ 
    public function setClassement4($classement4)
    {
        $this->classement4 = $classement4;

        return $this;
    }

    /**
     * Get the value of classement5
     */ 
    public function getClassement5()
    {
        return $this->classement5;
    }

    /**
     * Set the value of classement5
     *
     * @return  self
     */ 
    public function setClassement5($classement5)
    {
        $this->classement5 = $classement5;

        return $this;
    }

    /**
     * Get the value of classement6
     */ 
    public function getClassement6()
    {
        return $this->classement6;
    }

    /**
     * Set the value of classement6
     *
     * @return  self
     */ 
    public function setClassement6($classement6)
    {
        $this->classement6 = $classement6;

        return $this;
    }

    /**
     * Get the value of classement7
     */ 
    public function getClassement7()
    {
        return $this->classement7;
    }

    /**
     * Set the value of classement7
     *
     * @return  self
     */ 
    public function setClassement7($classement7)
    {
        $this->classement7 = $classement7;

        return $this;
    }

    /**
     * Get the value of classement8
     */ 
    public function getClassement8()
    {
        return $this->classement8;
    }

    /**
     * Set the value of classement8
     *
     * @return  self
     */ 
    public function setClassement8($classement8)
    {
        $this->classement8 = $classement8;

        return $this;
    }

    /**
     * Get the value of classement9
     */ 
    public function getClassement9()
    {
        return $this->classement9;
    }

    /**
     * Set the value of classement9
     *
     * @return  self
     */ 
    public function setClassement9($classement9)
    {
        $this->classement9 = $classement9;

        return $this;
    }

    /**
     * Get the value of classement10
     */ 
    public function getClassement10()
    {
        return $this->classement10;
    }

    /**
     * Set the value of classement10
     *
     * @return  self
     */ 
    public function setClassement10($classement10)
    {
        $this->classement10 = $classement10;

        return $this;
    }
}
