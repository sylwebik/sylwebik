<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Column(type="string", length=4096)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $ects;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="courses_own")
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=96)
     */
    private $password;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="courses")
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="courses")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCourse", mappedBy="course")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getEcts()
    {
        return $this->ects;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setEcts($ects): void
    {
        $this->ects = $ects;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setPlainPassword($password): void
    {
        $this->plainPassword = $password;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }
}
