<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EventsImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    public function model(array $row)
    {
        return new Event([
            'title'         => $row['title'] ?? null,
            'for_whom'      => $row['for_whom'] ?? null,
            'description'   => $row['description'] ?? null,
            'location'      => $row['location'] ?? null,
            'from_date'     => $row['from_date'] ?? null,
            'to_date'       => $row['to_date'] ?? null,
            'is_specific'   => $row['is_specific'] ?? null,
            'country_id'    => $row['country_id'] ?? null,
            'city_id'       => $row['city_id'] ?? null,
            'created_by'    => 1, 
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
}
