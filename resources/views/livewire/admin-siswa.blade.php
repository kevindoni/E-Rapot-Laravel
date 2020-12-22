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
            <th>Nama Siswa</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($siswa->count() > 0)
            @foreach ($siswa as $val => $data)
              <tr>
                <td>{{ $val + $siswa->firstitem() }}</td>
                <td>{{ $data->nama_siswa }}</td>
                <td>
                  <a href="{{ route('admin.rapot.show', $data->id) }}" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Lihat Nilai Rapot</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="3" class="text-center">Data Siswa Tidak Ada!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-2 align-items-center">
    <div class="col" style="margin-bottom: 1rem;">
      @if ($siswa->total() > 0)
        Showing {{ $siswa->firstItem() }} to {{ $siswa->lastItem() }} of {{ $siswa->total() }} entries
      @endif
    </div>
    <div class="col-auto text-right">
      {{ $siswa->links() }}
    </div>
  </div>
</div>
