<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Interfaces\EntityToArrayInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="News")
 */
class News implements EntityToArrayInterface
{



    /**
     * @return mixed
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @param mixed $speakers
     */
    public function setSpeakers($speakers)
    {
        $this->speakers = $speakers;
    }




    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $ID;

    /**
     * @ORM\Column(type="integer", name="ParticipantId")
     */
    private $participantId;

    /**
     * @ORM\Column(type="string", name="NewsTitle")
     */
    private $newsTitle;

    /**
     * @ORM\Column(type="string", name="NewsMessage")
     */
    private $newsMessage;

    /**
     * @ORM\Column(type="integer", name="LikesCounter")
     */
    private $likesCounter;


    public function getId()
    {
        return $this->ID;
    }


    /**
     * @return mixed
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * @param mixed $ParticipantId
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
    }

    /**
     * @return mixed
     */
    public function getNewsTitle()
    {
        return $this->newsTitle;
    }

    /**
     * @param mixed $NewsTitle
     */
    public function setNewsTitle($newsTitle)
    {
        $this->newsTitle = $newsTitle;
    }

    /**
     * @return mixed
     */
    public function getNewsMessage()
    {
        return $this->newsMessage;
    }

    /**
     * @param mixed $NewsMessage
     */
    public function setNewsMessage($newsMessage)
    {
        $this->newsMessage = $newsMessage;
    }

    /**
     * @return mixed
     */
    public function getLikesCounter()
    {
        return $this->likesCounter;
    }

    /**
     * @param mixed $LikesCounter
     */
    public function setLikesCounter($likesCounter)
    {
        $this->likesCounter = $likesCounter;
    }


    public function getArrayForJson(){
        return [
            'id'            => $this->getId(),
            'ParticipantId' => $this->getParticipantId(),
            'NewsTitle'     => $this->getNewsTitle(),
            'NewsMessage'   => $this->getNewsMessage(),
            'LikesCounter'  => $this->getLikesCounter()
        ];
    }



}