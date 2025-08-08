<?php
require './includes/auth.php';
require './includes/db_connect.php';

if (isset($_SESSION['is_guest']) && $_SESSION['is_guest'] === true) {
    header('Location: dashboard');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - Zeitstrahl</title>
   <link rel="stylesheet" href="./style.css">
   <!-- <script src="./js/language.js" defer></script> -->
   <script src="./js/download_page.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <div class="nav">
      <a href="logout"><button class="btn btn--main btn--nav" lang="de" data-translate="nav.logout">Abmelden</button></a>
      <a href="dashboard"><button class="btn btn--main btn--nav" lang="de" data-translate="nav.back">Zurück</button></a>
      <a href="#" pdfName="timeline_patrick_kaserer" id="downloadPdf"><button class="btn btn--main btn--nav" lang="de" data-translate="nav.download_pdf">Download als PDF</button></a>
   </div>

   <div class="container_dashboard">
      <h1 lang="de" data-translate="timeline.title">Timeline</h1>
      <p class="timeline-intro" lang="de" data-translate="timeline.intro">Mein Weg von der Logistik zur Informatik – ein umfassender Überblick über meine berufliche Entwicklung, Ausbildung und wichtige Meilensteine.</p>

      <div class="timeline-container">
         <div class="timeline-section">
            <!-- Chronologische Timeline: Neueste zuerst -->


            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">03/25 - 08/25</div>
               <div class="timeline-content">
                  <h3>Fullstack Softwareentwickler/KI</h3>
                  <h4>Webbasierte Logistikplattform</h4>
                  <p class="timeline-description">Echtzeitvisualisierung und -steuerung des Materialflusses, Prototyping KI-gestützter Komponenten (z. B. Materialflussrechner), Mitarbeit an Forschungsprojekten.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Full Stack Entwicklung</span>
                     <span class="timeline-tag">Konzeption</span>
                     <span class="timeline-tag">Neuronale Netze</span>
                     <span class="timeline-tag">C#</span>
                     <span class="timeline-tag">vue.js</span>
                     <span class="timeline-tag">Python</span>
                     <span class="timeline-tag">MSSQL</span>
                     <span class="timeline-tag">Git</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">09/22 - 03/25</div>
               <div class="timeline-content">
                  <h3>M.Sc. Medieninformatik</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Schwerpunkt: Computer Vision, Deep Learning und wissenschaftliches Arbeiten.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">NeRF</span>
                     <span class="timeline-tag">Deep Learning</span>
                     <span class="timeline-tag">Computer Vision</span>
                     <span class="timeline-tag">Gameentwicklung</span>
                     <span class="timeline-tag">Python</span>
                     <span class="timeline-tag">C#</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">07/24 - 03/25</div>
               <div class="timeline-content">
                  <h3>Masterthesis</h3>
                  <h4>Sick AG/ Hochschule Furtwangen</h4>
                  <p class="timeline-description">Synthesized Sensor Data from Neural Radiance Fields</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Neural Radiance Fields</span>
                     <span class="timeline-tag">Wissenschaftliches Arbeiten</span>
                     <span class="timeline-tag">Neuronale Netze</span>
                     <span class="timeline-tag">Git</span>
                     <span class="timeline-tag">Python</span>
                     <span class="timeline-tag">PyTorch</span>
                     
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">09/21 - 08/23</div>
               <div class="timeline-content">
                  <h3>Hochschullehre</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Lehre „Creative Coding“ für die Studiengänge Medienkonzeption Semester 1 und 2. Curriculumentwicklung, Inhaltserstellung, Prüfungen, Teamleitung.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Lehre</span>
                     <span class="timeline-tag">Curriculum</span>
                     <span class="timeline-tag">Führung</span>
                     <span class="timeline-tag">Konzeption</span>
                     <span class="timeline-tag">IoT</span>
                     <span class="timeline-tag">Webentwicklung</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">10/22 - 07/23</div>
               <div class="timeline-content">
                  <h3>Vorsitz Studierendenschaft</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Vorsitzender des allgemeinen Studierendenschaft (AstA), des Studierendenrats und der verfassten Studierendenschaft. Leitung und Koordination, Vertretung der Studierendenschaft, Entscheidngungsfindung und Strategieentwicklung, Konfliktmanagement, Förderung von Studierendenbelangen und Teamführung</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Strategie</span>
                     <span class="timeline-tag">Organisation</span>
                     <span class="timeline-tag">Führung</span>
                     <span class="timeline-tag">Hochschulpolitik</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">09/12 - 08/22</div>
               <div class="timeline-content">
                  <h3>B.Sc. Medieninformatik</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Fokus Webwareentwicklung, Projektmanagement, Netzwerke, Computergrafik und Wirtschaft.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Webentwicklung</span>
                     <span class="timeline-tag">Agiles Projektmanagement</span>
                     <span class="timeline-tag">Java</span>
                     <span class="timeline-tag">Python</span>
                     <span class="timeline-tag">Netze</span>
                     <span class="timeline-tag">Produktmanagement</span>
                     <span class="timeline-tag">Wirtschaft und Ökonomie</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2020 - 2021</div>
               <div class="timeline-content">
                  <h3>Projekt „Blind MeetUp“</h3>
                  <h4>Anonyme Social-Plattform</h4>
                  <p class="timeline-description">Leitung, Entwicklung & Projektmanagement (Scrum) in einem 6-köpfigen Team.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Scrum</span>
                     <span class="timeline-tag">Full Stack</span>
                     <span class="timeline-tag">React</span>
                     <span class="timeline-tag">Webentwicklung</span>
                     <span class="timeline-tag">Führung</span>
                  </div>
               </div>
            </div>


            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2016 - 2018</div>
               <div class="timeline-content">
                  <h3>Fachabitur</h3>
                  <h4>Berufliche Neuorientierung</h4>
                  <p class="timeline-description">Fachhochschulreife als Grundlage für das Hochschulstudium.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Neuorientierung</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2012 - 2016</div>
               <div class="timeline-content">
                  <h3>Fachkraft für Lagerlogistik</h3>
                  <h4>Diverse Unternehmen</h4>
                  <p class="timeline-description">Einblicke in Prozesse, Organisation und Teamkoordination.</p>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2008 - 2011</div>
               <div class="timeline-content">
                  <h3>Ausbildung – Fachkraft für Lagerlogistik</h3>
                  <h4>Berufsausbildung</h4>
                  <p class="timeline-description">Qualitätsmanagement und systematische Prozesse.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>