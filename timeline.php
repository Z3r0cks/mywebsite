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
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
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
         
         <!-- Education Phase -->
         <div class="timeline-section">
            <h2 class="timeline-section-title" lang="de" data-translate="timeline.education_title">Ausbildung & Akademische Entwicklung</h2>
            
            <div class="timeline-item timeline-item--education">
               <div class="timeline-date">09/22 - 03/25</div>
               <div class="timeline-content">
                  <h3>M.Sc. Medieninformatik</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Spezialisierung auf Neuronale Netze und Deep Learning. Masterarbeit zum Thema „Synthesised Sensor Data from Neural Radiance Fields“. Voraussichtlicher Abschluss: Januar/Februar 2025.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Neuronale Netze</span>
                     <span class="timeline-tag">Deep Learning</span>
                     <span class="timeline-tag">Forschung</span>
                     <span class="timeline-tag">NeRF</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--education">
               <div class="timeline-date">2018 - 2022</div>
               <div class="timeline-content">
                  <h3>B.Sc. Medieninformatik</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Erfolgreich abgeschlossenes Bachelorstudium mit Fokus auf Softwareentwicklung, Projektmanagement und angewandte Informatik. Fundierte Kenntnisse in Programmierung, Webentwicklung und Mensch-Computer-Interaktion.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Softwareentwicklung</span>
                     <span class="timeline-tag">Webtechnologien</span>
                     <span class="timeline-tag">Projektmanagement</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--education">
               <div class="timeline-date">2016 - 2018</div>
               <div class="timeline-content">
                  <h3>Fachabitur</h3>
                  <h4>Phase der beruflichen Neuorientierung</h4>
                  <p class="timeline-description">Strategische Entscheidung für ein Studium nach Berufserfahrung. Erfolgreich erworbene Fachhochschulreife als Grundlage für das Hochschulstudium.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Berufswechsel</span>
                     <span class="timeline-tag">Selbstentwicklung</span>
                  </div>
               </div>
            </div>
         </div>

         <!-- Professional Experience Phase -->
         <div class="timeline-section">
            <h2 class="timeline-section-title">Berufserfahrung</h2>
            
            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2020 - aktuell</div>
               <div class="timeline-content">
                  <h3>Lehrbeauftragter</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Lehre der Fächer „Creative Coding“ und „Interaktive Medienentwicklung“ für Erst- und Zweitsemester. Verantwortlich für Curriculumentwicklung, Inhaltserstellung, Prüfungsdesign und Teamleitung.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Hochschullehre</span>
                     <span class="timeline-tag">Curriculumentwicklung</span>
                     <span class="timeline-tag">Teamleitung</span>
                     <span class="timeline-tag">Creative Coding</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2021</div>
               <div class="timeline-content">
                  <h3>Praktikum – Full Stack Developer</h3>
                  <h4>dreiQbik Webagentur, Karlsruhe</h4>
                  <p class="timeline-description">Praxissemester mit Schwerpunkt Full-Stack-Webentwicklung. Entwicklung individueller Webanwendungen mit WordPress als Backend. Beteiligung am gesamten Projektzyklus von der Kundenakquise bis zum Deployment.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Full Stack Entwicklung</span>
                     <span class="timeline-tag">WordPress</span>
                     <span class="timeline-tag">Kundenmanagement</span>
                     <span class="timeline-tag">Projektmanagement</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2018 - 2020</div>
               <div class="timeline-content">
                  <h3>Studentische Hilfskraft</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Unterstützung von Erstsemestern in Programmiergrundlagen und interaktiver Medienentwicklung. Betreuung bei praktischen Aufgaben zu IoT und Webtechnologien.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Mentoring</span>
                     <span class="timeline-tag">Programmieraubildung</span>
                     <span class="timeline-tag">IoT</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2012 - 2016</div>
               <div class="timeline-content">
                  <h3>Fachkraft für Lagerlogistik</h3>
                  <h4>Diverse Unternehmen</h4>
                  <p class="timeline-description">Berufserfahrung in Logistik und Lagerverwaltung. Wertvolle Einblicke in Geschäftsprozesse, Organisation und Teamkoordination, die später meine Herangehensweise an Softwareprojekte beeinflussten.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Prozessoptimierung</span>
                     <span class="timeline-tag">Teamkoordination</span>
                     <span class="timeline-tag">Betriebsabläufe</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--work">
               <div class="timeline-date">2009 - 2012</div>
               <div class="timeline-content">
                  <h3>Ausbildung – Fachkraft für Lagerlogistik</h3>
                  <h4>Berufsausbildung</h4>
                  <p class="timeline-description">Dreijährige Berufsausbildung zur Fachkraft für Lagerlogistik. Grundlagen in systematischen Arbeitsprozessen, Qualitätsmanagement und beruflicher Verantwortung.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Berufsausbildung</span>
                     <span class="timeline-tag">Qualitätsmanagement</span>
                     <span class="timeline-tag">Systematische Prozesse</span>
                  </div>
               </div>
            </div>
         </div>

         <!-- Leadership & Projects Phase -->
         <div class="timeline-section">
            <h2 class="timeline-section-title">Führung & Schlüsselprojekte</h2>
            
            <div class="timeline-item timeline-item--leadership">
               <div class="timeline-date">2023 - aktuell</div>
               <div class="timeline-content">
                  <h3>Vorsitz Studierendenschaft</h3>
                  <h4>Hochschule Furtwangen</h4>
                  <p class="timeline-description">Leitung der verfassten Studierendenschaft mit Vertretung von tausenden Studierenden. Verantwortlich für strategische Entscheidungen, Ressourcenverteilung und Organisationsoptimierung.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Strategische Führung</span>
                     <span class="timeline-tag">Studierendenvertretung</span>
                     <span class="timeline-tag">Ressourcenmanagement</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--project">
               <div class="timeline-date">2022 - 2023</div>
               <div class="timeline-content">
                  <h3>Forschungsprojekt – „Frühstücks-Checks“</h3>
                  <h4>KI-gestütztes Lebensmittelerkennungssystem</h4>
                  <p class="timeline-description">Entwicklung einer Webanwendung mit Convolutional Neural Networks zur Lebensmittelerkennung und Augmented-Reality-Visualisierung. Erstellung eigener Trainingsdaten und Implementierung von WebSocket-Kommunikation zwischen Frontend und KI-Server.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Maschinelles Lernen</span>
                     <span class="timeline-tag">TensorFlow</span>
                     <span class="timeline-tag">Augmented Reality</span>
                     <span class="timeline-tag">WebSockets</span>
                  </div>
               </div>
            </div>

            <div class="timeline-item timeline-item--project">
               <div class="timeline-date">2020 - 2021</div>
               <div class="timeline-content">
                  <h3>Projektstudium – „Blind MeetUp“</h3>
                  <h4>Anonyme Social-Plattform für Studierende</h4>
                  <p class="timeline-description">Leitung von Entwicklung und Projektmanagement in einem sechsköpfigen Team zur Erstellung einer anonymen Meeting-Plattform für Studierende. Einführung der Scrum-Methodik und Betreuung des gesamten Entwicklungszyklus.</p>
                  <div class="timeline-highlights">
                     <span class="timeline-tag">Teamleitung</span>
                     <span class="timeline-tag">Scrum</span>
                     <span class="timeline-tag">Full Stack Entwicklung</span>
                     <span class="timeline-tag">Social-Plattform</span>
                  </div>
               </div>
            </div>
         </div>

         <!-- Skills Evolution -->
         <div class="timeline-section">
            <h2 class="timeline-section-title">Technologische Fähigkeiten im Wandel</h2>
            
            <div class="timeline-skills">
               <div class="skill-category">
                  <h3 lang="de" data-translate="timeline.skills.programming_title">Programmiersprachen</h3>
                  <div class="skill-timeline">
                     <div class="skill-item">
                        <span class="skill-name">Java-, TypeScript</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 90%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">Python</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 85%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">PHP</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 80%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">C++</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 75%;"></div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="skill-category">
                  <h3 lang="de" data-translate="timeline.skills.ai_title">KI & Maschinelles Lernen</h3>
                  <div class="skill-timeline">
                     <div class="skill-item">
                        <span class="skill-name">TensorFlow</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 85%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">Neuronale Netze</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 88%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">Deep Learning</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 82%;"></div>
                        </div>
                     </div>
                     <div class="skill-item">
                        <span class="skill-name">Machinelles Lernen</span>
                        <div class="skill-bar">
                           <div class="skill-progress" style="width: 52%;"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>