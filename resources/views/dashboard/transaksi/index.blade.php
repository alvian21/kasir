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
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $data as $row)

                <?php
                    $name = json_decode($row->name, true);
                ?>

              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    @foreach ($name as $nama)
                    {{ $nama["name"] .= ', ' }}
               @endforeach
                </td>
                <td>{{ $row->money }}</td>
                <td>{{ $row->total }}</td>
                <td>{{ $row->created_at }}</td>
                <td class=""> <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <button class="dropdown-item " onclick="window.location.href='{{ Route('detail',[$row->id]) }}'">Detail</button>
                        <button class="dropdown-item " >Delete</button>
                        </div>
                    </div>
              </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
