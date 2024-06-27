<?php

namespace App\Repositories\Eloquents;

use App\Models\Country;
use App\Models\UnSubject;
use App\Models\UnUniversity;
use App\Models\UnUniversityType;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\UniversitySubjectRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UniversitySubjectRepository extends BaseRepository implements UniversitySubjectRepositoryInterface
{
    public function __construct(UnSubject $model)
    {
        parent::__construct($model);
    }

    public function getIndex(): array
    {
        $data = [];
        $data['models'] = $this->all();
        return $data;
    }

    public function create(array $payload): ? Model
    {
        DB::beginTransaction();

        try {
            $params = $this->formatParms($payload);
            $params['university_subject_params']['created_by'] = auth()->id();

            $university_subject = $this->model->create($params['university_subject_params']);
            
            DB::commit();
            return $university_subject;

            return $university_subject;
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
            $params['university_subject_params']['updated_by'] = auth()->id();
            $params['university_subject_params']['updated_at'] = now();
            
            $updated = $model->update($params['university_subject_params']);
    
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
        $university_subject_params =  [
            'name'                      => arrayGetValue($payload, 'name'),
            'name_l'                    => arrayGetValue($payload, 'name'),
            'code'                      => arrayGetValue($payload, 'code'),
            'status'                    => 'running',
            'created_by'                => auth()->id(),
        ];

        return [
            'university_subject_params'         => $university_subject_params,
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
