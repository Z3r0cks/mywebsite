<?php
require './includes/auth.php';
require './includes/db_connect.php';

$user_name = $_SESSION['user_name'];

$sql = "SELECT role FROM user WHERE user_name = :user_name";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

try {
    $stmt = $pdo->prepare("SELECT job_desc, initial_apply FROM user WHERE user_name = :user_name");
    $stmt->execute(['user_name' => $user_name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $username = $user_name;
        $job_desc = $user['job_desc'];
        $initial_apply = $user['initial_apply'];
    } else {
        echo "Benutzer nicht gefunden.";
        exit();
    }
} catch (PDOException $e) {
    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./js/dashboard.js" defer></script>
    <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
    <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
    <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
    <div class="nav">
        <a href="logout"><button class="btn btn--main btn--nav">Abmelden</button></a>
    </div>
    <div class="container_dashboard">
        <h1>Willkommen im Dashboard, <?= htmlspecialchars($username) ?></h1>
        <p>Schön, dass Sie hier her gefunden haben und <?php if ($initial_apply) { ?>
                meine Initiativbewerbung bei Ihnen in Betracht ziehen.
            <?php } else { ?>
                meine Bewerbung als <?= htmlentities($job_desc) ?> in Betracht ziehen.</p> <?php } ?>
    <p class="mb-3">Unten finden Sie weitere Informationen über mich und die Bewerbungsunterlagen sowie Zeugnisse und Empfehlungen als einzelnen Dokumente.</p>

    <div class="boxWrapper">
        <div class="boxWrapper__inner">
            <a class="boxWrapper__a" href="about_me"><img width="90%" src="./assets/img/dashboard_about_me.png" alt=""></a>
            <a class="boxWrapper__a" href="documents"><img width="73%" src="./assets/img/documents.png" alt=""></a></a>
        </div>
        <div class="boxWrapper__inner">
            <a class="boxWrapper__a" href="experience"><img width="110%" src="./assets/img/exp.png" alt=""></a></a>
            <a class="boxWrapper__a" href="studium"><img width="110%" src="./assets/img/mi_dash.png" alt=""></a></a>
        </div>
        <?php

        $sql = "SELECT role FROM user WHERE user_name = :user_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['role'] == 'admin') { ?>
            <div class="boxWrapper__inner">
                <a class="boxWrapper__a" href="add_comp">Unternehmen Hinzufügen</a></a>
                <a class="boxWrapper__a" href="add_file">Datei Hinzufügen</a></a>
            </div>
        <?php } ?>
    </div>
    </div>
</body>

</html>