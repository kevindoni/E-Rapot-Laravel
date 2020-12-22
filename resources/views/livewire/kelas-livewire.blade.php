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
            <th>Nama Kelas / Username / Password Default</th>
            <th>Wali Kelas</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($kelas->count() > 0)
            @foreach ($kelas as $val => $data)
              <tr>
                <td>{{ $val + $kelas->firstitem() }}</td>
                <td>
                  @if ($data->status == 'Belum Aktif')
                    {{ $data->nama_kelas }}
                  @else
                    {{ $data->nama_kelas . " / " . $data->user($data->id)->username . " / wali@" . $data->user($data->id)->username }}
                  @endif
                </td>
                @if ($data->wali)
                  <td>{{ $data->wali->nama_guru }}</td>
                @else
                  <td class="text-center">{{ " - " }}</td>
                @endif
                <td class="text-center">
                  @if ($data->status == 'Belum Aktif')
                    <span class="badge badge-warning text-white">{{ $data->status }}</span>
                  @else
                    <span class="badge badge-success">{{ $data->status }}</span>
                  @endif
                </td>
                <td>
                  <form action="{{ route('kelas.destroy', $data->id) }}" method="post" onsubmit="return confirm('Yakin hapus data!')">
                    @csrf
                    @method('delete')
                    <a href="{{ route('kelas.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
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
              <td colspan="5" class="text-center">Data Kelas Tidak Ada!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-2 align-items-center">
    <div class="col" style="margin-bottom: 1rem;">
      @if ($kelas->total() > 0)
        Showing {{ $kelas->firstItem() }} to {{ $kelas->lastItem() }} of {{ $kelas->total() }} entries
      @endif
    </div>
    <div class="col-auto text-right">
      {{ $kelas->links() }}
    </div>
  </div>
  <script>
    window.addEventListener('success', event => {
      toastr.success(event.detail.message);
    });
  </script> 
</div>