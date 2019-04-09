@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <h2 class="card-header">Pengembalian</h2>
      <hr>

        <form action="{{ url('laporan/pengembalian/pdf') }}" method="post">
          {{csrf_field()}}
            <div class="form-group">
               <label class="control-label"><font size="3" color="black"> Dari Tanggal </font></label>
               <input type="date" style="margin-bottom:10px;" class="date form-control" name="dari" value="{{$dari}}" readonly="">
               <label class="control-label"><font size="3" color="black"> Sampai Tanggal </font></label>
               <input type="date" class="date form-control" name="sampai" value="{{$sampai}}" readonly=""><br>
               <button type="submit" style="margin-top:10px;" class="btn btn-success btn-rounded"><i class="fa fa-print">&nbsp;Cetak</i></button>
            </div>
         </form>

        <div class="card-body">
          <div class="table-responsive mt-10">
            <table id="datatable" class="table table-striped table-bordered">
                <thead class="thead-default" >
                  <tr>
                    <th><input type="checkbox" id="check-all" class="flat"></th>
                    <th>No</th>
                    <th>Nama Perental</th>
                    <th>Barang Rental</th>
                    <th>Jumlah Rental</th>
                    <th>Tanggal Rental</th>
                    <th>Tanggal Batas Rental</th>
                    <th>Tanggal Kembali</th>
                    <th>Harga</th>
                    <th>Denda</th>
                    <th>Keterangan</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nomor = 1; ?>
                  @php $no = 1; @endphp
                  @foreach($pengembalians as $data)
                  <tr>
                      <th><input type="checkbox" id="check-all" class="flat"></th>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->Konsumen->nama}}</td>
                    <td>{{ $data->Barang->nama }}</td>
                    <td>{{ $data->jumlah_pinjam }}</td>
                    <td>{{ $data->tanggal_pinjam }}</td>
                    <td>{{ $data->tanggal_batas }}</td>
                    <td>{{ $data->tanggal_kembali }}</td>
                    <td>Rp.{{ number_format($data->Barang->harga*$data->jumlah_pinjam) }},-</td>
                    <td>Rp.{{ number_format($data->denda) }},-</td>
                    <td>{{ $data->keterangan }}</td>
                    <td><a class="btn btn-round btn-info" href="#"><i class="fa fa-mood"></i>Cetak</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
