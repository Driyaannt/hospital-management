@extends('app')

@section('content')
    <div class="row">
      <div class="col-lg-12">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <h5>{{ isset($bed) ? 'Edit Bed' : 'Tambah Bed' }}</h5>
                <form class="form" method="POST" action="{{ isset($bed) ? route('bed.update', $bed->id) : route('bed.store') }}">
                  @csrf <!-- Tambahkan CSRF token -->
                  @if(isset($bed))
                    @method('PUT') <!-- Gunakan method PUT untuk update -->
                  @endif
                  <div class="row">
                    <!-- Kategori Bed -->
                    <div class="col-md-6">
                        <label for="category" class="col-form-label">Kategori Bed <span style="color: red;">*</span></label>
                        <div class="col-md-12">
                            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Regular" {{ isset($bed) && $bed->category == 'Regular' ? 'selected' : '' }}>Regular</option>
                                <option value="VIP" {{ isset($bed) && $bed->category == 'VIP' ? 'selected' : '' }}>VIP</option>
                                <option value="VVIP" {{ isset($bed) && $bed->category == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Nomor Bed -->
                    <div class="col-md-6">
                      <label for="bed_number" class="col-form-label">Nomor Bed <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <input class="form-control @error('bed_number') is-invalid @enderror" type="text" id="bed_number" name="bed_number" value="{{ isset($bed) ? $bed->bed_number : old('bed_number') }}" required />
                        @error('bed_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                      <label for="status" class="col-form-label">Status <span style="color: red;">*</span></label>
                      <div class="col-md-12">
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                          <option value="Available" {{ (isset($bed) && $bed->status == 'Available') ? 'selected' : '' }}>Tersedia</option>
                          <option value="Occupied" {{ (isset($bed) && $bed->status == 'Occupied') ? 'selected' : '' }}>Terpakai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit">{{ isset($bed) ? 'Update' : 'Submit' }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
@endsection
