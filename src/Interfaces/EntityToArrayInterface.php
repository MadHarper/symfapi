<?php

namespace App\Interfaces;

interface EntityToArrayInterface
{
    /**
     * Returns the array of attribute => value of the Entity.
     *
     * @return array
     */
    public function getArrayForJson();


}
