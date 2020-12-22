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
            <th>No Induk</th>
            <th>Nama Siswa / Username / Password Default</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($siswa->count() > 0)
            @foreach ($siswa as $val => $data)
              <tr>
                <td>{{ $val + $siswa->firstitem() }}</td>
                <td>{{ $data->no_induk }}</td>
                <td>
                  @if ($data->status == 'Belum Aktif')
                    {{ $data->nama_siswa }}
                  @else
                    {{ $data->nama_siswa . " / " . $data->user($data->id)->username . " / siswa@123" }}
                  @endif
                </td>
                <td class="text-center">
                  @if ($data->status == 'Belum Aktif')
                    <span class="badge badge-warning text-white">{{ $data->status }}</span>
                  @else
                    <span class="badge badge-success">{{ $data->status }}</span>
                  @endif
                </td>
                <td>
                  <form action="{{ route('siswa.destroy', $data->id) }}" method="post" onsubmit="return confirm('Yakin hapus data!')">
                    @csrf
                    @method('delete')
                    <a href="{{ route('siswa.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                    <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                    @if ($data->status == 'Belum Aktif')
                      <a wire:click="aktifkan({{ $data->id }})" class="btn btn-primary text-white btn-sm"><i class="nav-icon fas fa-user"></i> &nbsp; Aktifkan User</a>
                    @else
                      <a wire:click="nonaktifkan({{ $data->id }})" class="btn btn-warning text-white btn-sm"><i class="nav-icon fas fa-user"></i> &nbsp; NonAktifkan User</a>
                    @endif
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="5" class="text-center">Data Siswa Tidak Ada!</td>
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
  <script>
    window.addEventListener('success', event => {
      toastr.success(event.detail.message);
    });
  </script> 
</div>
