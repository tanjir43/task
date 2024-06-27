<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\EloquentRepositoryInterface;

interface UniversityRepositoryInterface extends EloquentRepositoryInterface
{
    public function getIndex() : array;
    public function getEditPreRequisite($modelId) : array;
    public function pluckAll();

}
