@extends('dashboard.master')
@section('content')

<div class="col">
    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row">
            <div class="col-md-2">
                    <h3 class="text-black mb-0">List Karyawan</h3>
            </div>
            <div class="col-md-10">
                    <div class="col text-right">
                            <a  href="{{ Route('karyawan.create') }}" class="btn btn-info" id="tmbkaryawan">Tambah Karyawan</a>
                    </div>
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama Karyawan</th>
              <th scope="col">Email</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
              @foreach($data as $row)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <th scope="col">
                  <div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                      <img alt="Image placeholder" src="{{ asset('uploads/images/'.$row->data->image) }}">
                    </a>
                  </div>
                </th>
                <td>
                 {{ $row->name }}
                </td>
                <td>
                 {{ $row->email }}
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{ route('karyawan.edit',[$row->data->id]) }}">Edit</a>
                    <a class="dropdown-item delete" href="#" data-id="{{ $row->id }}">Delete</a>
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
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
    $('.delete').on('click', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '{{ Route("karyawan.delete") }}',
                    type: 'GET',
                    data: {
                    'delete': 1,
                    'id': id,
                  },
                  success: function(response){
                    window.setTimeout(function(){window.location.reload()}, 2000);

                  }
                  });
            }
          })
    });
});
</script>
@endsection
