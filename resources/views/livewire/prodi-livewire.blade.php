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
            <th>Singkatan</th>
            <th>Nama Jurusan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($prodi->count() > 0)
            @foreach ($prodi as $val => $data)
              <tr>
                <td>{{ $val + $prodi->firstitem() }}</td>
                <td>{{ $data->singkatan }}</td>
                <td>{{ $data->nama_prodi }}</td>
                <td>
                  <form action="{{ route('prodi.destroy', $data->id) }}" method="post" onsubmit="return confirm('Yakin hapus data!')">
                    @csrf
                    @method('delete')
                    <a href="{{ route('prodi.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                    <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="4" class="text-center">Data Jurusan Tidak Ada!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-2 align-items-center">
    <div class="col" style="margin-bottom: 1rem;">
      @if ($prodi->total() > 0)
        Showing {{ $prodi->firstItem() }} to {{ $prodi->lastItem() }} of {{ $prodi->total() }} entries
      @endif
    </div>
    <div class="col-auto text-right">
      {{ $prodi->links() }}
    </div>
  </div>  
</div>
