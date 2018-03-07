<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Interfaces\EntityToArrayInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 * @ORM\Table(name="Session")
 */
class Session implements EntityToArrayInterface
{


    public function __construct()
    {
        $this->speakers = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }


    /**
     * Many Session have Many Speakers.
     * @ManyToMany(targetEntity="Speaker", fetch="EAGER")
     * @JoinTable(name="Session_Speaker",
     *      joinColumns={@JoinColumn(name="SessionId", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="SpeakerId", referencedColumnName="id")}
     *      )
     */
    private $speakers;




    /**
     * Many Session have Many Participants.
     * @ManyToMany(targetEntity="Participant")
     * @JoinTable(name="Session_Participant"),
     *      joinColumns={@JoinColumn(name="session_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="participant_id", referencedColumnName="id")}
     *      )
     */
    private $participants;




    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $ID;


    /**
     * @ORM\Column(type="string", name="Name")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="TimeOfEvent")
     */
    private $timeOfEvent;

    /**
     * @ORM\Column(type="text", name="Description")
     */
    private $description;


    public function getId()
    {
        return $this->ID;
    }

    /**
     * @return mixed
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTimeOfEvent()
    {
        return $this->timeOfEvent;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $speakers
     */
    public function setSpeakers($speakers)
    {
        $this->speakers = $speakers;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $timeOfEvent
     */
    public function setTimeOfEvent($timeOfEvent)
    {
        $this->timeOfEvent = $timeOfEvent;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function addParticipants($participants)
    {
        $this->participants[] = $participants;
    }







    public function getArrayForJson()
    {
        $speakers = $this->getSpeakers()
                         ->map(function($el){return $el->getArrayForJson();})
                         ->toArray();

        return [
            'id'            => $this->getId(),
            'Name'          => $this->getName(),
            'TimeOfEvent'   => $this->getTimeOfEvent(),
            'Description'   => $this->getDescription(),
            'Speakers'      => $speakers
        ];
    }
}