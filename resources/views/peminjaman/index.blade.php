@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        @include('sweet::alert')
         <h2 class="card-title">Data Rental</h2>
         <hr>
          <a class="btn btn-round btn-primary" href="{{route('peminjaman.create')}}"><i class="fa fa-file-plus"></i> Tambah</a><td>
          {{-- <a class="btn btn-round btn-info" href="{{route('peminjaman.create')}}"><i class="fa fa-mood"></i> PDF </a> --}}

        </h2>
            <div class="table-responsive mt-10">
              <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>

                    <!-- <th><input type="checkbox" id="check-all" class="flat"></th> -->

                  <th>No</th>
                  <th>Nama Perental</th>
                  <th>Barang Rentalan</th>
                  <th>Gambar</th>
                  <th>Jumlah Rental</th>
                  <th>Harga / 24 Jam</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                @php $no = 1; @endphp
                @foreach($peminjamans as $data)
                <tr>

                  <!-- <th><input type="checkbox" id="check-all" class="flat"></th> -->

                  <td>{{ $no++ }}</td>
                  <td>{{ $data->Konsumen->nama }}</td>
                  <td>{{ $data->Barang->nama }}</td>
                  <td><img src="{{ asset('/backend/images/gambarbarang/'.$data->barang->gambar) }}" style="max-height:200px;max-width:200px;margin-top:7px"></td>
                  <td>{{ $data->jumlah_pinjam }}</td>
                  <td>Rp.{{ number_format($data->Barang->harga*$data->jumlah_pinjam) }},-</td>
                  <td><a class="btn btn-round btn-warning" href="{{ route('peminjaman.show',$data->id) }}"><i class="fa fa-mood"></i> Detail</a>

                </td>
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
