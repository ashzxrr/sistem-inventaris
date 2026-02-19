<?php

namespace App\Exports;

use App\Models\Mutasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MutasiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $q;

    public function __construct($q = null)
    {
        $this->q = $q;
    }

    public function collection()
    {
        $query = Mutasi::with('barang')->orderBy('tanggal', 'desc');
        if ($this->q) {
            $q = $this->q;
            $query->where(function($sub) use ($q) {
                $sub->where('penanggung_jawab', 'like', "%{$q}%")
                    ->orWhere('keterangan', 'like', "%{$q}%")
                    ->orWhere('jenis', 'like', "%{$q}%")
                    ->orWhereHas('barang', function($qb) use ($q) {
                        $qb->where('kode_barang', 'like', "%{$q}%")
                           ->orWhere('nama_barang', 'like', "%{$q}%");
                    });
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['No', 'Kode Barang', 'Nama Barang', 'Jenis', 'Jumlah', 'Satuan', 'Penanggung Jawab', 'Tanggal', 'Keterangan'];
    }

    public function map($mutasi): array
    {
        return [
            $mutasi->id,
            $mutasi->barang->kode_barang ?? '',
            $mutasi->barang->nama_barang ?? '',
            $mutasi->jenis,
            $mutasi->jumlah,
            $mutasi->barang->satuan ?? '',
            $mutasi->penanggung_jawab,
            date('Y-m-d', strtotime($mutasi->tanggal)),
            $mutasi->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header bold
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        // Auto size columns
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        return [];
    }
}
