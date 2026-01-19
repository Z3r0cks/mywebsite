<?php
require './includes/auth.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - Experience</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./style.css">
   <script src="./js/accordion.js" defer></script>
   <script src="./js/video-controls.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <div class="nav">
      <a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
      <a href="dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
   </div>
   <div class="container_dashboard">
      <h1>Erfahrungen</h1>

      <button class="accordion accordion--bg">Fullstack Softwareentwickler/KI</button>
      <div class="panel">
         <div class="tl_dr">Kurzfasssung: Fullstack Softwareentwickler mit C#, Python, Vue, Konzeption, Forschung und KI</div>
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">
            Im Rahmen meiner Tätigkeit als Fullstack-Entwickler war ich in den letzten sechs Monaten an der Entwicklung und Weiterentwicklung einer webbasierten Logistikplattform beteiligt. Aufgabe der Software ist die Echtzeitvisualisierung und Steuerung des Materialflusses in einem Lager. Meine Aufgaben umfassten sowohl Backend- als auch Frontend-Entwicklung – von der Gestaltung nutzerfreundlicher Oberflächen bis hin zur effizienten Datenverarbeitung und -bereitstellung. <br>
            Ein besonderer Fokus lag auf der Konzeption und Umsetzung von Prototypen für KI-gestützte Komponenten. Dazu zählte unter anderem die Konzeption und Weiterentwicklung eines Materialflussrechners und Lagerverwaltungssystem sowie die Mitarbeit an zwei Forschungsprojekten im Bereich KI und Intralogistik.
         </p>
         </ul>
      </div>


      <button class="accordion accordion--bg">Hochschullehre</button>
      <div class="panel">
         <div class="tl_dr">Kurzfasssung: Hochschullehre im Bereich Programmierung (klassische Webtechnologien), IoT (C++), Konzeption und KI.</div>
         <video class="ml-2" style="clear:right; float: right" width="480" autoplay controls loop muted>
            <source src="./assets/videos/teaching.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">
            Seit dem fünften Semester im Bachelor betreue ich Erst- und Zweitsemester in den Modulen "Entwicklung interaktiver Medien", welches in "Creative Coding" geändert wurde. Während des Bachelors war die Betreuung der Studierenden bei den praktischen Aufgaben, die im Bereich Programmierung und Konzeption in Zusammenhang mit dem Internet of Things lagen, die Hauptaufgabe. Nach dem Bachelorabschluss wurde ich zum Lehrbeauftragten berufen, bei dem die Lehre, Planung und Prüfungen dazugehören sowie die Erstellung der Lehrinhalte und das Leiten eines Teams von Betreuern. Hierdurch habe ich viel über die Didaktik lernen dürfen und habe auch eine Sicht dafür bekommen, wie Lehre und Software für Lehre aufgebaut sein sollten.</p>
      </div>


      <button class="accordion accordion--bg">Forschungsprojekt - Frühstücks-Checks</button>
      <div class="panel">
         
         <div class="tl_dr">Kurzfasssung: Bilderkennung mit KI (CNN) und selbsterstellten Trainingsdaten, Datenpipline von Backend zu Frontend (Python, Webtechnologien, TensorFlow, Flask).</div>
         <video class="mr-2" style="clear:left; float: left" width="360" controls>
            <source src="./assets/videos/TAR.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">
            Teil des Masters ist ein Forschungsprojekt, welches sich neben anderen Inhalten über die ersten zwei Semester erstreckt. Hierbei wurde in einem dreiköpfigen Team aus zwei Designern und mir als Entwickler eine Webapp entwickelt, die Essen erkennen soll und die entsprechenden Nährwerte auf einem Augmented-Reality-Tisch projiziert. Die Idee des "Frühstücks-Checks" war, ob es möglich ist, in einer einfachen Anwendung Essen zu analysieren und im Bezug auf eine Person und das Essen Vorschläge zu machen, wie gesund das Essen ist. Hierbei lag der Fokus auf der Erkennung des möglichen Essens. Die Webapp kommuniziert über Websockets mit der KI (Convolutional Neural Network), die auf einem Server läuft. Das Modell wurde mit TensorFlow geschrieben und selbstständig mit eigenen Trainingsdaten trainiert. Im Video die Vorstellung der App mit einem Tablet.</p>
      </div>


      <button class="accordion accordion--bg">Masterthesis - Synthesized Sensor Data from Neural Radiance Fields</button>
      <div class="panel">
         <div class="tl_dr">Kurzfasssung: Wie kann in einem Neural Radiance Field (NeRF) synthetische LiDAR-Sensor Daten generiert werden? Ergebnis: Möglich mit einem Algorithmus und einer Varianz (13µm in meinem Fall).</div> 
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">
         Falls Sie einen Login haben uns sich für meine Thesis interessieren, können Sie sie im Dokumentenbereich herunterladen.<br>
         Die Forschungsfrage hinter meiner Masterthesis war, ob sich ein LiDAR-Sensor in einem Neural Radiance Fields (NeRF) synthetisieren lässt. Ein NeRF (siehe <a target="_blank" rel="noopener noreferrer" href="https://www.matthewtancik.com/nerf">hier</a>) ist eine KI-basierte Methode zum Erstellen einer 3D-Szenen-repräsentation, die aus 2D-Input (Bildern) die Szene fotorealistisch in Echtzeit darstellen kann, in der sich frei bewegt werden kann. Dadurch, dass es unendlich verschiedene Arten von LiDAR-Sensoren (siehe <a target="_blank" rel="noopener noreferrer"  href="https://de.wikipedia.org/wiki/Lidar">LiDAR</a>) geben kann, war die Idee, dass von einer Szene Bilder aufgenommen werden und die Anwendung verwendet wird, um zu entscheiden, welcher Sensor für welche Installation am besten geeignet wäre. Die Herausforderung lag daran, dass das neuronale Netz eine Blackbox ist und die einzelnen Koordinaten und Objekte in der Szene lediglich perspektivisch dargestellt werden. NeRF selbst lernt nur, den RGB-Wert und den Dichtewert an jeder Stelle des Raums zu approximieren. Somit sind Distanzen und Positionen von Objekten in der Szene nicht bekannt. Die Verwendung von anderen Methoden zur 3D-Szenenrepräsentation ist meist mit einem größeren Aufwand verbunden oder führt zu einem weniger genauen Ergebnis. <br> 
         Das Ergebnis war ein Algorithmus in einer Anwendung, die aus jeder beliebigen Perspektive, und unter optimalen Bedingungen, die Distanz zu jedem Punkt mit einer durschnittsvarinanz von 13µm bestimmen- und Punktwolken zu erstellen kann, die mögliche LiDAR-Sensoren repräsentieren. Dies in theoretisch unendlich großer Auflösung und FOV, je nach gewählten LiDAR Settings. <br> Auf den Bildern sind zwei verschiedene NeRF-Szenen (keine echten Bilder) die aus echten Szenen generiert wurden. Links jeweils die Punktwolke innerhalb der Szene. In der Mitte anschließend ein Plot der Punktwolke und rechts eine Distanzmessung von einem Origin zu einem Punkt im Raum. Die Unit der Distanzmessung ist abhängig von der verwendeten Methode wie die Bildpositionen beim erstellen des NeRFs berechnet/geschätzt wurden, und ob innerhalb der Szene die Skalierung kalibiert wurde. In diesem Fall sind es Meter.</p>
         <figure>
            <img style="clear:right; float: right" class="ml-2 mb-1" width="100%" src="./assets/img/result1.png" alt="">
            <img style="clear:right; float: right" class="ml-2" width="100%" src="./assets/img/result2.png" alt="">
            <figcaption>Abb.: Zwei verschiedene NeRF-Szenen von echten Szenem, in der eine Punktwolke erstellt wurde. In der Mitte anschließend ein Plot der Punktwolke und rechts eine Distanzmessung von einem Origin zu einem Punkt im Raum.</figcaption>
         </figure>
      </div>


      <button class="accordion accordion--bg">Praktisches Studiensemester - dreiQbik</button>
      <div class="panel">
         <div class="tl_dr mt-1">Webentwicklung mit WordPress als Backend. Selbstentwickelt, keine Verwendung von CMS als Baukasten. Kundengespräche und Zusammenarbeit mit Kunden.</div>
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;"> 
            Während des Bachelors absolvierte ich mein praktisches Studiensemester bei der Webagentur dreiQbik in Karlsruhe. Schwerpunkt war die Fullstack-Entwicklung von indviduellen Webanwendungen für Unternehmen. Der USP war die Verwendung von CMS WordPress als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Hierbei wurde WordPress nicht verwendet, um die Anwendung über das CMS als Baukasten zu füllen, sondern WordPress diente als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Der Kunde konnte anschließend mit für ihn entwickelten Custom-Fields die Inhalte selbst befüllen.</p>

         <video class="mr-2" style="clear:left; float: left" width="720" autoplay controls loop muted>
            <source src="./assets/videos/exp1.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">Während des Praktikums von sechs Monaten wurde ich in alle Prozesse der Entwicklung mit einbezogen und gefordert. Von der Kundenakquise, Kundengespräche, Projektmanagement, Back- und Frontendentwicklung bis zu Deployment der entsprechenden Software. Bei einem Relaunch einer Website von GoSilico haben ein weiterer Praktikant und ich den Großteil der Prozesse übernommen. Neben den Standardtools der Fullstack-Webentwicklung durfte ich hier viele Kenntnisse der Softwareentwicklung kennenlernen. Ich wurde aktiv in alle Prozesse integriert und konnte auch Erfahrungen im Management und in der Organisation sammeln. Im Video ein Ausschnitt der Präsentation ohne Ton, bei der die GoSilico-Webapp vorgestellt wurde.</p>
      </div>


      <button class="accordion accordion--bg">Projektstudium - Website: "Blind MeetUp"</button>
         <div class="panel">
         <div class="tl_dr">Kurzfassung: Entwicklung einer Plattform für Studierende, die sich anonym zu zweit oder in Gruppen treffen können. Von der Ideenfindung, bis hin zu Kunden und Usergesprächen, Projektmanagement und Entwicklung der Webanwendung (React & Laravel).</div> 
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">Die Hochschule Furtwangen ist als Hochschule für angewandte Wissenschaften eine praktisch orientierte Hochschule. Alle Studiengänge in der Fakultät mussten ein Projektstudium absolvieren, das sich über zwei Semester zieht. Hierbei geht es darum, die gelernten Inhalte in einem eigenen, von den Studierenden entwickelten Projekt unter Beweis zu stellen. In einem 6-köpfigen Team wurde hier die eigens konzipierte Webanwendung "Blind MeetUp" entwickelt. Die Idee dahinter war, eine Plattform für Studierende der Hochschule anzubieten, bei der sich die Studierenden anonym zu zweit oder in Gruppen treffen können.</p>

         <video class="ml-2" style="clear:right; float: right" width="720" controls>
            <source src="./assets/videos/ImageVideo_Final.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify; line-height:1.7; padding-bottom:1rem;">Im Projekt war ich für die Entwicklung der Anwendung und mit einem weiteren Komilitonen für das Projektmanagement mit Scrum verantwortlich. Auch wenn das Projekt durch einen Professor unterstützt wurde, oblag die Verantwortung für die Idee, das Konzept, Marketing, Entwicklung und Deployment den Studierenden. Durch die Coronapandemie wurde das Projekt nur für einen Tag released um diesen Prozess aufzuzeigen. Das Promotionvideo für die Webanwendung ist im Video zu sehen.</p>
      </div>
   </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>

