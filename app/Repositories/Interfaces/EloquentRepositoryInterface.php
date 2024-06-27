<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []) : Collection;

    public function count() : int;

    public function getByCondition(array $condition, array $relations = [], array $columns = ['*']) : Collection;

    public function findById( int $modelId, array $columns = ['*'], array $relations = [], array $appends = []) : ? Model;

    public function create(array $payload): ? Model;

    public function update(int $modelId, array $payload) : bool;

    public function deleteById(int $modelId) : bool;

    public function block(int $modelId) : bool;

    public function unblock(int $modelId) : bool;
}
