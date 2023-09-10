<?php

namespace App\Exports;

use App\Models\kasbesar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasbesarExport implements FromCollection,ShouldAutoSize,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id, $from, $to;
    function __construct($id, $from, $to) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
    }
    public function collection()
    {
        $data = kasbesar::with(['coadebit','coakredit'])
            ->where('kasbesars.cabang_id', $this->id)->whereBetween('tanggal', [$this->from, $this->to])->get();
        return $data;
    }
    public function map($kasbesar): array
    {
        return [
           $kasbesar->id,
           $kasbesar->name,
           $kasbesar->penerima,
           $kasbesar->nobuktikas,
           $kasbesar->tanggal,
           $kasbesar->ref,
           $kasbesar->jumlah,
           $kasbesar->coadebit->name,
           $kasbesar->coakredit->name,
           $kasbesar->cabang_id,
           
        ];
    }
    public function headings(): array
    {
        return
        [
            '#',
            'name',
            'penerima',
            'no bukti kas',
            'tanggal',
            'ref',
            'jumlah',
            'Nama Akun Debit',
            'Nama Akun Kredit',
            'Cabang_id'
        ];
    }
}
