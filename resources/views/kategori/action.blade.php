<div class="btn-group">
    <a href="{{ route($route, ['kategori' => $kategori_id]) }}" class="btn btn-sm btn-primary">Edit</a>
    <button type="button" class="btn btn-sm btn-danger" onclick="deleteKategori({{ $kategori_id }})">Delete</button>
</div>
