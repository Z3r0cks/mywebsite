<?php
require './includes/auth.php';
require './includes/db_connect.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - About Me</title>
   <link rel="stylesheet" href="./style.css">
   <script src="./js/accordion.js" defer></script>
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
   </div>

   <div class="container_dashboard">
      <!-- Hero Section -->
      <div class="about-hero">
         <div class="hero-content">
            <div class="hero-image">
               <img src="./assets/img/me_hfu_i_building.jpg" alt="Patrick Kaserer im I-Gebäude der HFU" class="profile-image">
            </div>
            <div class="hero-text">
               <h1 class="c2-main">Patrick Kaserer</h1>
               <h2 class="c1-second">Medieninformatik M.Sc.</h2>
               <p class="hero-description">
                  Ich bin kein klassischer Absolvent mit geradlinigem Lebenslauf, sondern jemand, der sich bewusst neu orientiert hat.
                  Nach einer Ausbildung und mehreren Jahren Berufserfahrung habe ich mich dazu entschieden, ein Studium in Medieninformatik zu beginnen –
                  mit dem Ziel, mein Interesse an Technologie, KI und Lehre beruflich umzusetzen.
               </p>
            </div>
         </div>

         <!-- Interest Cards -->
         <div class="interest-cards">
            <div class="interest-cards-inner_wrapper">
               <div class="interest-card bg-main2">
                  <h3>🧠 Neuronale Netze & Deep Learning</h3>
                  <p>Die Zukunft der Technologie</p>
               </div>
               <div class="interest-card bg-second1">
                  <h3>🎓 Didaktik & Lehre</h3>
                  <p>Wissen vermitteln & teilen</p>
               </div>
            </div>
            <div class="interest-cards-inner_wrapper">
               <div class="interest-card bg-second2">
                  <h3>🔬 Angewandte Wissenschaft</h3>
                  <p>Forschung & Innovation</p>
               </div>
               <div class="interest-card bg-second4">
                  <h3>👥 Organisation & Führung</h3>
                  <p>Teams & Prozesse optimieren</p>
               </div>
            </div>
         </div>
      </div>

      <!-- Detailed Information Accordion -->
      <div class="about-details">
         <h2 class="details-title">Mehr über meine Interessen erfahren</h2>

         <!-- Personal Story Accordion -->
         <button class="accordion bg-main3">
            <span class="accordion-icon">📖</span>
            <span class="accordion-title">Meine Geschichte - Vom Lagerlogistiker zum Informatiker</span>
         </button>
         <div class="panel">
            <div class="panel-content">
               <img src="./assets/img/me_game_jam.jpg" alt="Patrick bei der Arbeit" class="panel-image-right">
               <p><strong>Hey, ich bin Patrick.</strong></p>
               <p>Da ich erst mit 28 Jahren angefangen habe zu studieren, bin ich ein älterer Absolvent als die meisten Studierenden.
                  Der Vorteil ist, dass ich ganz genau weiß, wo ich im Leben stehe. Erfahrungen sammeln durfte und auch weiß,
                  wie die Arbeitswelt aussieht und funktioniert.</p>

               <p>Nachdem ich meinen Hauptschulabschluss und anschließend meine 3-jährige Berufsausbildung zur Fachkraft für
                  Lagerlogistik abgeschlossen hatte, habe ich mehrere Jahre in der Logistik und in anderen Bereichen gearbeitet und
                  Berufserfahrung sammeln dürfen.</p>

               <p>Ich habe erkannt, dass ich mein Leben anders designen möchte. Was dazu führte, dass ich in eine berufliche Neuorientierung begonnen habe.</p>

               <p>Durch meine Berufsausbildung und meinen Hauptschulabschluss konnte ich anschließend das Fachabitur nachholen und
                  bei der Hochschule Furtwangen meinen B.Sc. und M.Sc. in Medieninformatik erfolgreich abschließen. Die
                  Arbeit während des Studiums, z. B. im Praktikum, als Lehrbeauftragter oder auch bei studentischen Projekten, waren nicht vergleichebar mit der Arbeit davor. Hierdurch habe ich erkannt, dass ich die richtige Entscheidung getroffen habe.</p>
            </div>
         </div>

         <!-- Neural Networks Accordion -->
         <button class="accordion bg-main2">
            <span class="accordion-icon">🧠</span>
            <span class="accordion-title">Neuronale Netze & Deep Learning</span>
         </button>
         <div class="panel">
            <div class="panel-content">
               <p>Schon bevor ich 2018 mit dem Studium begonnen habe, hatte ich großes Interesse an dem Thema künstliche Intelligenz.
                  Selbst betrachte ich den Begriff KI als Buzzword. Als Begriff für eine Marketingstrategie zur Erweiterung der Produktlinie.</p>

               <p><strong>Mein Interesse liegt bei neuronalen Netzen bzw. Deep Learning.</strong> Ich sehe in diesen Bereichen die
                  Zukunft der Entwicklung und stelle sie auf eine ähnliche Stufe wie die Erfindung und Verbreitung des Internets. Da mich
                  dieses Thema stark interessiert, informiere ich mich auch privat darüber, jedoch ist es gerade als Absolvent schwierig,
                  in diesem Bereich Berufserfahrungen zu sammeln, wenn diese nicht schon vorhanden sind.</p>

               <div class="highlight-box bg-second3">
                  <h4 class="c2-main">Meine KI-Projekte:</h4>
                  <ul>
                     <li><strong>Lebensmittel-Erkennungsmodell:</strong> Erkennt verschiedene Lebensmittel und projiziert entsprechende Nährwerte auf einem Augmented-Reality-Tisch.</li>
                     <li><strong>XAI (Explainable AI) Modell:</strong> Zeigt visuell die Komplexität eines neuronalen Netzes auf und macht die Blackbox begreiflicher.</li>
                     <li><strong>Neural Radiance Fields (Masterthesis):</strong> Approximiert eine fotorealistische 3D-Repräsentation einer echten Szene, in der sich in Echtzeit unabhängig bewegt werden kann.</li>
                     <li><strong>SILOG (Safe Intralogistics):</strong> Entwicklung eines Systems zur Gefahrenprävention, bei dem ein trainiertes Modell erkennt, wenn sich Personen unerlaubt oder gefährlich auf einem Förderband bewegen, um in solchen Fällen automatisiert das Band zu stoppen oder eine Alarmmeldung auszulösen.</li>
                     <li><strong>SALT (Smart automatic loading of Trucks):</strong> Entwicklung eines KI-gestützten Systems zur automatisierten Entladung von Gitterboxen. Ziel war es, ein neuronales Netz zu trainieren, das unterschiedliche Objekte in einer Gitterbox erkennt und die Be- und Entladung entsprechend steuert (nur Recherche).</li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Teaching Accordion -->
         <button class="accordion bg-second1">
            <span class="accordion-icon">🎓</span>
            <span class="accordion-title">Didaktik & Lehre</span>
         </button>
         <div class="panel">
            <div class="panel-content">
               <p>Während meines Studiums hatte ich das Glück als studentische Hilfskraft, Erstsemester zu unterrichten und ihnen von der
                  Welt der Programmierung zu begeistern. Nach meiner Tätigkeit als studentische Hilfskraft und dem Abschluss meines Bachelors, wurde mir angeboten, als
                  Lehrbeauftragter die Verantwortung zu übernehmen und die Inhalte so zu gestalten, wie ich sie für richtig empfinde.
                  Inklusive der Prüfungsleistung.</p>

               <div class="highlight-box" style="background-color: #effcef;">
                  <p class="c2-main"><strong>Diese Arbeit hat mir sehr viel Spaß gemacht und mich persönlich auch sehr weitergebracht.</strong>
                     Ich habe während dieser Tätigkeit als Lehrbeauftragter erst richtig wahrgenommen, was es bedeutet, Inhalte tatsächlich zu verstehen.</p>
               </div>

               <p>Wie Menschen denken, wie Menschen geführt werden wollen und wie mit ihnen umgegangen werden muss. Ich habe verstanden,
                  dass ein Thema nur dann verstanden wird, wenn es anderen Personen erklärt werden kann, die keine Erfahrung damit haben.
                  Dies hat auch meine Art beeinflusst, wie ich mit anderen Menschen kommuniziere und meine Inhalte präsentiere.</p>

               <p>Ich sehe die Lehre als besonders spannenden und wichtigen Bereich. Sowohl selbst Inhalte zu lehren als auch an
                  Projekten zu arbeiten, die dafür gedacht sind, Inhalte zu vermitteln, und natürlich auch ein Leben lang selbst zu lernen.</p>
            </div>
         </div>

         <!-- Applied Science Accordion -->
         <button class="accordion bg-second2">
            <span class="accordion-icon">🔬</span>
            <span class="accordion-title">Angewandte Wissenschaften</span>
         </button>
         <div class="panel">
            <div class="panel-content">
               <p>Während des Masters war die Arbeit im wissenschaftlichen Kontext besonders stark ausgeprägt. Hierbei ist für mich
                  meine eigene Weiterentwicklung das Spannende. <strong>Stillstand betrachte ich persönlich als negativ</strong> und
                  beziehe mich hierbei auch auf den technologischen Fortschritt.</p>

               <p>Es macht mir Spaß, eine Idee zu nehmen oder zu entwickeln und sich dann mit den möglichen Technologien
                  auseinanderzusetzen, die dafür geeignet sind, die Idee umzusetzen. Es fordert, dass sich stetig mit neuen Inhalten
                  auseinandergesetzt werden muss, dass der Stand der Technik immer aktuell ist und das Problem und diese Lösung immer
                  einer besonderen Betrachtung bedürfen.</p>

               <div class="highlight-box" style="background-color: #e8f0ff;">
                  <p class="c2-main">Es stellt eine Herausforderung dar, da deren Ausgang oft nicht einzuschätzen ist, und umso mehr ist das
                     Ergebnis am Ende dann positiver, wenn Dinge entwickelt wurden, die nicht im Alltag schon zur Gewohnheit wurden.</p>
               </div>
            </div>
         </div>

         <!-- Leadership Accordion -->
         <button class="accordion bg-second4">
            <span class="accordion-icon">👥</span>
            <span class="accordion-title">Organisation & Führung</span>
         </button>
         <div class="panel">
            <div class="panel-content">
               <p>Ich sehe mich zu den Menschen, die das Große und Ganze betrachten wollen und versuchen, nicht nur die Prozesse
                  hinter dem Handel zu verstehen, sondern diese auch zu optimieren. Ich besitze einen ausgeprägten organisatorischen
                  Blick und die Fähigkeit, auch komplexe Prozesse einfach darzustellen.</p>

               <div class="highlight-box" style="background-color: #f5e8ff;">
                  <h4 class="c2-main">Meine Führungserfahrung:</h4>
                  <p class="c2-main"><strong>Vorsitzender der Verfassten Studierendenschaft</strong> - Hauptverantwortlicher für
                     Tausende Studierende einer Anstalt des Öffentlichen Rechts.</p>
                  <p class="c2-main"><strong>Führung von Teams als Lehrbeauftragter</strong> - Als Lehrbeauftragter habe ich Studierende im Bereich Programmierung und Konzeption betreut und dabei ein Team angeleitet.</p>
               </div>

               <p>Diese Tätigkeit hat mir viel über Organisation & Führung gezeigt. Dabei geht es nicht darum, alles zu wissen oder
                  immer eine Antwort auf alle Inhalte zu haben, sondern um die Fähigkeit, diese Probleme zu lösen. Zu wissen, was die
                  Stärken und Schwächen von Menschen sind, um sie effizient einzusetzen.</p>

               <p>Ressourcen und Kapazitäten so einzusetzen, dass es nicht nur zu einem erfolgreichen, sondern bestenfalls zu einem
                  optimalen Ergebnis führt. Dabei sind ein kontinuierlicher Verbesserungsprozess und richtige Kommunikation im Vordergrund.</p>
            </div>
         </div>
      </div>
   </div>
   <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>