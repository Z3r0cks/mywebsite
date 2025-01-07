<?php
require './includes/auth.php';

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
   <div class="nav">
      <a href="logout.php"><button class="btn btn--main btn--nav">Abmelden</button></a>
      <a href="dashboard"><button class="btn btn--main btn--nav">Zurück </button></a>
      <a href="#" pdfName="experience_patrick_kaserer" id="downloadPdf"><button class="btn btn--main btn--nav">Download als PDF </button></a>
   </div>
   <div class="container_dashboard">
      <h1>Erfahrungen</h1>

      <button class="accordion">Hochschullehre</button>
      <div class="panel">
         <video class="ml-2" style="clear:right; float: right" width="480" autoplay controls loop muted>
            <source src="./assets/videos/teaching.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify;">Seit dem fünften Semster im Bachelor betreue ich Erst- und Zweitsemester in den Modulen "Entwicklung Interaktiver Medien", welcher in "Creative Coding" geändert wurde. Während des Bachelors war die Aufgabe die Bereuung der Studierende Bei den praktischen Aufgaben, die im Bereich Programmierung, Konzeption in Zusammenhang mit dem Internet of Things. Nach dem Bachelorabschluss durfte ich die Module als Lehrbeauftragter übernehmen, bei der auch die Lehre, Planung und Prüfungen dazu gehören. Die Erstellung der Lehrinhalte und das leiten eines Teams von Betreuern. Hierdurch habe ich viel über die Ditaktik lernen dürfen, und habe auch eine Sicht dafür bekommen, wie Lehre und Software für Lehre aufgebaut sein sollte.</p>
      </div>


      <button class="accordion">Forschungsprojekt - Tangible AR</button>
      <div class="panel">

         <video class="mr-2" style="clear:left; float: left" width="480  " controls>
            <source src="./assets/videos/TAR.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify;">Teil des Masters ist ein Forschungsporjekt, welches sich auf die ersten zwei Semester ersteckt. Hierbei wurde in einem dreiköpfigen Team aus zwei Gestaltern und mich als Entwickler, eine Webapp entwickelt, die Essen erkennen soll, und die entprechenden Nährwerte auf einem Augmented Reality-Tisch projiziert. Die Webapp kommuniziert über Websockets mit der KI (CNN), die auf einem Server läuft. Das Model wurde mit TensorFlow geschrieben und die selbstständig mit eigenen Trainingsdaten trainiert. Im Video die Vorstellung der App.</p>
      </div>


      <button class="accordion">Masterthesis - Synthesized Sensor Data from Neural Radiance Fields</button>
      <div class="panel">

      <img style="clear:right; float: right" class="ml-2 mb-1" width="80%" src="./assets/img/result1.png" alt="">
      <img style="clear:right; float: right" class="ml-2" width="80%" src="./assets/img/result2.png" alt="">

         <p style="text-align: justify;">Die Forschungsfrage hinter meiner Masterthesis ist, ob sich ein LiDAR-Sensor in einem Neural Radinace Fields (NeRF) synthetisieren lässt. Ein NeRF ist eine KI-Basierte Methode zum erstellen eine 3D Szenen-repräsentation, die aus 2D Input (Bilder) die Szene fotorealistisch in Echzeit darstellen kann, in der sich frei bewegt werden kann. Durch die sehr große Anzahl verschiedener LiDAR-Sensoren, war die Idee, dass von eine Szene Bilder aufgenommen wurde und meine Anwendung verwendet wird um zu entscheiden, welcher Sensor für welche Anlage am besten geeignet ist. Die Herausforderung lag daran, dass das neuronale Netz eine Blackbox ist und die einzelnen Koordinaten und Objekte in der Szene lediglich perspektifisch dargestellt werden. NeRF selbst lernt nur, den RGB-Wert und den Dichtewert an jeder Stelle des Raums zu approximieren. Somit sind Distanzen und Positionen von Objekten in der Szene nicht bekannt. Die verwendung von anderen Methoden zur 3D-Szenenrepräsentation ist meist einem größerene Aufwand verbunden oder einem weniger genaueren Ergebniss. Meine entwickelte Anwendung ist dazu in der Lage, aus jeder beliebigen Perspektive bis weniger als ein mm die Distanz zu jedem Punkt zu messen und dadurch Punktwolken zu erstellen, die mögliche LiDAR-Sensoren repräsentieren können. Auf dem Bilder sind zwei verschiedne NeRF-Szenen (Kein echten Bilder) von eine echten Szene, in der eine Punktwolke erstellt wurde. In der Mitte anschließend ein Plot der Punktwolke und rechts eine Distanzmessung von einem Origin zu einem Punkt im Raum.</p>
      </div>


      <button class="accordion">Praktisches Studiensemester - dreiQbik</button>
      <div class="panel">
         <p style="text-align: justify;"> Während des Bachelors absolvierte ich mein praktisches Studiensemester bei der Webagentur dreiQbik Karlsruhe. Schwerpunkt war die Fullstack-Entwicklung von indviduellen Webanwendungen für Unternehmen. Der USP war die Verwendung von CMS "WordPress" als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Hierbei wurde WordPress nicht verwendet, um die Anwendung über das CMS wie einen Baukasten zu füllen, sondern WordPress diente als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Der Kunde konnte anschließend mit für ihn entwickelten Custom-Fields die Inhalte selbst befüllen.</p>

         <video class="mr-2" style="clear:left; float: left" width="720" autoplay controls loop muted>
            <source src="./assets/videos/exp1.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify;">Während des Praktikums von sechs Monaten wurde ich in allen Prozessen der Entwicklung mit einbezogen und gefordert. Von der Kundenakquise, Kundengespräche, Projektmanagement, Back- und Frontendentwicklung bis zu Deployment der entsprechenden Software. Bei einem Relaunch einer Website von GoSilico haben ein weiterer Praktikant und ich den Großteil der Prozesse übernommen. Neben den Standardtools der Fullstack-Webentwicklung durfte ich hier viele Kenntnisse der Softwareentwicklung kennenlernen. Ich wurde aktiv in alle Prozesse integriert und konnte auch Erfahrungen im Management und der Organisation sammeln. Im Video ein Ausschnitt der Präsentation ohne Ton, bei der die GoSilico-Webapp vorgestellt wurde.</p>
      </div>


      <button class="accordion">Projektstudium - Website: "Blind MeetUp"</button>
      <div class="panel">
         <p style="text-align: justify;">Die Hochschule Furtwangen ist als Hochschule für angewandte Wissenschaften eine praktisch orientierte Hochschule. Alle Studiengänge in der Fakultät mussten ein Projektstudium absolvieren, was sich über zwei Semester zieht. Hierbei geht es darum, die gelernten Inhalte in einem eigenen, von den Studierenden entwickelten Projekt unter Beweis zu stellen. In einem 6-köpfigen Team wurde hier die eigens konzipierte Webanwendung "Blind MeetUp" entwickelt. Die Idee dahinter war, eine Plattform für Studierende der Hochschule anzubieten, bei der sich die Studierenden anonym zu zweit oder in Gruppen treffen können.</p>

         <video class="ml-2" style="clear:right; float: right" width="720" controls>
            <source src="./assets/videos/ImageVideo_Final.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify;">Im Projekt war ich für die Entwicklung der Anwendung und mit einem weiteren Komilitonen für das Projektmanagement mit Scrum verantwortlich. Auch wenn das Projekt durch einen Professor unterstützt wurde, oblag die Verantwortung für die Idee, das Konzept, Marketing, Entwicklung und Deployment den Studierenden. Durch die Coronapandemie wurde das Projekt leider nie released. Das Promotionvideo für die Webanwendung ist im Video zu sehen.</p>
      </div>


      <button class="accordion">Bachelorthesis - Implementierung eines Buchungssystems und dessen
         Algorithmus auf Basis einer Immobilienverwaltungsumgebung</button>
      <div class="panel">
         <p style="text-align: justify;">Die Aufgabe der Bachelorthesis bestand darin, einen Algorithmus zu schreiben, der einkommende Buchungen für ein Immobilienverwaltungssytem verwaltet und zuordnet. Die Herausforderung bestand darin Buchungen zuzuordnen, bei der nicht direkt erkennbar ist, zu welchem Vertrag diese gehören, da z.B. die Falsche Summe, Vertragsdaten oder anderen Dinge bei der Überweisung fehlen. Der Algorithmus sollten soweit es geht die Buchungen selbst durchführen und bei nicht eindeutigen Buchungen Vorschläge machen. Außerdem sollte das System aus vergangenen Buchungen lernen.
      </div>

   </div>
</body>

</html>