<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class SessionRepository extends EntityRepository
{


    public function findSessionWithParticipants($sessId)
    {
        return $this->createQueryBuilder('Session')
            ->leftJoin('Session.participants', 'participants')
            ->addSelect('participants')
            ->andWhere('Session.ID = :sessId')
            ->setParameter('sessId', $sessId)
            ->getQuery()
            ->getOneOrNullResult();
    }



    public function findSessionWithUser($sessId, $partId)
    {
        return $this->createQueryBuilder('Session')
            ->leftJoin('Session.participants', 'participants')
            ->addSelect('participants')
            ->andWhere('Session.ID = :sessId')
            ->andWhere('participants.ID = :partId')
            ->setParameter('sessId', $sessId)
            ->setParameter('partId', $partId)
            ->getQuery()
            ->execute();
    }

}