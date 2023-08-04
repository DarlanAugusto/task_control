<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TasksExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth::user()
            ->tasks()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Usuário',
            'Tarefa',
            'Data limite',
        ];
    }

    public function map($row): array
    {

        return [
            $row->user->name,
            $row->task,
            date('d/m/Y', strtotime($row->deadline_date))
        ];
    }

    public function title(): string
    {
        return "Lista de Tarefas";
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 50,
            'C' => 25
        ];
    }
}
