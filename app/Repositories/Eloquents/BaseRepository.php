<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function count(): int
    {
        return $this->model->count();
    }
    
    public function getByCondition(array $condition, array $relations = [], array $columns = ['*']): Collection
    {
        return $this->model->where($condition)->with($relations)->get($columns);
    }

    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ? Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
    
    
        $payload['updated_by'] = auth()->user()->id; 
    
        $updated = $model->update($payload);
    
        return $updated;
    }

    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    public function block(int $modelId): bool
    {
        $model = $this->findById($modelId);

        if ($model) {
            $model->deleted_by = auth()->user()->id;
            $model->save();

            return $model->delete();
        }
        return false;
    }

    public function unblock(int $modelId): bool
    {
        $model = $this->model->withTrashed()->find($modelId);
    
        if ($model) {
            $user_id = auth()->user()->id;
            $model->updated_by = $user_id;
            $model->deleted_by = null;
    
            $model->save();
            
            return $model->restore();
        }
        return false;
    }
    
}
