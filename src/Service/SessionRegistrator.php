<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Session;
use App\Entity\Participant;

class SessionRegistrator
{

    const MAX_PARTICIPANTS = 50;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function job($sessionId, $userEmail)
    {
        // if user not found in Participant
        $participant = $this->em->getRepository(Participant::class)->findOneBy(['email' => $userEmail]);
        if(!$participant){
            return $this->setMessage("Error", [], "User not found");
        }

        // if session not found
        $sess = $this->em->getRepository(Session::class)->findSessionWithParticipants($sessionId);
        if(!$sess){
            return $this->setMessage("Error", [], "Session not found");
        }

        // if user are registered
        $partId = $participant->getId();
        $sessWithUser = $this->em->getRepository(Session::class)->findSessionWithUser($sessionId, $partId);
        if($sessWithUser){
            return $this->setMessage("Error", [], "You are already registered");
        }

        // if all the spots are filled
        $count = $sess->getParticipants()->count();
        if($count >= self::MAX_PARTICIPANTS){
            return $this->setMessage("Error", [], "Sorry, all the spots are filled");
        }


        // Register user
        $sess->addParticipants($participant);
        $this->em->persist($sess);
        $this->em->flush();

        return $this->setMessage("Ok", [], "You are registered!");

    }


    private function setMessage($status, $payload, $message)
    {
        return ([
            "status"    => $status,
            "payload"   => $payload,
            "message"   => $message
        ]);
    }

}