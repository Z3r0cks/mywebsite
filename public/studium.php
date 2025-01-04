<?php
require '../includes/auth.php';
// require '../includes/db_connect.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - Medieninformatik</title>
   <link rel="stylesheet" href="./style.css">
   <script src="./js/accordion.js" defer></script>
   <script src="./js/download_page.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body>
   <a href="logout.php">Abmelden</a>
   <a href="dashboard.php">Zurück</a>
   <a href="#" pdfName="experience_patrick_kaserer" id="downloadPdf">Download als PDF </a>
   <div class="container_dashboard">
      <h1>Medieninformatik</h1>
   </div>
</body>

</html>