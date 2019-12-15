@extends('dashboard.master')
@section('content')
<div class="row">

    <div class="col-xl-12 order-xl-1">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">My account</h3>
            </div>

          </div>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ Route('karyawan.store') }}" enctype="multipart/form-data">
            @csrf
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group focused">
                          <label class="form-control-label" for="input-foto">Foto Karyawan</label>
                          <input type="file" id="input-foto" name="image" class="form-control form-control-alternative"  >
                        </div>
                      </div>
                </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-first-name">Nama depan</label>
                    <input type="text" id="input-first-name" name="firstname" class="form-control form-control-alternative" placeholder="Nama depan" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-last-name">Nama belakang</label>
                    <input type="text" id="input-last-name" name="lastname" class="form-control form-control-alternative" placeholder="Nama belakang">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-nomerhp">Nomer Handphone</label>
                    <input type="text" id="input-nomerhp" name="numberphone" class="form-control form-control-alternative" placeholder="08123456789" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Email address</label>
                    <input type="email" id="input-email" name="email" class="form-control form-control-alternative" placeholder="email@example.com">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Alamat</label>
                    <input id="input-address" name="location_informations[address]" class="form-control form-control-alternative" placeholder="Home Address"  type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-city">Kota</label>
                    <input type="text" id="input-city" name="location_informations[city]" class="form-control form-control-alternative" placeholder="City">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-country">Negara</label>
                    <input type="text" id="input-country" name="location_informations[country]" class="form-control form-control-alternative" placeholder="Country" >
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="input-country">Kode Postal</label>
                    <input type="number" id="input-postal-code" name="location_informations[code]" class="form-control form-control-alternative" placeholder="Postal code">
                  </div>
                </div>
              </div>
            </div>
            <div  style=" display: flex; align-items: center; justify-content: center;">
                <button name="submit" type="submit" class="btn btn-info">Simpan</button>
        </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
