<?php
require '../includes/auth.php';
// require '../includes/db_connect.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - Experience</title>
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
      <h1>Meine Erfahrungen</h1>
      <button class="accordion mb-1">Praktisches Studiensemester - dreiQbik"</button>
      <div class="panel">
         <p style="text-align: justify;"> Während des Bachelors absolvierte ich mein Praktisches Studiensemester bei der Webagentur dreiQbik Karlsruhe. Schwerpunkt war die Fullstack-Entwicklung von indiduellen Webanwendungen für Unternehmen. Der USP war die Verwendung von CMS WordPress als Backend auf dem die individuelle Webanwendung entwickelt wurde. Hierbei wurde WordPress nicht verwendet um die Anwendung über das CMS wie ein Baukasten zu füllen, sondern WordPress diente als Backend auf dem die individuelle Webanwendung entwickelt wurde. Der Kunde konnte anschließend mit für ihn entwickelten Custom-Fields die Inhalte selbst befüllen. <br> Während des Praktikums von sechs Monaten, wurde ich in allen Prozessen der Entwicklung mit einbezogen und gefordert. Von der Kundenakquise, Kundengespräche, Projektmanagement, Back- und Frontendentwicklung bis zu Deployment der entsprechenden Software.</p>

         <video class="mr-2" style="clear:left; float: left" width="720" autoplay controls loop muted>
            <source src="./assets/videos/exp1.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify;">Während des Praktikums von sechs Monaten, wurde ich in allen Prozessen der Entwicklung mit einbezogen und gefordert. Von der Kundenakquise, Kundengespräche, Projektmanagement, Back- und Frontendentwicklung bis zu Deployment der entsprechenden Software. Bei einem Relaunch einer Website von GoSilico, haben ein weiterer Praktikant und ich den Großteil der Prozesses übernommen. Neben den Standardtools der Fullstack Webentwicklung, durfte ich hier viele Kenntnisse der Softwareentwicklung kennenlernen. Ich wurde Aktiv in alle Prozesse integriert und konnte auch Erfahrungen im Management und der Oranisation sammeln.</p>
      </div>
      <button class="accordion mb-1">Projektstudium - Website: "Blind MeetUp"</button>
      <div class="panel">
         <p style="text-align: justify;">Die Hochschule Furtwangen ist als Hochschule für angewande Wissenschaften eine praktisch orientierte Hochschule. Alle Studiengänge in der Fakutltät musste ein Projektstudium absolvieren, was sich über zwei Semester zieht. Hierbei geht es darum die gelernten Inhalte in einem eigenen, von den Studierenden entwickelten Projekt unter Beweis zu stellen. In einem 6-Köpfigen Team wurden hier die eigenes konzipierte Webanwendung "Blind MeetUp" entwickelt. Die Idee dahinter war, eine Plattform für Studierende der Hochschule anzubieten, bei denen sich die Studierenden anonym zu zweit oder in Gruppen treffen können.</p>

         <video class="ml-2" style="clear:right; float: right" width="720" controls>
            <source src="./assets/videos/ImageVideo_Final.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify;">Im Projekt war ich für die Entwicklung der Anwendung und mit einem weiteren Komilitonen für das Projektmanagement mit Scrum verantwortlich. Auch wenn das Projekt durch einen Professor unterstützt wurde, oblag die Verantwortlichkeit für die Idee, das Konzept, Marketing, Entwicklung und Deployment den Stuiderenden. Durch die Corona-Pandemie wurde das Projekt leider nie released.</p>
      </div>
      <button class="accordion">Bachelorthesis - Implementierung eines Buchungssystems und dessen
         Algorithmus auf Basis einer Immobilienverwaltungsumgebung</button>
      <div class="panel">
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis nesciunt quod rem temporibus vero adipisci omnis libero. Distinctio, asperiores? Corporis soluta cum et modi ullam animi ex maiores, quod culpa!
            Nemo reprehenderit saepe deserunt recusandae voluptatibus. Vero quidem corrupti, praesentium, ea recusandae culpa repellat debitis facere reiciendis iste, nihil quas velit ipsam et! Eius, quia nam. Eveniet fugit unde in.
            Cum assumenda quisquam ullam, numquam porro molestiae officia expedita nesciunt quis temporibus. Accusamus error quae aut quo recusandae vitae, distinctio est, quam sint molestias, fuga doloribus quisquam nisi dolor voluptatum!</p>
      </div>
   </div>
</body>

</html>