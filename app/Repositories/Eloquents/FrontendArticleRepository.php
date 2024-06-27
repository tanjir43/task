<?php

namespace App\Repositories\Eloquents;

use App\Models\Article;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\FrontendArticleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FrontendArticleRepository extends BaseRepository implements FrontendArticleRepositoryInterface
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    public function getIndex(): array
    {
        $data = [];
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $data['countries'] = array_map(function ($id, $name) {
            return (object) ['id' => $id, 'name' => $name];
        }, array_keys($countries), $countries);
        $data['models'] = $this->all();
        $cities = City::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $data['cities'] = array_map(function ($id, $name) {
            return (object) ['id' => $id, 'name' => $name];
        }, array_keys($cities), $cities);
        $data['models'] = $this->all();
        return $data;
    }

    public function create(array $payload): ? Model
    {
        DB::beginTransaction();

        try {
            $params = $this->formatParms($payload);
            $params['frontend_article_params']['created_by'] = auth()->id();

            $frontend_article = $this->model->create($params['frontend_article_params']);
            
            DB::commit();
            return $frontend_article;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function update(int $modelId, array $payload): bool
    {
        DB::beginTransaction();
    
        try {
            $model = $this->findById($modelId);
            if (!$model) {
                return false;
            }
    
            $params = $this->formatParms($payload, $modelId);
            $params['frontend_article_params']['updated_by'] = auth()->id();
            $params['frontend_article_params']['updated_at'] = now();
            
            $updated = $model->update($params['frontend_article_params']);
    
            if ($updated) {
                DB::commit();
                return true;
            } else {
                DB::rollBack();
                return false;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    

    private function formatParms($payload, $modelId = null)
    {
        $frontend_article_params =  [
            'country_id'                => arrayGetValue($payload, 'country_id'),
            'city_id'                   => arrayGetValue($payload, 'city_id'),
            'title'                     => arrayGetValue($payload, 'title'),
            'description'               => arrayGetValue($payload, 'description'),
            'status'                    => 'running',
            'created_by'                => auth()->id(),
        ];

        return [
            'frontend_article_params'         => $frontend_article_params,
        ];
    }

    public function getEditPreRequisite($modelId): array
    {
        $data = $this->getIndex();
        $data['model'] = $this->findById($modelId);

        return $data;
    }

    public function pluckAll($prepend = null, $is_required = null)
    {
        $is_required = $is_required ? ' *' : '';
        if ($prepend) {
            return $this->model->where('school_id', auth()->user()->school_id)
            ->pluck('name', 'id')
            ->prepend(__('university::un.select_faculty'). $is_required, '')
            ->toArray();
        }
        return $this->model->where('school_id', auth()->user()->school_id)->get();
    }

    public function pluckAllOptional(): array
    {
        return $this->all()
                ->pluck('name', 'id')
                ->prepend(__('university::un.select_faculty'), '')
                ->toArray();
    }
}
