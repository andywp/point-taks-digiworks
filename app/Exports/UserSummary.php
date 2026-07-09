<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\TaskPoint;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class UserSummary implements FromCollection, WithHeadings ,WithColumnFormatting
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //dd($this->request->tanggal);
        $reqTanggal = $this->request->tanggal;
        $date = explode('-', $reqTanggal);

        $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
        $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');

        $query = TaskPoint::with(['brand', 'admin', 'masterTask'])
            ->whereBetween('tanggal', [$start, $end]);

        if (!empty($this->request->task)) {
            $query->where('master_tasks_id', $this->request->task);
        }

        if (!empty($this->request->user)) {
            $query->where('admin_id', $this->request->user);
        }

        if (!empty($this->request->brand)) {
            $query->where('brand_id', $this->request->brand);
        }

        $query->orderBy('tanggal','ASC');
        //dd($start ,$end,$query->get());
        return $query->get()->map(function ($item) {
            return [
                'Tanggal'   => $item->tanggal,
                'Brand'     => $item->brand->brand,
                'Nama'      => $item->admin->name,
                'Task'      => $item->masterTask->pekerjaan,
                'Keterangan'    => $item->note,
                'Output'    => $item->output,
                'Point'     => $item->point,
                
            ];
        });
    }

    public function columnFormats(): array
    {
        return [
            //'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Brand',
            'Nama',
            'Task',
            'Keterangan',
            'Output',
            'Point',
        ];
    }
}
