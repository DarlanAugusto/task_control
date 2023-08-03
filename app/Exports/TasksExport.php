<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth::user()->tasks()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuário',
            'Tarefa',
            'Data limite',
            'Data criação',
            'Data Conclusão'
        ];
    }
}
