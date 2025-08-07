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
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <div class="nav">
      <a href="logout.php"><button class="btn btn--main btn--nav">Abmelden</button></a>
      <a href="dashboard"><button class="btn btn--main btn--nav">Zurück </button></a>
   </div>
   <div class="container_dashboard">
      <h1>Erfahrungen</h1>

      <button class="accordion">Fullstack Softwareentwickler/KI</button>
      <div class="panel">
         <p style="text-align: justify;">
            Im Rahmen meiner Tätigkeit als Fullstack-Entwickler war ich in den letzten sechs Monaten an der Entwicklung und Weiterentwicklung einer webbasierten Logistikplattform beteiligt. Ziel des Projekts war die Echtzeitvisualisierung und Steuerung des Materialflusses in einem Lager. Meine Aufgaben umfassten sowohl Backend- als auch Frontend-Entwicklung – von der Gestaltung nutzerfreundlicher Oberflächen bis hin zur effizienten Datenverarbeitung und -bereitstellung.
         </p>
         <p style="text-align: justify;">
            Ein besonderer Fokus lag auf der Konzeption und Umsetzung von Prototypen für KI-gestützte Komponenten. Dazu zählte unter anderem die Weiterentwicklung eines Materialflussrechners sowie die Mitarbeit an zwei Forschungsprojekten im Bereich KI und Intralogistik:
         </p>
         <ul style="text-align: justify;">
            <li>
               <strong>SILOG (Safe Intralogistics):</strong> Entwicklung eines Systems zur Gefahrenprävention, bei dem ein trainiertes Modell erkennt, wenn sich Personen unerlaubt oder gefährlich auf einem Förderband bewegen, um in solchen Fällen automatisiert das Band zu stoppen oder eine Alarmmeldung auszulösen.
            </li>
            <li>
               <strong>SALT (Smart automatic loading of Trucks):</strong> Entwicklung eines KI-gestützten Systems zur automatisierten Entladung von Gitterboxen. Ziel war es, ein neuronales Netz zu trainieren, das unterschiedliche Objekte in einer Gitterbox erkennt und die Be- und Entladung entsprechend steuert.
            </li>
         </ul>
      </div>


      <button class="accordion">Hochschullehre</button>
      <div class="panel">
         <video class="ml-2" style="clear:right; float: right" width="480" autoplay controls loop muted>
            <source src="./assets/videos/teaching.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify;">Seit dem fünften Semester im Bachelor betreue ich Erst- und Zweitsemester in den Modulen "Entwicklung interaktiver Medien", welches in "Creative Coding" geändert wurde. Während des Bachelors war die Betreuung der Studierenden bei den praktischen Aufgaben, die im Bereich Programmierung und Konzeption in Zusammenhang mit dem Internet of Things lagen, die Hauptaufgabe. Nach dem Bachelorabschluss wurde ich zum Lehrbeauftragten berufen, bei dem die Lehre, Planung und Prüfungen dazugehören sowie die Erstellung der Lehrinhalte und das Leiten eines Teams von Betreuern. Hierdurch habe ich viel über die Didaktik lernen dürfen und habe auch eine Sicht dafür bekommen, wie Lehre und Software für Lehre aufgebaut sein sollten.</p>
      </div>


      <button class="accordion">Forschungsprojekt - Frühstücks-Checks</button>
      <div class="panel">

         <video class="mr-2" style="clear:left; float: left" width="360" controls>
            <source src="./assets/videos/TAR.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify;">Teil des Masters ist ein Forschungsporjekt, welches sich neben anderen Inhalten über die ersten zwei Semester erstreckt. Hierbei wurde in einem dreiköpfigen Team aus zwei Gestaltern und mir als Entwickler eine Webapp entwickelt, die Essen erkennen soll und die entsprechenden Nährwerte auf einem Augmented-Reality-Tisch projiziert. Die Idee des "Frühstücks-Checks" war, ob es möglich ist, in einer einfachen Anwendung Essen zu analysieren und im Bezug auf eine Person und das Essen Vorschläge zu machen, wie gesund das Essen ist. Hierbei lag der Fokus auf der Erkennung des möglichen Essens. Die Webapp kommuniziert über Websockets mit der KI (Convolutional Neural Network), die auf einem Server läuft. Das Modell wurde mit TensorFlow geschrieben und selbstständig mit eigenen Trainingsdaten trainiert. Im Video die Vorstellung der App mit einem Tablet.</p>
      </div>


      <button class="accordion">Masterthesis - Synthesized Sensor Data from Neural Radiance Fields</button>
      <div class="panel">

         <img style="clear:right; float: right" class="ml-2 mb-1" width="80%" src="./assets/img/result1.png" alt="">
         <img style="clear:right; float: right" class="ml-2" width="80%" src="./assets/img/result2.png" alt="">

         <p style="text-align: justify;">Die Forschungsfrage hinter meiner Masterthesis ist, ob sich ein LiDAR-Sensor in einem Neural Radiance Fields (NeRF) synthetisieren lässt. Ein NeRF ist eine KI-basierte Methode zum Erstellen einer 3D-Szenenrepräsentation, die aus 2D-Input (Bildern) die Szene fotorealistisch in Echtzeit darstellen kann, in der sich frei bewegt werden kann. Durch die sehr große Anzahl verschiedener LiDAR-Sensoren war die Idee, dass von einer Szene Bilder aufgenommen werden und die Anwendung verwendet wird, um zu entscheiden, welcher Sensor für welche Installation am besten geeignet wäre. Die Herausforderung lag daran, dass das neuronale Netz eine Blackbox ist und die einzelnen Koordinaten und Objekte in der Szene lediglich perspektivisch dargestellt werden. NeRF selbst lernt nur, den RGB-Wert und den Dichtewert an jeder Stelle des Raums zu approximieren. Somit sind Distanzen und Positionen von Objekten in der Szene nicht bekannt. Die Verwendung von anderen Methoden zur 3D-Szenenrepräsentation ist meist mit einem größeren Aufwand verbunden oder führt zu einem weniger genauen Ergebnis. Meine entwickelte Anwendung ist dazu in der Lage, aus jeder beliebigen Perspektive bis weniger als ein mm die Distanz zu jedem Punkt zu messen und dadurch Punktwolken zu erstellen, die mögliche LiDAR-Sensoren repräsentieren können. Auf den Bildern sind zwei verschiedene NeRF-Szenen (keine echten Bilder) von einer echten Szene, in der eine Punktwolke erstellt wurde. In der Mitte anschließend ein Plot der Punktwolke und rechts eine Distanzmessung von einem Origin zu einem Punkt im Raum.</p>
      </div>


      <button class="accordion">Praktisches Studiensemester - dreiQbik</button>
      <div class="panel">
         <p style="text-align: justify;"> Während des Bachelors absolvierte ich mein praktisches Studiensemester bei der Webagentur dreiQbik in Karlsruhe. Schwerpunkt war die Fullstack-Entwicklung von indviduellen Webanwendungen für Unternehmen. Der USP war die Verwendung von CMS WordPress als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Hierbei wurde WordPress nicht verwendet, um die Anwendung über das CMS als Baukasten zu füllen, sondern WordPress diente als Backend, auf dem die individuelle Webanwendung entwickelt wurde. Der Kunde konnte anschließend mit für ihn entwickelten Custom-Fields die Inhalte selbst befüllen.</p>

         <video class="mr-2" style="clear:left; float: left" width="720" autoplay controls loop muted>
            <source src="./assets/videos/exp1.mp4">
            Your browser does not support the video tag.
         </video>

         <p style="text-align: justify;">Während des Praktikums von sechs Monaten wurde ich in alle Prozesse der Entwicklung mit einbezogen und gefordert. Von der Kundenakquise, Kundengespräche, Projektmanagement, Back- und Frontendentwicklung bis zu Deployment der entsprechenden Software. Bei einem Relaunch einer Website von GoSilico haben ein weiterer Praktikant und ich den Großteil der Prozesse übernommen. Neben den Standardtools der Fullstack-Webentwicklung durfte ich hier viele Kenntnisse der Softwareentwicklung kennenlernen. Ich wurde aktiv in alle Prozesse integriert und konnte auch Erfahrungen im Management und in der Organisation sammeln. Im Video ein Ausschnitt der Präsentation ohne Ton, bei der die GoSilico-Webapp vorgestellt wurde.</p>
      </div>


      <button class="accordion">Projektstudium - Website: "Blind MeetUp"</button>
      <div class="panel">
         <p style="text-align: justify;">Die Hochschule Furtwangen ist als Hochschule für angewandte Wissenschaften eine praktisch orientierte Hochschule. Alle Studiengänge in der Fakultät mussten ein Projektstudium absolvieren, das sich über zwei Semester zieht. Hierbei geht es darum, die gelernten Inhalte in einem eigenen, von den Studierenden entwickelten Projekt unter Beweis zu stellen. In einem 6-köpfigen Team wurde hier die eigens konzipierte Webanwendung "Blind MeetUp" entwickelt. Die Idee dahinter war, eine Plattform für Studierende der Hochschule anzubieten, bei der sich die Studierenden anonym zu zweit oder in Gruppen treffen können.</p>

         <video class="ml-2" style="clear:right; float: right" width="720" controls>
            <source src="./assets/videos/ImageVideo_Final.mp4">
            Your browser does not support the video tag.
         </video>
         <p style="text-align: justify;">Im Projekt war ich für die Entwicklung der Anwendung und mit einem weiteren Komilitonen für das Projektmanagement mit Scrum verantwortlich. Auch wenn das Projekt durch einen Professor unterstützt wurde, oblag die Verantwortung für die Idee, das Konzept, Marketing, Entwicklung und Deployment den Studierenden. Durch die Coronapandemie wurde das Projekt nur für einen Tag released um diesen Prozess aufzuzeigen. Das Promotionvideo für die Webanwendung ist im Video zu sehen.</p>
      </div>
   </div>
</body>

</html>

