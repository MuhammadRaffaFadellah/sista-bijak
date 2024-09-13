@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('import.data') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="your_file" class="form-label" style="font-weight:700;">Pilih File Excel</label>
        <input type="file" class="form-control" id="your_file" name="your_file" accept=".xlsx, .xls">
    </div>
    <button type="submit" class="btn btn-edit">Impor Data</button>
  </form>