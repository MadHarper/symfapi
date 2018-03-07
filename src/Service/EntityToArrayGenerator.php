<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\News;
use App\Entity\Session;

class EntityToArrayGenerator
{

    private $em;

    private $legalEntity = [
        'News'      => News::class,
        'Session'   => Session::class
    ];


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function job($tableName, $id){

        if(!array_key_exists($tableName, $this->legalEntity)){
            return false;
        }

        if(!$id){
            return $this->getAll($tableName);
        }

        return $this->getOne($tableName, $id);

    }


    private function getAll($tableName)
    {
        $res = $this->em->getRepository($this->legalEntity[$tableName])->findAll();

        $arr = [];
        foreach ($res as $item){
            $arr[] = $item->getArrayForJson();
        }

        return $arr;
    }


    private function getOne($tableName, $id)
    {
        $res = $this->em->getRepository($this->legalEntity[$tableName])->find($id);
        if(!$res){
            return false;
        }

        return $res->getArrayForJson();
    }

}