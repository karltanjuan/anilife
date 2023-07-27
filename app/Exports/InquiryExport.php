<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Models\Inquiry;

class InquiryExport implements FromCollection, WithHeadings
{
    private $inquiries;

    public function __construct($inquiries) 
    {
        $this->inquiries = $inquiries;
    }

    /**
    * Headings
    */
	public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email Address',
            'Contact No',
            'Inquiry Details',
            'Date Created',      
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $response_data = [];

        foreach ($this->inquiries as $key => $inquiry)
        {
            $response_data[] = [
                'id'            => ++$key,
                'full_name'     => $inquiry->full_name,
                'email_address' => $inquiry->email_address,
                'contact_no'    => $inquiry->contact_no,
                'message'       => $inquiry->message,
                'created_at'    => $inquiry->created_at,
            ];
        }

        return collect($response_data);     
    }
}
