<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi GIS Wisata Kalimantan Tengah</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* NAVBAR */
        .navbar-custom {
            background: linear-gradient(135deg, #1e40af, #0284c7);
            padding: 16px 0;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.2);
        }
        .navbar-brand {
            color: #ffffff !important;
            font-size: 21px;
            font-weight: 800;
        }

        /* HERO HEADER */
        .hero {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.85), rgba(2, 132, 199, 0.85)), 
                        url("{{ asset('storage/wisata/wisata.jpg') }}");
            background-size: cover;
            background-position: center;
            padding: 50px 20px 80px 20px;
            color: white;
            text-align: center;
        }
        .hero h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* MAIN CONTAINER */
        .main-container {
            margin-top: -45px;
            position: relative;
            z-index: 10;
            padding-bottom: 50px;
        }

        /* STATS CARDS */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 20px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        /* FILTER & CONTROLS CARD */
        .filter-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .btn-bright {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 16px;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            white-space: nowrap;
            transition: all 0.2s ease;
        }
        .btn-bright:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        /* MAP CARD & SIDEBAR */
        .map-card {
            background: #ffffff;
            padding: 12px;
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        #map {
            height: 620px;
            border-radius: 18px;
            z-index: 1;
        }

        /* SIDEBAR LIST WISATA */
        .wisata-list-container {
            max-height: 620px;
            overflow-y: auto;
            padding-right: 6px;
        }
        .wisata-item-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .wisata-item-card:hover {
            border-color: #2563eb;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.12);
        }

        /* POPUP STYLING */
        .leaflet-popup-content-wrapper {
            border-radius: 20px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.22);
        }
        .leaflet-popup-content {
            margin: 0 !important;
            width: 310px !important;
        }
        .popup-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .popup-body {
            padding: 16px;
        }

        /* LEGEND */
        .legend {
            background: rgba(255, 255, 255, 0.95);
            padding: 12px 16px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            font-size: 12px;
        }
        .legend-title { font-weight: 800; margin-bottom: 6px; }
        .legend-item { display: flex; align-items: center; gap: 8px; margin-bottom: 3px; }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }

        /* REVIEWS SECTION */
        .reviews-section {
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
            padding: 14px 16px;
            max-height: 180px;
            overflow-y: auto;
        }

        footer { background: #0f172a; color: #94a3b8; text-align: center; padding: 24px; font-size: 13px; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-custom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/wisata">
            <i class="bi bi-compass-fill me-2 text-warning fs-4"></i> Wisata Kalteng GIS
        </a>
    </div>
</nav>

<!-- HERO HEADER -->
<section class="hero">
    <div class="container">
        <h1>Jelajahi Wisata Kalimantan Tengah</h1>
        <p>Eksplorasi destinasi alam, budaya, dan tempat populer melalui peta interaktif</p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="container main-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-3 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- STATISTIK RINGKASAN -->
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-map-fill"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Wisata</div>
                    <div class="fs-4 fw-bold text-dark" id="statTotalWisata">0</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-grid-fill"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Tampil di Peta</div>
                    <div class="fs-4 fw-bold text-dark" id="statFilteredWisata">0</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Status Sistem</div>
                    <div class="fs-6 fw-bold text-dark"><span class="badge bg-success rounded-pill">Aktif & Live</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER & ACTION BAR -->
    <div class="filter-card">
        <div class="row align-items-center g-2">
            <!-- Search -->
            <div class="col-lg-3 col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control border-start-0 bg-light" placeholder="Cari nama/alamat...">
                </div>
            </div>

            <!-- Select Kategori -->
            <div class="col-lg-3 col-md-4">
                <select id="filterKategori" class="form-select bg-light">
                    <option value="Semua">🌈 Semua Kategori</option>
                    <option value="Pantai">🏖️ Pantai</option>
                    <option value="Danau">🌊 Danau</option>
                    <option value="Cagar Alam">🌿 Cagar Alam</option>
                    <option value="Hotel">🏨 Hotel</option>
                    <option value="Restoran">🍽️ Restoran</option>
                    <option value="Religi">🕌 Religi</option>
                    <option value="Budaya">🏛️ Budaya</option>
                    <option value="Ikon Kota">🏙️ Ikon Kota</option>
                </select>
            </div>

            <!-- Tombol Geolocation -->
            <div class="col-lg-2 col-md-4">
                <button id="btnMyLocation" class="btn btn-outline-primary w-100 rounded-3">
                    <i class="bi bi-crosshair me-1"></i> Lokasi Saya
                </button>
            </div>

            <!-- Tombol Export CSV -->
            <div class="col-lg-2 col-md-6">
                <button id="btnExportCSV" class="btn btn-outline-success w-100 rounded-3">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export Data
                </button>
            </div>

            <!-- Tombol Tambah Data -->
            <div class="col-lg-2 col-md-6">
                <a href="/wisata/tambah" class="btn btn-bright w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>

    <!-- MAP & SIDEBAR LIST -->
    <div class="map-card">
        <div class="row g-2">
            <!-- Sidebar Daftar Wisata -->
            <div class="col-md-4 col-12 order-2 order-md-1">
                <div class="d-flex justify-content-between align-items-center p-2 mb-1">
                    <span class="fw-bold small text-secondary"><i class="bi bi-list-stars me-1"></i> Daftar Destinasi</span>
                    <button class="btn btn-sm btn-light border" id="btnResetView"><i class="bi bi-arrow-counterclockwise"></i> Reset View</button>
                </div>
                <div class="wisata-list-container" id="wisataList">
                    <!-- Dynamic List -->
                </div>
            </div>

            <!-- Peta Leaflet -->
            <div class="col-md-8 col-12 order-1 order-md-2">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <i class="bi bi-map me-1"></i> Sistem Informasi Wisata Kalimantan Tengah — GIS Leaflet & Laravel
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // 1. INISIALISASI PETA
    var defaultCenter = [-2.5337, 112.9497];
    var defaultZoom = 9;
    var map = L.map('map').setView(defaultCenter, defaultZoom);

    // 2. TILE LAYERS (PETA JALAN & SATELIT)
    var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri'
    });

    var baseMaps = {
        "🗺️ Peta Jalan": streetLayer,
        "🛰️ Peta Satelit": satelliteLayer
    };
    L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

    // 3. WARNA KATEGORI
    const warnaKategori = {
        'Pantai': '#0284c7',
        'Danau': '#2563eb',
        'Cagar Alam': '#10b981',
        'Hotel': '#8b5cf6',
        'Restoran': '#f97316',
        'Religi': '#eab308',
        'Budaya': '#ec4899',
        'Ikon Kota': '#ef4444'
    };

    function getIcon(kategori) {
        let warna = warnaKategori[kategori] || '#2563eb';
        return L.divIcon({
            className: 'custom-marker',
            html: `
                <div style="
                    background: linear-gradient(135deg, ${warna}, #0f172a);
                    width: 36px; height: 36px;
                    border-radius: 50% 50% 50% 0;
                    transform: rotate(-45deg);
                    display: flex; align-items: center; justify-content: center;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    border: 2px solid white;">
                    <i class="bi bi-geo-alt-fill" style="color: white; transform: rotate(45deg); font-size: 16px;"></i>
                </div>`,
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            popupAnchor: [0, -32]
        });
    }

    var userLocation = null;
    var markers = [];
    var dataWisata = [];

    // 4. MENGAMBIL DATA LARAVEL
    @foreach ($wisata as $w)
        var wisataData = {
            id: {{ $w->id }},
            nama: @json($w->nama_wisata),
            kategori: @json($w->kategori),
            alamat: @json($w->alamat),
            deskripsi: @json($w->deskripsi),
            foto: "{{ asset('storage/wisata/'.$w->foto) }}",
            lat: {{ $w->latitude }},
            lng: {{ $w->longitude }},
            ulasans: @json($w->ulasans)
        };
        dataWisata.push(wisataData);

        var marker = L.marker([wisataData.lat, wisataData.lng], {
            icon: getIcon(wisataData.kategori)
        });

        // POPUP MODAL LENGKAP
        var popupContent = `
            <div style="max-height: 420px; overflow-y: auto;">
                <img src="${wisataData.foto}" class="popup-image" onerror="this.style.display='none'">
                <div class="popup-body">
                    <span class="badge bg-primary-subtle text-primary mb-1">${wisataData.kategori}</span>
                    <h6 class="fw-bold mb-1">${wisataData.nama}</h6>
                    <small class="text-muted d-block mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i>${wisataData.alamat}</small>
                    <p class="small text-secondary mb-2">${wisataData.deskripsi}</p>
                    
                    <!-- TOMBOL PETUNJUK ARAH (RUTE GOOGLE MAPS) -->
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${wisataData.lat},${wisataData.lng}" 
                       target="_blank" class="btn btn-sm btn-primary w-100 py-1" style="font-size: 12px;">
                       <i class="bi bi-sign-turn-right-fill me-1"></i> Petunjuk Arah (Google Maps)
                    </a>
                </div>

                <!-- ULASAN SECTION -->
                <div class="reviews-section">
                    <div class="fw-bold mb-2 text-dark small"><i class="bi bi-chat-text-fill text-primary me-1"></i> Ulasan</div>
                    ${wisataData.ulasans && wisataData.ulasans.length > 0 ? 
                        wisataData.ulasans.map(u => `
                            <div class="p-2 bg-white rounded border mb-1">
                                <div class="d-flex justify-content-between">
                                    <strong style="font-size: 11px;">${u.nama_pengunjung}</strong>
                                    <span class="text-warning" style="font-size: 10px;">⭐ ${u.rating}</span>
                                </div>
                                <div class="text-secondary extra-small" style="font-size: 11px;">${u.komentar}</div>
                            </div>
                        `).join('') : '<div class="text-muted extra-small fst-italic">Belum ada ulasan.</div>'
                    }

                    <form action="/ulasan/store" method="POST" class="mt-2 pt-2 border-top">
                        @csrf
                        <input type="hidden" name="wisata_id" value="${wisataData.id}">
                        <input type="text" name="nama_pengunjung" class="form-control form-control-sm mb-1" placeholder="Nama..." required>
                        <select name="rating" class="form-select form-select-sm mb-1" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4">⭐⭐⭐⭐ (4)</option>
                            <option value="3">⭐⭐⭐ (3)</option>
                            <option value="2">⭐⭐ (2)</option>
                            <option value="1">⭐ (1)</option>
                        </select>
                        <textarea name="komentar" class="form-control form-control-sm mb-1" rows="2" placeholder="Ulasan..." required></textarea>
                        <button type="submit" class="btn btn-sm btn-dark w-100 py-1" style="font-size: 11px;">Kirim</button>
                    </form>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent);
        marker.wisataData = wisataData;
        marker.addTo(map);
        markers.push(marker);
    @endforeach

    // 5. RENDER SIDEBAR LIST
    function renderSidebar(data) {
        var container = document.getElementById('wisataList');
        container.innerHTML = '';
        document.getElementById('statFilteredWisata').innerText = data.length;

        if(data.length === 0) {
            container.innerHTML = '<div class="text-center text-muted p-4 small">Tidak ada lokasi wisata yang sesuai.</div>';
            return;
        }

        data.forEach(function(item) {
            var card = document.createElement('div');
            card.className = 'wisata-item-card';
            card.innerHTML = `
                <div class="d-flex align-items-center gap-3">
                    <img src="${item.foto}" style="width: 52px; height: 52px; border-radius: 12px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/50'">
                    <div style="flex: 1;">
                        <span class="badge bg-light text-primary fw-bold mb-1" style="font-size: 10px;">${item.kategori}</span>
                        <div class="fw-bold text-dark small" style="line-height: 1.2;">${item.nama}</div>
                        <small class="text-muted extra-small" style="font-size: 11px;">${item.alamat.substring(0, 28)}...</small>
                    </div>
                </div>
            `;
            card.addEventListener('click', function() {
                map.flyTo([item.lat, item.lng], 14, { duration: 1.5 });
                markers.forEach(function(m) {
                    if(m.wisataData.id === item.id) {
                        m.openPopup();
                    }
                });
            });
            container.appendChild(card);
        });
    }

    document.getElementById('statTotalWisata').innerText = dataWisata.length;
    renderSidebar(dataWisata);

    // 6. FILTER & SEARCH REAL-TIME
    function filterData() {
        var category = document.getElementById('filterKategori').value;
        var search = document.getElementById('searchInput').value.toLowerCase();

        var filtered = dataWisata.filter(function(item) {
            var matchCategory = (category === 'Semua' || item.kategori === category);
            var matchSearch = item.nama.toLowerCase().includes(search) || item.alamat.toLowerCase().includes(search);
            return matchCategory && matchSearch;
        });

        markers.forEach(function(m) {
            var isVisible = filtered.some(f => f.id === m.wisataData.id);
            if(isVisible) {
                m.addTo(map);
            } else {
                map.removeLayer(m);
            }
        });

        renderSidebar(filtered);
    }

    document.getElementById('filterKategori').addEventListener('change', filterData);
    document.getElementById('searchInput').addEventListener('input', filterData);

    // 7. FITUR GEOLOCATION
    document.getElementById('btnMyLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                userLocation = [position.coords.latitude, position.coords.longitude];
                map.flyTo(userLocation, 13);
                L.marker(userLocation).addTo(map)
                    .bindPopup('<b>📍 Lokasi Anda Saat Ini</b>')
                    .openPopup();
            }, function() {
                alert('Gagal mengambil lokasi GPS. Pastikan izin akses lokasi diaktifkan.');
            });
        }
    });

    // RESET VIEW
    document.getElementById('btnResetView').addEventListener('click', function() {
        map.flyTo(defaultCenter, defaultZoom);
        document.getElementById('searchInput').value = '';
        document.getElementById('filterKategori').value = 'Semua';
        filterData();
    });

    // 8. EXPORT CSV FUNCTION
    document.getElementById('btnExportCSV').addEventListener('click', function() {
        let csvContent = "data:text/csv;charset=utf-8,ID,Nama Wisata,Kategori,Alamat,Latitude,Longitude\n";
        dataWisata.forEach(function(row) {
            csvContent += `${row.id},"${row.nama}","${row.kategori}","${row.alamat}",${row.lat},${row.lng}\n`;
        });
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "daftar_wisata_kalteng.csv");
        document.body.appendChild(link);
        link.click();
    });

    // 9. CONTROL LEGENDA
    var legend = L.control({ position: 'bottomright' });
    legend.onAdd = function () {
        var div = L.DomUtil.create('div', 'legend');
        div.innerHTML = `<div class="legend-title">Kategori Wisata</div>`;
        for (var key in warnaKategori) {
            div.innerHTML += `
                <div class="legend-item">
                    <span class="legend-dot" style="background:${warnaKategori[key]}"></span>
                    <span>${key}</span>
                </div>`;
        }
        return div;
    };
    legend.addTo(map);
</script>

</body>
</html>