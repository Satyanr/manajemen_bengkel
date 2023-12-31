<div>
    @if ($alats == 'kosong')
        <div class="login-form-bg h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-xl-6">
                        <div class="error-content">
                            <div class="card mb-0">
                                <div class="card-body text-center pt-5">
                                    <h1 class="error-text text-warning mt-5"><i class="fa fa-info-circle"></i></h1>

                                    <h1 class="my-5 text-warning text-wrap">Tambahkan Ruangan Untuk Bisa Mengatur Data
                                        Alat dan bahan</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            @if ($updateMode)
                                <form wire:submit.prevent="update">
                                    <div class="form-group">
                                        <h4 class="text-center">Edit Data Alat Atau Bahan</h4>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <input wire:model="nama_alat_atau_bahan" type="text"
                                                    class="form-control input-default"
                                                    placeholder="Nama Alat Atau Bahan">
                                                @error('nama_alat_atau_bahan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-2 mb-4">
                                                <select wire:model="kode" class="form-control" id="kode">
                                                    <option value="" selected>JENIS</option>
                                                    <option value="A">Alat</option>
                                                    <option value="B">Bahan</option>
                                                </select>
                                                @error('kode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <select wire:model="ruangan_id" class="form-control" id="ruangan">
                                                    <option value="">Ruangan</option>
                                                    @foreach ($ruangans as $ruangan)
                                                        <option value="{{ $ruangan->id }}">
                                                            {{ $ruangan->nama_ruangan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ruangan_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <input wire:model='kode_bahan' type="text"
                                                    class="form-control input-default"
                                                    placeholder="Kode Alat atau Bahan">
                                                @error('kode_bahan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input wire:model="satuan" type="text" id="satuan"
                                                    class="form-control input-default" placeholder="Satuan">
                                                @error('satuan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="harga" type="text"
                                                    class="form-control input-default" placeholder="Harga Satuan">
                                                @error('harga')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <label>Spesifikasi</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input wire:model="merk" type="text" id="spek"
                                                    class="form-control input-default" placeholder="Merk">
                                                @error('merk')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="type" type="text"
                                                    class="form-control input-default" placeholder="Type/Model">
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="dimensi" type="text"
                                                    class="form-control input-default" placeholder="Dimensi">
                                                @error('dimensi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" placeholder="Tahun dibuat"
                                                    id="mdate" wire:model='tahun'>
                                                @error('tahun')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <div class="col-auto">
                                                        <button type="button" wire:click="cancel"
                                                            class="btn btn-secondary text-white">Batal</button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form wire:submit.prevent="store">
                                    <div class="form-group">
                                        <h4 class="text-center">Tambahkan Alat Atau Bahan</h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <input wire:model="nama_alat_atau_bahan" type="text"
                                                    class="form-control input-default"
                                                    placeholder="Nama Alat Atau Bahan">
                                                @error('nama_alat_atau_bahan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label for="tanggal" class="col-md-auto col-form-label">Tanggal
                                                Masuk</label>
                                            <div class="col-lg-2 mb-4">
                                                <input wire:model="tanggal_masuk" type="date" id="tanggal"
                                                    class="form-control input-default">
                                                @error('tanggal_masuk')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 mb-4">
                                                <select wire:model="kode" class="form-control" id="kode">
                                                    <option value="" selected>JENIS</option>
                                                    <option value="A">Alat</option>
                                                    <option value="B">Bahan</option>
                                                </select>
                                                @error('kode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <select wire:model="ruangan_id" class="form-control" id="ruangan">
                                                    <option value="">Ruangan</option>
                                                    @foreach ($ruangans as $ruangan)
                                                        <option value="{{ $ruangan->id }}">
                                                            {{ $ruangan->nama_ruangan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ruangan_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <input wire:model='kode_bahan' type="text"
                                                    class="form-control input-default"
                                                    placeholder="Kode Alat atau Bahan">
                                                @error('kode_bahan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input wire:model="volume" type="text" id="volume"
                                                    class="form-control input-default" placeholder="Jumlah"
                                                    wire:input='calculateTotalHarga()'>
                                                @error('volume')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="satuan" type="text" id="satuan"
                                                    class="form-control input-default" placeholder="Satuan">
                                                @error('satuan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="harga" type="text"
                                                    class="form-control input-default" placeholder="Harga Satuan"
                                                    wire:input='calculateTotalHarga()'>
                                                @error('harga')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="saldo" type="text" id="saldo"
                                                    class="form-control input-default" placeholder="Total Harga">
                                                @error('saldo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mt-3">
                                                <input wire:model="sumber_dana" type="text" id="sumber_dana"
                                                    class="form-control input-default" placeholder="Sumber Dana">
                                                @error('sumber_dana')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <label>Spesifikasi</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input wire:model="merk" type="text" id="spek"
                                                    class="form-control input-default" placeholder="Merk">
                                                @error('merk')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="type" type="text"
                                                    class="form-control input-default" placeholder="Type/Model">
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input wire:model="dimensi" type="text"
                                                    class="form-control input-default" placeholder="Dimensi">
                                                @error('dimensi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" placeholder="Tahun dibuat"
                                                    id="mdate" wire:model='tahun'>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-title">
                                    <h4>Daftar Alat dan Bahan</h4>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end px-5">
                                <div class="form-group">
                                    <input type="text" class="form-control input-rounded h-25" placeholder="Cari"
                                        wire:model='searchAlat' wire:input='resetPage'>
                                </div>
                            </div>
                            @if (auth()->user()->ruangan_id)
                                <div class="col-lg-1 d-flex justify-content-end px-4 h-50">
                                    <a type="button" class="btn mb-1 btn-success d-flex justify-content-end"
                                        href="{{ route('print.bukuindukbaranginventaris', ['id' => auth()->user()->ruangan_id]) }}"><i
                                            class="fa fa-print fa-lg mr-1"> Print</i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Alat/Bahan</th>
                                            <th>Nama Alat/Bahan</th>
                                            <th>Spesifikasi</th>
                                            <th>Stock </th>
                                            <th>Saldo</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($alats as $alat)
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#ModalAlat"
                                                        wire:click='history({{ $alat->id }})'>
                                                        {{ $alat->kode_bahan }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#ModalAlat"
                                                        wire:click='history({{ $alat->id }})'>
                                                        {{ $alat->nama_alat_atau_bahan }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#ModalAlat"
                                                        wire:click='history({{ $alat->id }})'>
                                                        @if ($alat->spesifikasi)
                                                            <ul>
                                                                <li>
                                                                    <i>
                                                                        Merk : {{ $alat->spesifikasi->merk }}
                                                                    </i>
                                                                </li>
                                                                <li>
                                                                    <i>
                                                                        Type/Model :
                                                                        {{ $alat->spesifikasi->tipe_atau_model }}
                                                                    </i>
                                                                </li>
                                                                <li>
                                                                    <i>
                                                                        Dimensi :
                                                                        {{ $alat->spesifikasi->dimensi }}
                                                                    </i>
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#ModalAlat"
                                                        wire:click='history({{ $alat->id }})'>
                                                        {{ $alat->volume }} {{ $alat->satuan }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#ModalAlat"
                                                        wire:click='history({{ $alat->id }})'>
                                                        Rp {{ number_format($alat->saldoalat(), 2, ',', '.') }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" data-toggle="dropdown"><i
                                                                class="fa fa-ellipsis-v fa-lg"></i></a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal" data-target="#ModalAlat"
                                                                wire:click='onmas({{ $alat->id }})'>Tambah
                                                                Stock</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                wire:click='edit({{ $alat->id }})'>Edit</a>
                                                            <a class="dropdown-item text-danger"
                                                                href="javascript:void(0)" data-toggle="modal"
                                                                data-target="#ModalAlat"
                                                                wire:click='onkel({{ $alat->id }})'>Pakai</a>
                                                            @if (auth()->user()->role == 'KepalaBengkel')
                                                                <a class="dropdown-item text-success"
                                                                    href="{{ route('print.kartustok', ['id' => auth()->user()->ruangan_id]) }}">Print
                                                                    Kartu Stock</a>
                                                            @endif
                                                            @if (auth()->user()->role == 'AdminSekolah' or auth()->user()->role == 'SuperAdmin')
                                                                <a class="dropdown-item text-danger"
                                                                    href="javascript:void(0)"
                                                                    wire:click='ondel({{ $alat->id }})'>Delete</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <h1>Data Kosong</h1>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {{ $alats->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- modal --}}
    @include('livewire.admin.alat-bahan.daftar.modal')
</div>
