<?php
// 1. Setup Environment and Security
date_default_timezone_set("Asia/Kuala_Lumpur");

$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "YOUR_DATABASE_PASSWORD"; // Ensure this is your actual password
$db_name = "pims_db"; 

// 2. Initialize Secure Azure SSL Connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
$success = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);

if (!$success) {
    die("Connection failed: " . mysqli_connect_error());
}

// 3. Helper Functions
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

// 4. Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = sanitizeInput($conn, $_POST['fname']);
    $nomatric = sanitizeInput($conn, $_POST['lname']);
    $telephoneno = sanitizeInput($conn, $_POST['telephone']);
    $roomno = sanitizeInput($conn, $_POST['room']);

    // Check limit
    $limitQuery = "SELECT COUNT(*) AS total FROM ramadhan";
    $limitResult = mysqli_query($conn, $limitQuery);
    $limitData = mysqli_fetch_assoc($limitResult);
    $currentCount = (int) $limitData['total'];

    if ($currentCount >= 30) {
        echo "<script>alert('Ralat: Had 30 tempahan telah dipenuhi.');</script>";
    } else {
        $query = "INSERT INTO ramadhan (fullname, nomatric, telephoneno, roomno) VALUES ('$fullname', '$nomatric', '$telephoneno', '$roomno')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Tempahan berjaya dihantar!');</script>";
        } else {
            echo "<script>alert('Ralat Pangkalan Data.');</script>";
        }
    }
}

// 5. Fetch Data for Table
$sql = "SELECT * FROM ramadhan";
$table_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tempahan Iftar | PIMS</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files (Fixed Backslashes for Azure) -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; color: #1e293b; }
    #header { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .card { background: #fff; border: none; border-radius: 16px; padding: 40px; max-width: 900px; margin: 120px auto; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .submit-button { background-color: #3b82f6; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 600; width: 100%; transition: 0.3s; }
    .submit-button:hover { background-color: #2563eb; transform: translateY(-2px); }
    table { width: 100%; margin-top: 40px; border-radius: 12px; overflow: hidden; }
    th { background-color: #f1f5f9; font-weight: 700; padding: 15px; }
    td { padding: 15px; border-bottom: 1px solid #e2e8f0; }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top py-3">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo h4 m-0 fw-bold text-primary"><a href="index.php">PIMS PBU</a></h1>
      <nav id="navbar" class="navbar">
        <ul class="d-flex list-unstyled m-0">
          <li><a class="nav-link px-3" href="index.php">Utama</a></li>
          <li><a class="nav-link px-3" href="activity.php">Menu PIMS</a></li>
          <li><a class="nav-link px-3" href="infaq.php">Sumbangan</a></li>
          <li><a class="btn btn-danger btn-sm ms-3 text-white px-3" href="#" id="logout-btn">Log Keluar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="card" data-aos="fade-up">
    <div class="text-center mb-4">
        <img src="assets/img/pimslogo.png" alt="Logo" style="width: 80px;">
        <h2 class="fw-bold mt-3">TEMPAHAN IFTAR PELAJAR</h2>
        <p class="text-muted">Sistem 'First come, first serve'. Had maksima: 30 orang.</p>
    </div>

    <form id="reservation-form" method="POST">
      <div class="mb-3">
        <label class="form-label fw-bold">NAMA PENUH</label>
        <input type="text" name="fname" class="form-control" placeholder="Contoh: Sufiana Adlin" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">NO KAD MATRIK</label>
        <input type="text" name="lname" class="form-control" placeholder="Contoh: B032410816" required>
      </div>

      <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">NO TELEFON</label>
            <input type="text" name="telephone" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">NO BILIK</label>
            <input type="text" name="room" class="form-control" required>
          </div>
      </div>

      <div class="text-center mt-4">
        <p class="small text-danger"><b>* Sila semak semula data anda sebelum menghantar *</b></p>
        <input type="submit" class="submit-button" value="HANTAR TEMPAHAN">
      </div>
    </form>

    <div class="table-responsive">
        <?php if (mysqli_num_rows($table_result) > 0): ?>
          <table class="table mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penuh</th>
                    <th>No Matrik</th>
                    <th>No Bilik</th>
                </tr>
            </thead>
            <tbody>
              <?php $count = 1; while ($row = mysqli_fetch_assoc($table_result)): ?>
                <tr>
                  <td><?= $count++ ?></td>
                  <td><?= htmlspecialchars($row['fullname']) ?></td>
                  <td><?= htmlspecialchars($row['nomatric']) ?></td>
                  <td><?= htmlspecialchars($row['roomno']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p class="mt-5 text-muted">Tiada data tempahan setakat ini.</p>
        <?php endif; ?>
    </div>
  </div>

  <script src="assets/vendor/aos/aos.js"></script>
  <script>
    AOS.init();
    
    document.getElementById("logout-btn").addEventListener("click", function(e) {
      e.preventDefault();
      if (confirm("Adakah anda pasti untuk log keluar?")) {
        window.location.href = "logout.php";
      }
    });
  </script>
</body>
</html>
<?php mysqli_close($conn); ?>