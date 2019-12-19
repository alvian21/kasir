@extends('dashboard.master')
@section('content')

<div class="row mt-5">
    <div class="col">
      <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
          <h3 class="text-white mb-0">Card tables</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-dark table-flush">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Jumlah uang</th>
                <th scope="col">Total yg dibayar</th>
                <th scope="col">Tanggal</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $data as $row)

                <?php
                    $name = json_decode($row->name, true);
                ?>

              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="#">
                    @foreach ($name as $nama)
                    {{ $nama["name"] .= ', ' }}
               @endforeach
                </a>
                </td>
                <td>{{ $row->money }}</td>
                <td>{{ $row->total }}</td>
                <td>{{ $row->created_at }}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
