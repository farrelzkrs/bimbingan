@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-4">
    <div class="col-md-6">
      <h4 class="mb-0">Kelola User</h4>
    </div>
    <div class="col-md-6 text-end">
      <a href="{{ route('user.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Tambah User
      </a>
    </div>
  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @php $i = 0; @endphp
          @foreach ($users as $user)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'info' }}">
                  {{ ucfirst($user->role) }}
                </span>
              </td>
              <td>
                <span class="badge bg-success">Aktif</span>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                      <i class="bx bx-show"></i> Lihat
                    </a>
                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">
                      <i class="bx bx-pencil"></i> Edit
                    </a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item">
                        <i class="bx bx-trash"></i> Hapus
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {!! $users->links() !!}
  </div>
</div>
@endsection
