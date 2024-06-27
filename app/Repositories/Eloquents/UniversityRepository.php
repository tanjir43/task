<?php

namespace App\Repositories\Eloquents;

use App\Models\Country;
use App\Models\UnUniversity;
use App\Models\UnUniversityType;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UniversityRepository extends BaseRepository implements UniversityRepositoryInterface
{
    public function __construct(UnUniversity $model)
    {
        parent::__construct($model);
    }


    public function getIndex(): array
    {
        $data = [];
        $data['models'] = $this->all();
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $data['types'] = UnUniversityType::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $data['countries'] = array_map(function ($id, $name) {
            return (object) ['id' => $id, 'name' => $name];
        }, array_keys($countries), $countries);
        return $data;
    }


    public function create(array $payload): ? Model
    {
        DB::beginTransaction();

        try {
            $params = $this->formatParms($payload);

            $university = $this->model->create($params['university_params']);
            $university->universityDetails()->create($params['university_details_params']);
            $university->socialLinks()->create($params['social_links_params']);
            $university->seo()->create($params['university_seo_params']);
    
            return $university;

            DB::commit();
            return $university;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
        return $model->update($this->formatParms($payload, $modelId));
    }

    private function formatParms($payload, $modelId = null)
    {
        $university_params =  [
            'country_id'                    => arrayGetValue($payload, 'country_id'),
            'city_id'                       => arrayGetValue($payload, 'city_id'),
            'un_type_id'                    => arrayGetValue($payload, 'un_type_id'),
            'website'                       => arrayGetValue($payload, 'website'),
            'application_website'           => arrayGetValue($payload, 'application_website'),
            'maps'                          => arrayGetValue($payload, 'maps'),
            'name'                          => arrayGetValue($payload, 'name'),
            'slug'                          => arrayGetValue($payload, 'name'),
            'email'                         => arrayGetValue($payload, 'email'),
            'common_admission_email'        => arrayGetValue($payload, 'common_admission_email'),
            'phone'                         => arrayGetValue($payload, 'phone'),
            'alternative_phone'             => arrayGetValue($payload, 'alternative_phone'),
            'address'                       => arrayGetValue($payload, 'address'),
            'description'                   => arrayGetValue($payload, 'description'),
            'created_by'                    => auth()->id(),
        ];

        $university_details_params =[
            'un_university_id'              => $modelId,
            'founded'                       => arrayGetValue($payload, 'founded'),
            'qs_ranking'                    => arrayGetValue($payload, 'qs_ranking'),
            'the_world_ranking'             => arrayGetValue($payload, 'the_world_ranking'),
            'acceptance_rate'               => arrayGetValue($payload, 'acceptance_rate'),
            'student_count'                 => arrayGetValue($payload, 'student_count'),
            'staff_count'                   => arrayGetValue($payload, 'staff_count'),
            'alumni_count'                  => arrayGetValue($payload, 'alumni_count'),
            'international_students_count'  => arrayGetValue($payload, 'international_students_count'),
            'maps'                          => arrayGetValue($payload, 'maps'),
        ];


        $social_links_params = [
            'un_university_id'              => $modelId,
            'facebook'                      => arrayGetValue($payload, 'facebook'),
            'twitter'                       => arrayGetValue($payload, 'twitter'),
            'linkedin'                      => arrayGetValue($payload, 'linkedin'),
            'youtube'                       => arrayGetValue($payload, 'youtube'),
            'instagram'                     => arrayGetValue($payload, 'instagram'),
            'tiktok'                        => arrayGetValue($payload, 'tiktok'),
            'whatsapp'                      => arrayGetValue($payload, 'whatsapp'),
            'telegram'                      => arrayGetValue($payload, 'telegram'),
            'discord'                       => arrayGetValue($payload, 'discord'),
        ];

        $university_seo_params = [
            'un_university_id'              => $modelId,
            'title'                         => arrayGetValue($payload, 'title'),
            'keywords'                      => arrayGetValue($payload, 'keywords'),
            'author'                        => arrayGetValue($payload, 'author'),
            'canonical'                     => arrayGetValue($payload, 'canonical'),
            'robots'                        => arrayGetValue($payload, 'robots'),
            'description'                   => arrayGetValue($payload, 'seo_description'),
            'og_title'                      => arrayGetValue($payload, 'og_title'),
            'og_url'                        => arrayGetValue($payload, 'og_url'),
            'og_type'                       => arrayGetValue($payload, 'og_type'),
            'og_site_name'                  => arrayGetValue($payload, 'og_site_name'),
            'og_description'                => arrayGetValue($payload, 'og_description'),
            'twitter_card'                  => arrayGetValue($payload, 'twitter_card'),
            'twitter_site'                  => arrayGetValue($payload, 'twitter_site'),
            'twitter_creator'               => arrayGetValue($payload, 'twitter_creator'),
            'twitter_title'                 => arrayGetValue($payload, 'twitter_title'),
            'twitter_description'           => arrayGetValue($payload, 'twitter_description'),
            'linkedin_title'                => arrayGetValue($payload, 'linkedin_title'),
            'pinterest_title'               => arrayGetValue($payload, 'pinterest_title'),
            'linkedin_description'          => arrayGetValue($payload, 'linkedin_description'),
            'pinterest_description'         => arrayGetValue($payload, 'pinterest_description'),
        ];


        return [
            'university_params'         => $university_params,
            'university_details_params' => $university_details_params,
            'social_links_params'       => $social_links_params,
            'university_seo_params'     => $university_seo_params,
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
