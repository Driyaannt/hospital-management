@extends('app')

@section('content')
    <!--  Row 1 -->
    <div class="row">
      <div class="col-lg-12">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h5>
                <form class="form" method="POST" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}">
                  @csrf <!-- Tambahkan CSRF token -->
                  @if(isset($user))
                    @method('PUT') <!-- Gunakan method PUT untuk update -->
                  @endif
                  <div class="row">
                    <!-- Kolom untuk data user -->
                    <div class="col-md-6">
                      <label for="name" class="col-form-label">Nama <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="username" class="col-form-label">Username <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <input class="form-control @error('username') is-invalid @enderror" type="text" id="username" name="username" value="{{ isset($user) ? $user->username : old('username') }}" required />
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="email" class="col-form-label">Email <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="password" class="col-form-label">Password <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" />
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="role" class="col-form-label">Role <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                          <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                          <option value="dokter" {{ (isset($user) && $user->role == 'dokter') ? 'selected' : '' }}>Dokter</option>
                          <option value="perawat" {{ (isset($user) && $user->role == 'perawat') ? 'selected' : '' }}>Perawat</option>
                          <option value="apoteker" {{ (isset($user) && $user->role == 'apoteker') ? 'selected' : '' }}>Apoteker</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit">{{ isset($user) ? 'Update' : 'Submit' }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
@endsection
