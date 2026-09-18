<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">
<title>Tambah Wisata</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
rel="stylesheet">

<style>
body {
background: linear-gradient(
to right,
#F7F3EE,
#E9DCCF
);
font-family: 'Segoe UI', sans-serif;
min-height: 100vh;
}
.container {
max-width: 850px;
}
.card {
border: none;
border-radius: 20px;
box-shadow:
0 8px 25px
rgba(92,64,51,.15);
overflow: hidden;
}
.card-header {
background:
linear-gradient(
90deg,
#8B6B4A,
#B08968
);
color: white;
padding: 20px;
}
.card-header h3 {
margin: 0;
font-weight: bold;
}
.form-label {
font-weight: 600;
color: #5C4033;
}
.form-control,
.form-select {
border-radius: 10px;

border: 1px solid #D8C3A5;
}
.form-control:focus,
.form-select:focus {
border-color: #8B6B4A;
box-shadow:
0 0 0 .2rem
rgba(139,107,74,.15);
}
.btn-brown {
background: #8B6B4A;
color: white;
border: none;
}
.btn-brown:hover {
background: #6F4E37;
color: white;
}
.location-info {
background: #F5ECE3;
border-radius: 12px;
padding: 15px;
color: #6F4E37;
font-size: 14px;
}
.coordinate-box {
background: #FAF7F3;
border: 1px dashed #B08968;
border-radius: 12px;
padding: 15px;
}
.preview {
width: 100%;
max-height: 250px;
object-fit: cover;
border-radius: 12px;
display: none;
margin-top: 10px;
}
</style>
</head>
<body>

<div class="container my-5">
<div class="card">
<div class="card-header">
<h3>
<i class="bi bi-geo-alt-fill"></i>
Tambah Data Wisata
</h3>
<small>
Sistem Informasi Wisata Kotawaringin Timur
</small>
</div>
<div class="card-body p-4">
@if ($errors->any())
<div class="alert alert-danger">
<strong>
Data belum dapat disimpan.
</strong>
<ul class="mb-0 mt-2">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="/wisata/store" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Input fields... -->
    
    <button type="submit" class="btn btn-primary">Simpan</button>
<!-- NAMA -->
<div class="mb-3">
<label class="form-label">
Nama Wisata
</label>
<input
type="text"
name="nama_wisata"
class="form-control"
placeholder="Contoh: Danau Biru"

value="{{ old('nama_wisata') }}"
required>
</div>
<!-- KATEGORI -->
<div class="mb-3">
<label class="form-label">
Kategori
</label>
<select name="kategori" class="form-select" required>
    <option value="">-- Pilih Kategori --</option>
    <option value="Pantai">Pantai</option>
    <option value="Danau">Danau</option>
    <option value="Cagar Alam">Cagar Alam</option>
    <option value="Hotel">Hotel</option>
    <option value="Restoran">Restoran</option>
    <option value="Wisata Religi & Tempat Ibadah">Wisata Religi & Tempat Ibadah</option>
    <option value="Wisata Budaya & Adat">Wisata Budaya & Adat</option>
    <option value="Ikon Kota & Wisata Modern">Ikon Kota & Wisata Modern</option>
    <option value="Transportasi & Akses">Transportasi & Akses</option>
</select>
</div>
<!-- ALAMAT -->
<div class="mb-3">
<label class="form-label">
Alamat
</label>
<textarea
name="alamat"

class="form-control"
rows="2"
placeholder="Contoh: Kelurahan Pasir Putih, Sampit"
required>{{ old('alamat') }}</textarea>
</div>
<!-- DESKRIPSI -->
<div class="mb-3">
<label class="form-label">
Deskripsi Wisata
</label>
<textarea
name="deskripsi"
class="form-control"
rows="4"
placeholder="Tuliskan informasi tentang wisata..."
required>{{ old('deskripsi') }}</textarea>
</div>
<!-- FOTO -->
<div class="mb-4">
<label class="form-label">
<i class="bi bi-image"></i>
Foto Wisata
</label>
<input
type="file"
name="foto"
id="foto"
class="form-control"
accept="image/*">
<small class="text-muted">
Format JPG, JPEG, PNG, atau WEBP.
Maksimal 2 MB.
</small>
<img
id="preview"
class="preview">
</div>
<!-- KOORDINAT -->
<div class="coordinate-box mb-4">
<h6 class="fw-bold"

style="color:#5C4033">
<i class="bi bi-pin-map-fill"></i>
Lokasi GIS
</h6>
<div class="location-info mb-3">
Masukkan koordinat lokasi wisata.
Latitude dan longitude digunakan
untuk menampilkan marker pada peta.
</div>
<div class="row">
<div class="col-md-6 mb-3 mb-md-0">
<label class="form-label">
Latitude
</label>
<input
type="number"
step="any"
name="latitude"
class="form-control"
placeholder="-2.xxxxx"
value="{{ old('latitude') }}"
required>
</div>
<div class="col-md-6">
<label class="form-label">
Longitude
</label>
<input
type="number"
step="any"
name="longitude"
class="form-control"
placeholder="112.xxxxx"
value="{{ old('longitude') }}"
required>
</div>
</div>
</div>
<!-- Rating -->
<div class="mb-3">
    <label for="rating" class="form-label font-weight-bold">Rating Wisata</label>
    <select name="rating" id="rating" class="form-select" required>
        <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Bagus)</option>
        <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
        <option value="3">⭐⭐⭐ (3 - Cukup)</option>
        <option value="2">⭐⭐ (2 - Kurang)</option>
        <option value="1">⭐ (1 - Buruk)</option>
    </select>
</div>

<!-- Ulasan -->
<div class="mb-3">
    <label for="ulasan" class="form-label font-weight-bold">Ulasan / Review</label>
    <textarea name="ulasan" id="ulasan" class="form-control" rows="3" placeholder="Tulis ulasan ringkas mengenai tempat ini..."></textarea>
</div>
<!-- BUTTON -->
<div class="d-flex justify-content-between">
<a
href="/wisata"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>
Kembali
</a>
<button
type="submit"
class="btn btn-brown px-4">
<i class="bi bi-save"></i>
Simpan Wisata
</button>
</div>
</form>
</div>
</div>
</div>
<script>
document
.getElementById('foto')
.addEventListener('change', function(event) {
const file =
event.target.files[0];
const preview =
document.getElementById('preview');
if(file) {
preview.src =
URL.createObjectURL(file);
preview.style.display =
'block';
}
else {
preview.style.display =
'none';
}
});
</script>
</body>
</html>