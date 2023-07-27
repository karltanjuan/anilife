<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Models\ActivityLog;

class ActivityLogExport implements FromCollection, WithHeadings
{
    private $activity_logs;

    public function __construct($activity_logs) 
    {
        $this->activity_logs = $activity_logs;
    }

    /**
    * Headings
    */
	public function headings(): array
    {
        return [
            'ID',
            'Module',
            'Log Type',
            'IP Address',
            'Log By',
            'Date Created',      
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $response_data = [];

        foreach ($this->activity_logs as $key => $log)
        {
            $response_data[] = [
                'id'            => ++$key,
                'module'        => $log->module,
                'log_type'      => $log->log_type,
                'ip_address'    => $log->ip_address,
                'full_name'     => $log->first_name." ".$log->middle_name." ".$log->last_name,
                'date_created'  => $log->created_at,
            ];
        }

        return collect($response_data);     
    }
}
