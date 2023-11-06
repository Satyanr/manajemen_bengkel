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
                                        Alat dan Bahan</h1>
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
                        <div class="row">
                            <div class="col">
                                <div class="card-title">
                                    <h4>Riwayat Pemakaian Alat</h4>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end px-4">
                                <div class="form-group">
                                    <input type="text" class="form-control input-rounded h-25" placeholder="Cari"
                                        wire:model='searchAlat' wire:input='resetPage'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pemakaian</th>
                                            <th>Kode Alat/Bahan</th>
                                            <th>Nama Alat/Bahan</th>
                                            <th>Nama Pemakai</th>
                                            <th>Jumlah Dipakai</th>
                                            <th>Keterangan</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($alats as $alat)
                                            @foreach ($alat->alatkeluar->sortByDesc('id') as $alatkeluar)
                                                <tr>
                                                    <td>{{ $alatkeluar->tanggal_keluar }}</td>
                                                    <td>AB-{{ $alat->id }}</td>
                                                    <td>{{ $alat->nama_alat_atau_bahan }}</td>
                                                    <td>{{ $alatkeluar->nama_pemakai }}</td>
                                                    <td>{{ $alatkeluar->volume }}</td>
                                                    <td>{{ $alatkeluar->keterangan }}</td>
                                                    {{-- <td>
                                                            <div class="dropdown">
                                                                <a href="#" data-toggle="dropdown"><i
                                                                        class="fa fa-ellipsis-v fa-lg"></i></a>
                                                                <div class="dropdown-menu"><a class="dropdown-item"
                                                                        href="#">Link
                                                                        1</a> <a class="dropdown-item" href="#">Link 2</a> <a
                                                                        class="dropdown-item" href="#">Link 3</a>
                                                                </div>
                                                            </div>
                                                        </td> --}}
                                                </tr>
                                            @endforeach
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
</div>
