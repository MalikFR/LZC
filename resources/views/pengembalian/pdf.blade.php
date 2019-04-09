<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengembalian</title>
</head>

<body>
    <h2 style="color: #5e9ca0; text-align: center;">LOCAZIONE CAMERA&nbsp;</h2>
    <p style="color: #5e9ca0; text-align: center;">Jl.Terusan Kopo Sayati No.124 Kab.Bandung, Jawa Barat 40234</p>
    <p style="color: #5e9ca0; text-align: center;">telp.081296269761</p>
    <p style="color: #5e9ca0; text-align: center;">__________________________________________________________________________________________</p>
    <h3 style="color: #2e6c80;">Rekapitulasi Rental Tanggal :<?php echo date('d/m/Y', strtotime($dari))?> s/d Tanggal : <?php echo date('d/m/Y', strtotime($sampai))?></h3>

    <br>
    <table id="myTable" border="1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>
                    <center><font size="3" color="black">No</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Nama Barang</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Nama Perental</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Tanggal Rental</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Tanggal Kembali</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Jumlah Sewa</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Harga</font></center>
                </th>
                <th>
                    <center><font size="3" color="black">Jumlah Denda</font></center>
                </th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach($pengembalians as $data)
            <tr>
                <td>
                    <center><font size="3" color="black">{{ $no++ }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">{{ $data->barang->nama }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">{{ $data->konsumen->nama }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">{{ $data->tanggal_pinjam }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">{{ $data->tanggal_kembali }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">{{ $data->jumlah_pinjam }}</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">Rp.{{ number_format($data->Barang->harga*$data->jumlah_pinjam) }},-</font></center>
                </td>
                <td>
                    <center><font size="3" color="black">Rp.{{ number_format($data->denda) }},-</font></center>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
