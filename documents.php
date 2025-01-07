<?php
require './includes/auth.php';
require './includes/db_connect.php';


$user_name = $_SESSION['user_name'];

try {
    // SQL-Abfrage vorbereiten
    $sql = "
        SELECT d.file_id, d.file_name, d.file_url, d.file_size
        FROM documents d
        JOIN user_documents ud ON d.file_id = ud.document_id
        JOIN user u ON ud.user_id = u.user_id
        WHERE u.user_name = :user_name
    ";

    // Abfrage vorbereiten und den Parameter binden
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->execute();

    // Ergebnisse abrufen
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);


    //     $stmt = $pdo->prepare("SELECT job_desc, initial_appli FROM user WHERE user_name = :user_name");
    //     $stmt->execute(['user_name' => $user_name]);
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($user) {
    //         $username = $user_name;
    //         $job_desc = $user['job_desc'];
    //         $initial_appli = $user['initial_appli'];
    //     } else {
    //         echo "Benutzer nicht gefunden.";
    //         exit();
    //     }
} catch (PDOException $e) {
    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./js/accordion.js" defer></script>
</head>

<body>
    <div class="nav">
        <a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
        <a href="dashboard"><button class="btn btn--main btn--nav">Zurück</button></a>
    </div>
    <div class="container_dashboard">

        <h1>Willkommen im bei den Dokumenten, <?= htmlspecialchars($username) ?></h1>
        <p class="mb-3">Unten finden Sie nun Bewerbungsunterlagen und Zeugnisse als einzelne Dateien.</p>

        <table class="mb-2" style="width: 100%;">
            <?php foreach ($documents as $document) : ?>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=<?= $document['file_name'] ?>"><?= $document['file_name'] ?></a></td>
                    <td class="table_desc
                    "><?= $document['file_size'] ?> KB</td>
                    <td class="table_desc
                    table_desc__second"> <?= $document['file_name'] ?></td>
                    <td><a class="table_desc" href="download.php?file=<?= $document['file_name'] ?>"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- <table class="mb-2" style="width: 100%;">
            <tr>
                <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd&name=<?= $user_name ?>">Lebenslauf</a></td>
                <td class="table_desc">1 MB</td>
                <td class="table_desc table_desc__second">Aktueller tabellarischer Lebenslauf</td>
                <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
            </tr>
            <tr>
                <td class="table_desc__first"><a class="table_desc" href="download.php?file=">Motivationsschreiben</a></td>
                <td class="table_desc">2 MB</td>
                <td class="table_desc table_desc__second">Warum ich mich für die Stelle interessiere</td>
                <td><a class="table_desc" href="download.php?file=5wek353kkkj3ak4das5"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
            </tr>
            <tr>
                <td class="table_desc__first"><a class="table_desc" href="download.php?file=-------------------">Medieninformatik</a></td>
                <td class="table_desc">2 MB</td>
                <td class="table_desc table_desc__second">Was ist Medieninformatik und warum habe ich mich dafür entschieden</td>
                <td><a class="table_desc" href="download.php?file==-------------------"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
            </tr>
            <tr>
                <td class="table_desc__first"><a class="table_desc" href="download.php?file=-------------------">Vereinfachter Lebenslauf</a></td>
                <td class="table_desc">2 MB</td>
                <td class="table_desc table_desc__second">Ein Lebenslauf, der die wichtigen Inhalte anschaulicher darstellt.</td>
                <td><a class="table_desc" href="download.php?file==-------------------"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
            </tr>
        </table>

        <button class="accordion">Zeugnisse</button>
        <div class="panel">
            <table class="mb-2" style="width: 100%;">
                <tr>
                <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Masterabschluss</a></td>
                <td class="table_desc">1 MB</td>
                <td class="table_desc">Notenspiegel für den Masterabschluss Medieninformatik</td>
                <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
            </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Notenspiegel Master</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Notenspiegel für den Masterabschluss Medieninformatik</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Bachelorabschluss</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Notenspiegel für den Bachelor Medieninformatik</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Notenspiegel Bachelor</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Notenspiegel für den Bachelor Medieninformatik</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Zeugnisse Fachhochschulreife</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Zeugnisse für das Fachabitur</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Facharbeiterbrief Berufsausbildung</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Facharbeiterbrief für den die Berufsausbildung zur Fachkraft für Lagerlogostik</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
            </table>
        </div>

        <button class="accordion">Empfehlung und Ehrenamt</button>
        <div class="panel">
            <table class="mb-2" style="width: 100%;">
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Empfehlungsschreiben</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second"><span class="table_desc"></span>Empfehlungsschreiben für den die Tätigkeit als Lehrbeauftragter von Prof. Dr. Gabriel Rausch</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Referenzschreiben</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Referenzschreiben von Prof. Dr. Uwe Hahne</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
                <tr>
                    <td class="table_desc__first"><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd">Urkunde</a></td>
                    <td class="table_desc">1 MB</td>
                    <td class="table_desc table_desc__second">Bescheinidgung für die ehrenamtlische Tätigkeit als Vorsitzender der Verfassten Studierendenschaft</td>
                    <td><a class="table_desc" href="download.php?file=ddskjIJJjkfji565awd"><img style="width: 30px" src="./assets/svg/download-button.svg" alt="download icon"></a></td>
                </tr>
            </table>
        </div> -->
    </div>
</body>

</html>