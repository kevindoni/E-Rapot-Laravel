<div>
  <div class="row">
    <div class="col-sm-12 col-md-6 paginate-length">
      <label>
        Show <select wire:model="paginate" class="custom-select custom-select-sm form-control form-control-sm">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select> entries
      </label>
    </div>
    <div class="col-sm-12 col-md-6 text-right search-table">
      <label>
        Search: <input type="search" wire:model="search" class="form-control form-control-sm">
      </label>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <table class="table table-bordered table-striped" style="margin: 6px 0">
        <thead>
          <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Guru</th>
            <th>Mata Pelajaran</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($jadwal->count() > 0)
            @foreach ($jadwal as $val => $data)
              <tr>
                <td>{{ $val + $jadwal->firstitem() }}</td>
                <td>{{ $data->nama_kelas }}</td>
                <td>{{ $data->nama_guru }}</td>
                <td>{{ $data->nama_mapel }}</td>
                <td>
                  <form action="{{ route('jadwal.destroy', $data->id) }}" method="post" onsubmit="return confirm('Yakin hapus data!')">
                    @csrf
                    @method('delete')
                    <a href="{{ route('jadwal.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                    <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="5" class="text-center">Data Jadwal Tidak Ada!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-2 align-items-center">
    <div class="col" style="margin-bottom: 1rem;">
      @if ($jadwal->total() > 0)
        Showing {{ $jadwal->firstItem() }} to {{ $jadwal->lastItem() }} of {{ $jadwal->total() }} entries
      @endif
    </div>
    <div class="col-auto text-right">
      {{ $jadwal->links() }}
    </div>
  </div>  
</div>
