<?php

namespace App\Livewire\Admin\PeralatanMesin\Transaksi\Masuk;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PeralatanAtauMesin;

class Index extends Component
{
    use WithPagination;
    public $ruangan_byadmin;

    protected $paginationTheme = 'bootstrap';
    public $searchPeralatan;
    public function resetPage()
    {
        $this->gotoPage(1, 'peralatanPage');
    }
    public function render()
    {
        $searchPeralatan = '%' . $this->searchPeralatan . '%';

        if (auth()->user()->role == 'SuperAdmin' or auth()->user()->role == 'Admin') {
            return view('livewire.admin.peralatan-mesin.transaksi.masuk.index', [
                'peralatans' => PeralatanAtauMesin::where('nama_peralatan_atau_mesin', 'LIKE', $searchPeralatan)
                    ->where('ruangan_id', $this->ruangan_byadmin)
                    ->orderBy('id', 'DESC')
                    ->paginate(10, ['*'], 'peralatanPage'),
            ]);
        } else {
            if (
                auth()
                    ->user()
                    ->sekolah->ruangan->pluck('id')
                    ->count() > 0
            ) {
                $peralatans = PeralatanAtauMesin::whereHas('ruangan', function ($query) {
                    $query->where('sekolah_id', auth()->user()->sekolah->id);
                })
                    ->where('nama_peralatan_atau_mesin', 'LIKE', $searchPeralatan)
                    ->orderBy('id', 'DESC')
                    ->paginate(10, ['*'], 'peralatanPage');
                return view('livewire.admin.peralatan-mesin.transaksi.masuk.index', [
                    'peralatans' => $peralatans,
                ]);
            } else {
                return view('livewire.admin.peralatan-mesin.transaksi.masuk.index', [
                    'peralatans' => 'kosong',
                ]);
            }
        }
    }
}
