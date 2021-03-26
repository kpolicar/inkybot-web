<?php

namespace App\Exports;

use Arr;
use App\Http\Resources\ExportMaging;
use App\Models\Maging;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class MagingExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    private $fileName = 'maging.csv';
    private $writerType = Excel::CSV;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    private $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        return $this->user->maging()->get()->mapInto(ExportMaging::class);
    }

    public function headings(): array
    {
        return [
            'date', 'kamas', 'exo_attempts', 'exo_successes'
        ];
    }
}
