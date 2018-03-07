<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Interfaces\EntityToArrayInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="Participant")
 */
class Participant implements EntityToArrayInterface
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $ID;


    /**
     * @ORM\Column(type="string", name="Email")
     */
    private $email;


    /**
     * @ORM\Column(type="string", name="Name")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }






    public function getArrayForJson(){
        return [
            'id'            => $this->getId(),
            'Name'          => $this->getName(),
        ];
    }


}