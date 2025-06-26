<?php
require './includes/auth.php';
require './includes/db_connect.php';

?>
<!DOCTYPE html>
<html>

<head>
   <title>Dashboard - About Me</title>
   <link rel="stylesheet" href="./style.css">
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
      <a href="#" pdfName="about_patrick_kaserer" id="downloadPdf"><button class="btn btn--main btn--nav">Download als PDF</button></a>
   </div>

   <div class="container_dashboard">
      <h2>Über mich</h2>
      <img src="./assets/img/me_hfu_i_building.jpg" alt="Me in the I-Building at HFU" style="width: 100%; max-width: 500px; float: left; margin-right: 20px;">
      <p class="mb-3"><b>Kurzfassung:</b> <br> <br>Ich bin kein klassischer Absolvent mit geradlinigem Lebenslauf, sondern jemand, der sich bewusst neu orientiert hat. Nach einer Ausbildung und mehreren Jahren Berufserfahrung habe ich mich dazu entschieden, ein Studium in Medieninformatik zu beginnen – mit dem Ziel, mein Interesse an Technologie, KI und Lehre beruflich umzusetzen. Meine Interessen sind: <strong>Neuronale Netze & Deep Learning</strong>,  <strong>Didaktik & Lehre</strong>,  <strong>Angewandte Wissenschaft & Technologie</strong>,  <strong>Organisation & Führung</strong>.</p>
      <p style="text-align: justify;"><b>Ausführliche Fassung:</b> <br> <br> Hey, ich bin Patrick.<br> <br> Da ich erst mit 28 Jahren angefangen habe zu studieren, bin ich ein älterer Absolvent als die meisten Studierenden. Der Vorteil ist, dass ich ganz genau weiß, wo ich im Leben stehe. Erfahrungen sammeln durfte und auch weiß, wie die Arbeitswelt aussieht und funktioniert. <br> Nachdem ich meinen Hauptschulabschluss und anschließend meine 3-jährige Berufsausbildung zur Fachkraft für Lagerlogistik abgeschlossen hatte, habe ich mehrere Jahre in der Logistik und in anderen Bereichen gearbeitet und Berufserfahrung sammeln dürfen. Die Gründe, weshalb mein erster Schulabschluss ein Hauptschulabschluss war, sind vielschichtig und zu komplex, um dies auf diese Weise zu kommunizieren. Bei einem persönlichen Kennenlernen gehe ich aber gern auf diese Frage ein, da sie ausschlaggebend für meine berufliche Zukunft ist. <br> <br> Ich habe gemerkt, dass diese Arbeit nicht das ist, was ich mir für meine Zukunft wünsche, und ich sie auch nicht mehr weitermachen möchte. Was dazu führte, dass ich in eine Arbeitslosigkeit gerutscht bin, die ich heute als berufliche Neuorientierung bezeichne. <br> <br> Durch meine Berufsausbildung und meinen Hauptschulabschluss konnte ich anschließend das Fachabitur nachholen und bei der Hochschule Furtwangen meinen B.Sc. in Medieninformatik erfolgreich abschließen. Aktuell absolviere ich den Master im gleichen Studiengang, den ich voraussichtlich im Januar oder Februar erfolgreich abschließen werde. Die Arbeit während des Studiums, z. B. im Praktikum, als Lehrbeauftragter oder auch bei studentischen Projekten, macht mir sehr viel Spaß. Hierdurch habe ich gelernt, dass ich die richtige Entscheidung getroffen habe.<br> <br> </p>

      <h2>Berufliche Interessen</h2>
      <img src="./assets/img/me_game_jam.jpg" alt="Me at work" style="width: 100%; max-width: 500px; float: right; margin-left: 20px;">
      <p style="text-align: justify;">Im Laufe des Studiums und schon davor, habe ich das Interesse für mehrere Bereiche entwickelt. Hierbei gehe ich nicht auf Stellenbezeichnungen wie Softwareentwickler oder Projektmanager ein. Auch die verschiedenen Programmiersprachen sind hier nicht relevant. Hier geht es um die Bereiche, die mich interessieren und wo ich zukünftig gerne arbeiten würde. </p> <br>
      <h3>Neuronale Netze</h3>
      <p style="text-align: justify;">Schon bevor ich 2018 mit dem Studium begonnen habe, hatte ich großes Interesse an dem Thema künstliche Intelligenz. Selbst betrachte ich den Begriff KI aber als Kampfwort, da dieser zu ungenau für eine beschreibende Definition ist und nach dem ChatGPT-Hype vor allem fürs Marketing verwendet wird. Mein Interesse liegt bei neuronalen Netzen bzw. Deep Learning. Ich sehe in diesen Bereichen die Zukunft der Entwicklung und stelle sie auf eine ähnliche Stufe wie die Erfindung und Verbreitung des Internets. Da mich dieses Thema stark interessiert, informiere ich mich auch privat darüber, jedoch ist es gerade als Absolvent schwierig, in diesem Bereich Berufserfahrungen zu sammeln, wenn diese nicht schon vorhanden sind. Im Laufe des Studiums habe ich an verschiedenen KI-Projekten gearbeitet. So z. B.: ein Modell, welches verschiedene Lebensmittel erkennt und die entsprechenden Nährwerte auf einem Augmented-Reality-Tisch projiziert, ein XAI (Explainable AI) Modell, welches visuell die Komplexität eines neuronalen Netzes aufzeigen und gleichzeitig die Blackbox begreiflicher machen soll, oder die Arbeit in meiner Masterthesis, bei der das neuronale Netz (ein Neural Radiance Fields) eine fotorealistische 3D-Repräsentation einer echten Szene approximiert, in der sich in Echtzeit unabhängig bewegt werden kann. <br> <br></p>

      <h3>Didaktik</h3>
      <p style="text-align: justify;">Während meines Studiums hatte ich das Glück als studentische Hilfskraft, Erstsemester zu unterrichten und ihnen die Welt der Programmierung beizubringen. Nach meiner Tätigkeit als studentische Hilfskraft wurde mir angeboten, als Lehrbeauftragter die Verantwortung zu übernehmen und die Inhalte so zu gestalten, wie ich sie für richtig empfinde. Inklusive der Prüfungsleistung. Diese Arbeit hat mir sehr viel Spaß gemacht und mich persönlich auch sehr weitergebracht. Ich habe während dieser Tätigkeit als Lehrbeauftragter erst richtig wahrgenommen, was es bedeutet, Inhalte tatsächlich zu verstehen. Wie Menschen denken, wie Menschen geführt werden wollen und wie mit ihnen umgegangen werden muss. Ich habe verstanden, dass ein Thema nur dann verstanden wird, wenn es anderen Personen erklärt werden kann, die keine Erfahrung damit haben. Dies hat auch meine Art beeinflusst, wie ich mit anderen Menschen kommuniziere und meine Inhalte präsentiere. Ich sehe die Lehre als besonders spannenden und wichtigen Bereich. Sowohl selbst Inhalte zu lehren als auch an Projekten zu arbeiten, die dafür gedacht sind, Inhalte zu vermitteln, und natürlich auch ein Leben lang selbst zu lernen. </p><br>

      <h3>Angewande Wissenschaften</h3>
      <p style="text-align: justify;">Während des Masters war die Arbeit im wissenschaftlichen Kontext besonders stark ausgeprägt. Hierbei ist für mich meine eigene Weiterentwicklung das Spannende. Stillstand betrachte ich persönlich als negativ und beziehe mich hierbei auch auf den technologischen Fortschritt. Es macht mir Spaß, eine Idee zu nehmen oder zu entwickeln und sich dann mit den möglichen Technologien auseinanderzusetzen, die dafür geeignet sind, die Idee umzusetzen. Es fordert, dass sich stetig mit neuen Inhalten auseinandergesetzt werden muss, dass der Stand der Technik immer aktuell ist und das Problem und diese Lösung immer einer besonderen Betrachtung bedürfen. Es stellt eine Herausforderung dar, da deren Ausgang oft nicht einzuschätzen ist, und umso mehr ist das Ergebnis am Ende dann positiver, wenn Dinge entwickelt wurden, die nicht im Alltag schon zur Gewohnheit wurden.</p> <br>

      <h3>Führung und Organisation</h3>
      <p style="text-align: justify;"> Ich sehe mich zu den Menschen, die das Große und Ganze betrachten wollen und versuchen, nicht nur die Prozesse hinter dem Handel zu verstehen, sondern diese auch zu optimieren. Ich besitze einen ausgeprägten organisatorischen Blick und die Fähigkeit, auch komplexe Prozesse einfach darzustellen. Meine Tätigkeit als Vorsitzender der Verfassten Studierendenschaft und damit als Hauptverantwortlicher für Tausende Studierende einer Anstalt des Öffentlichen Rechts hat mir viel über Führung und Organisation gezeigt. Dabei geht es nicht darum, alles zu wissen oder immer eine Antwort auf alle Inhalte zu haben, sondern um die Fähigkeit, diese Probleme zu lösen. Zu wissen, was die Stärken und Schwächen von Menschen sind, um sie effizient einzusetzen. Ressourcen und Kapazitäten so einzusetzen, dass es nicht nur zu einem erfolgreichen, sondern bestenfalls zu einem optimalen Ergebnis führt. Dabei sind ein kontinuierlicher Verbesserungsprozess und richtige Kommunikation im Vordergrund.</p>
   </div>
</body>

</html>