<?php
require_once 'classes/Controller.php';

$controller = new Controller();

// Koordinat Gedung JTI Polije
$lat  = -8.157654;
$long = 113.722846;

$weather = $controller->getWeather($lat, $long);
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Info Cuaca</h1>
    <span class="badge badge-info px-3 py-2">
        <i class="fas fa-map-marker-alt"></i>
        Lat: <?= $lat ?> | Lon: <?= $long ?>
    </span>
</div>

<?php if (isset($weather['error'])): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i>
        Gagal mengambil data: <?= htmlspecialchars($weather['error']) ?>
    </div>

<?php elseif (isset($weather['status']) && $weather['status'] == 'success'): ?>
    <?php $cw = $weather['data']; ?>

    <!-- Info Lokasi -->
    <div class="alert alert-info mb-4">
        <i class="fas fa-location-arrow"></i>
        <strong>Lokasi:</strong> <?= htmlspecialchars($cw['location']) ?>
    </div>

    <!-- Cards Cuaca -->
    <div class="row">
        <?php foreach ($cw['forecast'] as $data): ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between
                    <?= $data['temperature'] >= 30 ? 'bg-danger text-white' : ($data['temperature'] >= 26 ? 'bg-warning' : 'bg-primary text-white') ?>">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-cloud-sun mr-1"></i>
                        <?= htmlspecialchars($data['weather']) ?>
                    </h6>
                    <span class="badge badge-light">
                        <?= htmlspecialchars($data['local_datetime']) ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h1 class="display-4 font-weight-bold text-gray-800">
                            <?= $data['temperature'] ?> °C
                        </h1>
                    </div>
                    <hr>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-tint text-info mr-2"></i>
                            <strong>Kelembaban:</strong> <?= htmlspecialchars($data['humidity']) ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-wind text-primary mr-2"></i>
                            <strong>Kecepatan Angin:</strong> <?= htmlspecialchars($data['wind_speed']) ?>
                        </li>
                        <li>
                            <i class="fas fa-compass text-success mr-2"></i>
                            <strong>Arah Angin:</strong> <?= htmlspecialchars($data['wind_direction']) ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <div class="alert alert-warning">
        <i class="fas fa-info-circle"></i> Data cuaca tidak tersedia.
    </div>
<?php endif; ?>
