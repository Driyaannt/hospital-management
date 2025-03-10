@extends('app')

@section('content')
    <!--  Row 1 -->
    <div class="row">
        @foreach ($category_bed as $data_category_bed)
            <div class="col-lg-4">
                <div class="card rounded-2 overflow-hidden hover-img">
                    <div class="card-body p-4">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm mt-3">
                            <li class="sidebar-item py-2">
                                <a class="fw-semibold text-dark" href="#">{{ $data_category_bed->category }}</a>
                            </li>
                        </span>
                        <ul class="list-unstyled mt-4">
                            <li>
                                <button type="button"
                                    class="btn d-flex btn-light-primary w-100 d-block text-primary font-medium">
                                    Tersedia
                                    <span class="badge ms-auto bg-primary">{{ $data_category_bed->available_beds }}</span>
                                </button>
                            </li>
                            <li class="mt-2">
                                <button type="button"
                                    class="btn d-flex btn-light-warning w-100 d-block text-warning font-medium">
                                    Terpakai
                                    <span class="badge ms-auto bg-warning">{{ $data_category_bed->occupied_beds }}</span>
                                </button>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center gap-4">
                            <div class="d-flex align-items-center fs-2 ms-auto">
                                <span class="mb-1 badge bg-secondary">Total: {{ $data_category_bed->total_beds }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Bed</h5>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('v-bed-create') }}" class="btn btn-primary">Tambah Bed</a>
                    </div>
                    <div class="table-responsive">
                        <table id="bed_table" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Nomor Bed</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beds as $bed)
                                    <tr>
                                        <td>{{ $bed->category }}</td>
                                        <td>{{ $bed->bed_number }}</td>
                                        <td>
                                            @if ($bed->status == 'Available')
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-danger">Terpakai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('bed.edit', $bed->id) }}" class="btn btn-warning"
                                                onclick="confirmEdit(event)">Edit</a>
                                            <form action="{{ route('bed.delete', $bed->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="confirmDelete(event)">Delete</button>
                                            </form>
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

     <!-- jQuery -->
     <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
     <script>
         $(document).ready(function() {
             $('#bed_table').DataTable();
         });
     </script>
@endsection
