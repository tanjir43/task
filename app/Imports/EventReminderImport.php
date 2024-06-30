<?php

namespace App\Imports;

use App\Models\EventReminder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EventReminderImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    public function model(array $row)
    {
        $data = new EventReminder([
            'email'         => $row['email'] ?? null,
            'reminder_time' => $row['reminder_time'] ?? null,
            'reminder_id'   => $row['reminder_id'] ?? null,
            'event_id'      => $row['event_id'] ?? null,
        ]);
        dd($data);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
}
