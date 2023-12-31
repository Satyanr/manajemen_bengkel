<?php

namespace App\Livewire\Admin\AlatBahan\Pengajuan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PengajuanAlatAtauBahan;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    public $nama_alat_atau_bahan, $nama_pengaju, $tanggal, $kode, $volume, $satuan, $sumber_dana, $merk, $type, $dimensi, $image, $pengajuan_id, $searchPengajuan, $selectedPengajuanId, $imageprev;
    public $updateMode = false;
    public $informasiMode = false;

    use WithPagination;
    use LivewireAlert;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];
    public function getListeners()
    {
        return ['delete'];
    }

    public function resetPage()
    {
        $this->gotoPage(1, 'pengajuanPages');
    }
    public function render()
    {
        $searchPengajuan = '%' . $this->searchPengajuan . '%';
        if (auth()->user()->guru_id) {
            return view('livewire.admin.alat-bahan.pengajuan.index', [
                'pengajuans' => PengajuanAlatAtauBahan::where('nama_alat_atau_bahan', 'LIKE', $searchPengajuan)
                    ->where('guru_id', auth()->user()->guru_id)
                    ->orderBy('id', 'DESC')
                    ->paginate(10, ['*'], 'pengajuanPages'),
            ]);
        } else {
            return view('livewire.admin.alat-bahan.pengajuan.index', [
                'pengajuans' => PengajuanAlatAtauBahan::where('nama_alat_atau_bahan', 'LIKE', $searchPengajuan)
                    ->where('sekolah_id', auth()->user()->sekolah_id)
                    ->orderBy('id', 'DESC')
                    ->paginate(10, ['*'], 'pengajuanPages'),
            ]);
        }
    }

    private function resetInputFields()
    {
        $this->nama_alat_atau_bahan = '';
        $this->image = null;
        $this->kode = '';
        $this->volume = '';
        $this->satuan = '';
        $this->merk = '';
        $this->type = '';
        $this->dimensi = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nama_alat_atau_bahan' => 'required',
            'kode' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'dimensi' => 'required',
            'merk' => 'required',
            'type' => 'required',
        ],
        [
            'nama_alat_atau_bahan.required' => 'Nama Alat atau Bahan tidak boleh kosong.',
            'kode.required' => 'Kode tidak boleh kosong.',
            'volume.required' => 'Volume tidak boleh kosong.',
            'satuan.required' => 'Satuan tidak boleh kosong.',
            'dimensi.required' => 'Dimensi tidak boleh kosong.',
            'merk.reqired' => 'Merk tidak boleh kosong.',
            'type.required' => 'Type tidak boleh kosong.',
        ]);

        if ($this->image) {
            $validatedDate['image'] = $this->image->store('gambar_pengajuan', 'public');

            PengajuanAlatAtauBahan::create([
                'nama_alat_atau_bahan' => $this->nama_alat_atau_bahan,
                'gambar' => $validatedDate['image'],
                'kode' => $this->kode,
                'volume' => $this->volume,
                'satuan' => $this->satuan,
                'sekolah_id' => auth()->user()->sekolah_id,
                'guru_id' => auth()->user()->guru_id,
                'merk' => $this->merk,
                'type_atau_model' => $this->type,
                'dimensi' => $this->dimensi,
                'tanggal' => date('Y-m-d H:i:s'),
            ]);
        } else {
            PengajuanAlatAtauBahan::create([
                'nama_alat_atau_bahan' => $this->nama_alat_atau_bahan,
                'kode' => $this->kode,
                'volume' => $this->volume,
                'satuan' => $this->satuan,
                'sekolah_id' => auth()->user()->sekolah_id,
                'guru_id' => auth()->user()->guru_id,
                'merk' => $this->merk,
                'type_atau_model' => $this->type,
                'dimensi' => $this->dimensi,
                'tanggal' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->resetInputFields();

        $this->alert('success', 'Berhasil Ditambahkan!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function edit($id)
    {
        $this->informasiMode = false;
        $pengajuan = PengajuanAlatAtauBahan::findOrFail($id);
        $this->pengajuan_id = $id;
        $this->nama_alat_atau_bahan = $pengajuan->nama_alat_atau_bahan;
        $this->imageprev = $pengajuan->gambar;
        $this->type = $pengajuan->type_atau_model;
        $this->dimensi = $pengajuan->dimensi;
        $this->merk = $pengajuan->merk;
        $this->kode = $pengajuan->kode;
        $this->volume = $pengajuan->volume;
        $this->satuan = $pengajuan->satuan;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->informasiMode = false;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'nama_alat_atau_bahan' => 'required',
            'kode' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'dimensi' => 'required',
            'merk' => 'required',
            'type' => 'required',
        ],
        [
            'nama_alat_atau_bahan.required' => 'Nama Alat atau Bahan tidak boleh kosong.',
            'kode.required' => 'Kode tidak boleh kosong.',
            'volume.required' => 'Volume tidak boleh kosong.',
            'satuan.required' => 'Satuan tidak boleh kosong.',
            'dimensi.required' => 'Dimensi tidak boleh kosong.',
            'merk.required' => 'Merk tidak boleh kosong.',
            'type.required' => 'Type tidak boleh kosong.',
        ]);

        if ($this->image != null) {
            $validatedDate['image'] = $this->image->store('files', 'public');
            $pengajuan = PengajuanAlatAtauBahan::find($this->pengajuan_id);
            $pengajuan->update([
                'nama_alat_atau_bahan' => $this->nama_alat_atau_bahan,
                'gambar' => $validatedDate['image'],
                'kode' => $this->kode,
                'volume' => $this->volume,
                'satuan' => $this->satuan,
                'merk' => $this->merk,
                'type_atau_model' => $this->type,
                'dimensi' => $this->dimensi,
                'tanggal' => date('Y-m-d H:i:s'),
            ]);
            if ($this->imageprev != null) {
                Storage::disk('public')->delete($this->imageprev);
            }
        } else {
            $pengajuan = PengajuanAlatAtauBahan::find($this->pengajuan_id);
            $pengajuan->update([
                'nama_alat_atau_bahan' => $this->nama_alat_atau_bahan,
                'kode' => $this->kode,
                'volume' => $this->volume,
                'satuan' => $this->satuan,
                'merk' => $this->merk,
                'type_atau_model' => $this->type,
                'dimensi' => $this->dimensi,
                'tanggal' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->updateMode = false;
        $this->resetInputFields();
        $this->alert('success', 'Berhasil Diubah!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function updateStatus($newStatus)
    {
        $pengajuan = PengajuanAlatAtauBahan::find($this->selectedPengajuanId);

        if (in_array($newStatus, ['Diterima', 'Ditolak'])) {
            $pengajuan->status = $newStatus;
            $pengajuan->save();
            $this->alert('success', 'Berhasil ' . $newStatus . ' !', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function ondel($id)
    {
        $this->selectedPengajuanId = $id;

        $this->alert('question', 'Yakin Ingin di Hapus ?', [
            'position' => 'center',
            'timer' => 5000,
            'toast' => false,
            'timerProgressBar' => true,
            'showCancelButton' => true,
            'cancelButtonText' => 'Tidak',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya',
            'onConfirmed' => 'delete',
            'confirmButtonColor' => '#f03535',
        ]);
    }

    public function delete()
    {
        $pengajuan = PengajuanAlatAtauBahan::find($this->selectedPengajuanId);

        if ($pengajuan) {
            if ($pengajuan->gambar != null){
            Storage::disk('public')->delete($pengajuan->gambar);
            }
            $pengajuan->delete();
            $this->alert('success', 'Berhasil Dihapus!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', 'Pengajuan Tidak Ditemukan!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function info($id)
    {
        $this->updateMode = false;
        $this->selectedPengajuanId = $id;
        $pengajuan = PengajuanAlatAtauBahan::findOrFail($id);
        $this->pengajuan_id = $id;
        $this->nama_alat_atau_bahan = $pengajuan->nama_alat_atau_bahan;
        $this->imageprev = $pengajuan->gambar;
        $this->type = $pengajuan->type_atau_model;
        $this->dimensi = $pengajuan->dimensi;
        $this->merk = $pengajuan->merk;
        $this->kode = $pengajuan->kode;
        $this->volume = $pengajuan->volume;
        $this->satuan = $pengajuan->satuan;
        $this->nama_pengaju = $pengajuan->guru->nama_guru;
        $this->informasiMode = true;
    }
}
