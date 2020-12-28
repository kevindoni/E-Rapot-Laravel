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
            <th>Semester</th>
            <th>Tahun</th>
            <th>Kepala Sekolah</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if ($tahun->count() > 0)
            @foreach ($tahun as $val => $data)
              <tr>
                <td>{{ $val + $tahun->firstitem() }}</td>
                <td>{{ $data->semester }}</td>
                <td>
                  @if ($data->semester == "Ganjil")
                    {{ $data->tahun . "/" . ($data->tahun + 1) }}
                  @else
                    {{ ($data->tahun - 1) . "/" . $data->tahun }}
                  @endif
                </td>
                <td>
                  <h5 class='card-title'>{{ $data->kpl_sklh }}</h5>
                  <p class='card-text'><small class='text-muted'>{{ $data->nip_kespek }}</small></p>
                </td>
                <td class="text-center">
                  @if ($data->status == 'Tidak Aktif')
                      <span class="badge badge-danger">{{ $data->status }}</span>
                  @else
                      <span class="badge badge-success">{{ $data->status }}</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('tahun.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                  <a href="{{ route('tahun.show', $data->id) }}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-star"></i> &nbsp; Aktifkan</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6" class="text-center">Data Mapel Tidak Ada!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <div class="row mt-2 align-items-center">
    <div class="col" style="margin-bottom: 1rem;">
      @if ($tahun->total() > 0)
        Showing {{ $tahun->firstItem() }} to {{ $tahun->lastItem() }} of {{ $tahun->total() }} entries
      @endif
    </div>
    <div class="col-auto text-right">
      {{ $tahun->links() }}
    </div>
  </div>  
</div>
