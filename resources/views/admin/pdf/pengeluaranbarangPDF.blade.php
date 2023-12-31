<html>
    <head>
        <style>
            table {
                border-collapse: collapse;
                border-color: black;
            }
            .tab2 {
              display: inline-block;
              margin-left: 7px;
            }
            .tab3 {
                display: inline-block;
                margin-left: 30px;
            }
            .tab5 {
                display: inline-block;
                margin-left: 67px;
            }
        </style>
    </head>
    <body>
        <table style="margin-left:12%; margin-right:auto; text-align:center;" cellpadding="6">
            <tr>
                <td rowspan="4"><img src="Asset/images/logo-tutwuri-handayani.jpg" width="65px" height="65px"></td>
                <td></td>
            </tr>
            <tr align="center">
                <th style='width:725px'>{{ $sekolah->nama_sekolah }}</th>
            </tr>
            <tr align="center; color:red;">
                <td>Jl.Pesantren KM 2 Cimahi 40513 Tlp. (022) 6652326 Fax (022) 6654698</td>
            </tr>
        </table>
        <table border="1" cellpadding="10" width='100%'>
            <tr>
                <th colspan="6" align="center">PENGELUARAN BARANG</th>
            </tr>
            <tr>
                <td colspan="6" >Tanggal : {{ $date }}<br>Nomor <span class="tab2">:</span></td>
            </tr>
            <tr>
              <td align="center" bgcolor='#f2f2f2'>No.</td>
              <td align="center" bgcolor='#f2f2f2'>Nama Barang</td>
              <td align="center" bgcolor='#f2f2f2'>Jumlah</td>
              <td align="center" bgcolor='#f2f2f2'>Spesifikasi</td>
              <td align="center" bgcolor='#f2f2f2'>Satuan</td>
              <td align="center" bgcolor='#f2f2f2'>Keterangan</td>
            </tr>
            @forelse ($bahans as $bahan)
            <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bahan->nama_alat_atau_bahan }}</td>
                <td>
                    @php
                        $totalVolumeKeluar = $bahan->alatkeluar->where('tanggal_keluar', $date)->sum('volume');
                    @endphp
                    {{ $totalVolumeKeluar}}
                </td>
                <td>{{ $bahan->spesifikasi->merk }}, {{ $bahan->spesifikasi->tipe_atau_model }}, {{ $bahan->spesifikasi->dimensi }}</td>
                <td>{{ $bahan->satuan }}</td>
                <td>
                    @foreach ($bahan->alatkeluar->where('tanggal_keluar', $date) as $alatkeluar)
                        {{ $alatkeluar->keterangan }}
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='6' align='center'></td>
            </tr>
            @endforelse
        </table>
        <table border="1" cellpadding="4" width="100%">
          <tr valign="top">
              <td align="center" height="15%" style='width:201px'>Mengetahui,</td>
              <td align="center" style='width:208px'>Penerima</td>
              <td align="center" style='width:208px'>Yang menyerahkan</td>
          </tr>
        </table>
      </body>
</html>