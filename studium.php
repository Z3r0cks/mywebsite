<?php
require './includes/auth.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - Medieninformatik</title>
   <link rel="stylesheet" href="./style.css">
   <script src="./js/accordion.js" defer></script>
   <script src="./js/download_page.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <div class="nav">
      <a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
      <a href="dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
      <a href="#" pdfName="experience_patrick_kaserer" id="downloadPdf"><button class="btn btn--main btn--nav">Download als PDF </button></a>
   </div>
   <div class="container_dashboard">
      <h1>Medieninformatik</h1>
      <div class="container_dashboard">
         <img src="./assets/img/mi.png" width="100%" alt="illustrated image of computer science" class="mi__img--first">
         <p class="mb-2" style="text-align: justify;">Medieninformatik ist ein interdisziplinärer Informatikstudiengang, welcher es erlaubt, in vielen Bereichen einen Einblick zu bekommen und sich anschließend auf Gebiete zu vertiefen, für die Interesse besteht.<br> Die Schwerpunkte der Studiengänge (Bachelor und Master) lagen in den Bereichen Informatik, Medien und Wirtschaft.</p>
         <img src="./assets/img/mi2.png" style="margin-bottom: 2rem;" width="75%" alt="illustrated image of computer science" class="mi__img--second">
         <p style="text-align: justify;">Viele Arbeitsbereiche wurden in den letzten Jahrzehnten in Spezialisierungen unterteilt. Das beste Beispiel wäre der Beruf des Arztes, bei dem der Wissensstand so groß ist, dass eine Person nicht in allen Bereichen ein Spezialist sein kann. Auch wenn dies ein extremes Beispiel darstellt, denn als Medieninformatiker kann ich sehr wohl alle Bereiche der anderen Spezialisierungen lernen, ist dies der Grund für die Spezialisierung zum Medieninformatiker. <br>
         Der Unterschied zum allgemeinen Informatiker sind die Vertiefungen der Studiengänge. Während bei der allgemeinen Informatik eine Vertiefung in den Kernelementen der Informationsverarbeitung liegt, liegen die Vertiefungen bei Medieninformatik beim Erstellen von Anwendungen, dem Verstehen von Computergrafik, dem Verhalten künstlicher Intelligenz und wie diese die Welt betrachtet erfassen und verstehen kann, als auch bei den Nebenbereichen, den Markt und das Produkt zu verstehen, zu führen und zu organisieren. Da mein Interesse nicht darin liegt, z. B. mit Assembly nahe der Maschinensprache neue Programmiersprachen zu entwickeln, sondern ich anwendungsorientiert und wissenschaftlich entwickeln möchte, war die Wahl Medieninformatik passender für mich, zumal die Nebenbereiche für mich ebenfalls relevant waren. Bedeutet jedoch nicht, dass jemand, der allgemeine Informatik studiert hat, nicht ebenfalls die Inhalte des Medieninformatikers lernen kann oder umgekehrt. So habe ich selbst auch schon nahe der Maschinensprache programmieren dürfen. Ich bezeichne mich durch und durch als Informatiker. Ich betrachte meine Aufgabenbereiche nicht nur beim Erstellen von Software, auch wenn mir Programmieren sehr viel Spaß macht, sondern auch, um die Prozesse dahinter zu verstehen. Nicht nur beim Projektmanagement, sondern auch bei den wirtschaftlichen, wissenschaftlichen und soziologischen Aspekten dahinter.</p>
      </div>
   </div>
</body>

</html>