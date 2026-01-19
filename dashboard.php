<?php
require './includes/auth.php';
require './includes/db_connect.php';

$user_name = $_SESSION['user_name'];
$is_guest = isset($_SESSION['is_guest']) && $_SESSION['is_guest'] === true;

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- <script src="./js/language.js" defer></script> -->
    <script src="./js/dashboard.js" defer></script>
    <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
    <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
    <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
    <div class="nav">
        <a href="logout"><button class="btn btn--main btn--nav" data-translate="nav.logout">Abmelden</button></a>
    </div>
    <div class="container_dashboard">
        <div class="container__title">
            <?php if ($is_guest) { ?>
                <h4 class="container__title--text" data-translate="dashboard.welcome_guest">Willkommen Gast</h4>
            <?php } else { ?>
                <h4 class="container__title--text" data-translate="dashboard.welcome">Willkommen im Dashboard, <?= htmlspecialchars($username) ?></h4>
            <?php } ?>
            <?php if ($is_guest) { ?>
                <span data-translate="dashboard.intro_guest">Hier können Sie einen ersten Eindruck von meinen Qualifikationen und Erfahrungen bekommen. Für weitere Informationen kontaktieren Sie mich gerne direkt.</span>
            <?php } elseif ($initial_apply) { ?>
                <span data-translate="dashboard.intro_individual">Schön, dass Sie hier her gefunden haben und meine Initiativbewerbung bei Ihnen in Betracht ziehen.</span>
            <?php } else { ?>
                <span data-translate="dashboard.intro_job" data-job="<?= htmlentities($job_desc) ?>">Schön, dass Sie hier her gefunden haben und meine Bewerbung als <?= htmlentities($job_desc) ?> in Betracht ziehen.</span>
            <?php } ?>
            <?php if (!$is_guest) { ?>
                <span data-translate="dashboard.info_text">Unten finden Sie weitere Informationen über mich und die Bewerbungsunterlagen sowie Zeugnisse und Empfehlungen als einzelnen Dokumente.</span>
            <?php } else { ?>
                <span data-translate="dashboard.info_text_guest">Erkunden Sie die verfügbaren Bereiche um mehr über meine Qualifikationen zu erfahren.</span>
            <?php } ?>
        </div>

        <div class="boxWrapper mb-8">
            <div class="boxWrapper__inner">
                <a class="boxWrapper__a" href="about_me">
                    <div class="about-me-dashboard-icon">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <!-- Person silhouette -->
                            <circle cx="50" cy="25" r="12" fill="#0f7dbd" opacity="0.8" />
                            <path d="M 30 75 Q 30 55 50 55 Q 70 55 70 75 L 70 85 L 30 85 Z" fill="#2e6c48" opacity="0.8" />

                            <!-- Skills/interests icons around the person -->
                            <!-- Computer/Tech (top left - red) -->
                            <circle cx="20" cy="20" r="5" fill="#d9534f" opacity="0.7" />
                            <rect x="16" y="16" width="8" height="8" rx="1" fill="none" stroke="#d9534f" stroke-width="1" />

                            <!-- Lightbulb/Ideas (top right - yellow) -->
                            <circle cx="80" cy="33" r="5" fill="#f0ad4e" opacity="0.7" />
                            <circle cx="80" cy="32" r="2" fill="none" stroke="#f0ad4e" stroke-width="0.7" />
                            <rect x="78.5" y="34" width="3" height="2" fill="none" stroke="#f0ad4e" stroke-width="0.5" />

                            <!-- Code/Programming (bottom left - blue) -->
                            <circle cx="15" cy="60" r="5" fill="#0f7dbd" opacity="0.7" />
                            <path d="M 12 57 L 18 57 M 12 60 L 16 60 M 12 63 L 18 63" stroke="#0f7dbd" stroke-width="1" />

                            <!-- Checkmark/Success (bottom right - green) -->
                            <circle cx="85" cy="65" r="5" fill="#2e6c48" opacity="0.7" />
                            <path d="M 82 65 L 84 67 L 88 63" stroke="#2e6c48" stroke-width="1.5" fill="none" />

                            <!-- Connecting lines -->
                            <line x1="27" y1="25" x2="36" y2="29" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                            <line x1="60" y1="35" x2="73" y2="34" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                            <line x1="35" y1="50" x2="23" y2="56" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                            <line x1="65" y1="52" x2="78" y2="61" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                        </svg>
                        <span class="about-me-dashboard-text">Über Mich</span>
                    </div>
                </a>
                <?php if (!$is_guest) { ?>
                    <a class="boxWrapper__a" href="documents">
                        <div class="documents-dashboard-icon ">
                        <?php } else { ?>
                            <a class="boxWrapper__a boxWrapper__a--disabled">
                                <div class="documents-dashboard-icon documents-dashboard-icon--disabled">
                                    <span class="no-access-banner">Für Gäste nicht verfügbar</span>
                                <?php } ?>
                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Main document -->
                                    <rect x="25" y="15" width="40" height="55" rx="3" fill="#0f7dbd" opacity="0.8" />
                                    <rect x="30" y="25" width="30" height="2" fill="#ffffff" opacity="0.9" />
                                    <rect x="30" y="30" width="25" height="2" fill="#ffffff" opacity="0.7" />
                                    <rect x="30" y="35" width="28" height="2" fill="#ffffff" opacity="0.7" />
                                    <rect x="30" y="40" width="20" height="2" fill="#ffffff" opacity="0.7" />

                                    <!-- Overlapping documents -->
                                    <rect x="35" y="20" width="40" height="55" rx="3" fill="#2e6c48" opacity="1" />
                                    <rect x="40" y="30" width="25" height="2" fill="#ffffff" opacity="0.8" />
                                    <rect x="40" y="35" width="22" height="2" fill="#ffffff" opacity="0.6" />
                                    <rect x="40" y="40" width="28" height="2" fill="#ffffff" opacity="0.6" />

                                    <!-- Certificate/diploma icon -->
                                    <circle cx="15" cy="25" r="6" fill="#f0ad4e" opacity="0.7" />
                                    <circle cx="15" cy="25" r="3" fill="none" stroke="#f0ad4e" stroke-width="1" />
                                    <path d="M 13 25 L 15 27 L 17 23" stroke="#f0ad4e" stroke-width="1.2" fill="none" />

                                    <!-- PDF icon -->
                                    <circle cx="85" cy="35" r="6" fill="#d9534f" opacity="0.7" />
                                    <text x="85" y="38" text-anchor="middle" font-size="6" fill="#d9534f" font-weight="bold">P</text>

                                    <!-- Connection lines -->
                                    <line x1="21" y1="28" x2="28" y2="32" stroke="#e9ecef" stroke-width="1" opacity="0.4" />
                                    <line x1="79" y1="38" x2="72" y2="42" stroke="#e9ecef" stroke-width="1" opacity="0.4" />
                                </svg>
                                <span class="documents-dashboard-text documents-dashboard-text--disabled">Dokumente</span>
                                </div>
                            </a>
                            <a class="boxWrapper__a" href="experience">
                                <div class="experience-dashboard-icon">
                                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Briefcase/Portfolio -->
                                        <rect x="30" y="40" width="40" height="25" rx="3" fill="#2e6c48" opacity="0.8" />
                                        <rect x="45" y="35" width="10" height="8" fill="#2e6c48" opacity="0.6" />
                                        <circle cx="40" cy="52" r="2" fill="#ffffff" opacity="0.7" />
                                        <circle cx="60" cy="52" r="2" fill="#ffffff" opacity="0.7" />

                                        <!-- Career ladder/steps -->
                                        <rect x="15" y="70" width="12" height="4" fill="#0f7dbd" opacity="0.7" />
                                        <rect x="20" y="65" width="12" height="4" fill="#0f7dbd" opacity="0.8" />
                                        <rect x="25" y="60" width="12" height="4" fill="#0f7dbd" opacity="0.9" />

                                        <!-- Skills/achievements icons -->
                                        <!-- Award/trophy (top left) -->
                                        <circle cx="20" cy="25" r="5" fill="#f0ad4e" opacity="0.7" />
                                        <circle cx="20" cy="23" r="2" fill="none" stroke="#f0ad4e" stroke-width="1" />
                                        <rect x="18" y="27" width="4" height="2" fill="#f0ad4e" opacity="0.5" />

                                        <!-- Growth chart (top right) -->
                                        <circle cx="80" cy="25" r="5" fill="#d9534f" opacity="0.7" />
                                        <path d="M 77 27 L 79 25 L 81 26 L 83 23" stroke="#d9534f" stroke-width="1.5" fill="none" />

                                        <!-- Network/connections (bottom right) -->
                                        <circle cx="75" cy="70" r="5" fill="#0f7dbd" opacity="0.7" />
                                        <circle cx="73" cy="68" r="1.5" fill="#0f7dbd" />
                                        <circle cx="77" cy="68" r="1.5" fill="#0f7dbd" />
                                        <circle cx="75" cy="72" r="1.5" fill="#0f7dbd" />
                                        <line x1="73" y1="68" x2="77" y2="68" stroke="#0f7dbd" stroke-width="0.8" />
                                        <line x1="75" y1="68" x2="75" y2="72" stroke="#0f7dbd" stroke-width="0.8" />

                                        <!-- Connection lines -->
                                        <line x1="25" y1="28" x2="35" y2="38" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="75" y1="28" x2="65" y2="38" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="37" y1="58" x2="30" y2="65" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="65" y1="58" x2="70" y2="65" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                    </svg>
                                    <span class="experience-dashboard-text">Erfahrung</span>
                                </div>
                            </a>
                            <a class="boxWrapper__a" href="studium">
                                <div class="medieninformatik-dashboard-icon">
                                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Graduation cap -->
                                        <path d="M 50 25 L 20 35 L 50 45 L 80 35 Z" fill="#2e6c48" opacity="0.8" />
                                        <rect x="47" y="45" width="6" height="15" fill="#2e6c48" opacity="0.6" />
                                        <circle cx="85" cy="35" r="3" fill="#2e6c48" opacity="0.6" />

                                        <!-- Computer/Technology -->
                                        <rect x="35" y="55" width="30" height="20" rx="2" fill="#0f7dbd" opacity="0.8" />
                                        <rect x="37" y="57" width="26" height="14" fill="#ffffff" opacity="0.2" />
                                        <rect x="39" y="59" width="22" height="1" fill="#0f7dbd" opacity="0.9" />
                                        <rect x="39" y="62" width="18" height="1" fill="#0f7dbd" opacity="0.7" />
                                        <rect x="39" y="65" width="20" height="1" fill="#0f7dbd" opacity="0.7" />
                                        <rect x="39" y="68" width="15" height="1" fill="#0f7dbd" opacity="0.7" />

                                        <!-- Media/Design elements -->
                                        <!-- Camera (top left) -->
                                        <circle cx="20" cy="20" r="5" fill="#d9534f" opacity="0.7" />
                                        <rect x="17" y="17" width="6" height="6" rx="1" fill="none" stroke="#d9534f" stroke-width="1" />
                                        <circle cx="20" cy="20" r="2" fill="none" stroke="#d9534f" stroke-width="0.8" />

                                        <!-- Palette/Design (top right) -->
                                        <circle cx="80" cy="20" r="5" fill="#f0ad4e" opacity="0.7" />
                                        <circle cx="78" cy="18" r="1.5" fill="#f0ad4e" />
                                        <circle cx="82" cy="18" r="1.5" fill="#f0ad4e" />
                                        <circle cx="80" cy="22" r="1.5" fill="#f0ad4e" />

                                        <!-- Books/Knowledge (bottom left) -->
                                        <circle cx="15" cy="70" r="5" fill="#2e6c48" opacity="0.7" />
                                        <rect x="12" y="67" width="6" height="1" fill="#2e6c48" />
                                        <rect x="12" y="69" width="6" height="1" fill="#2e6c48" />
                                        <rect x="12" y="71" width="6" height="1" fill="#2e6c48" />
                                        <rect x="12" y="73" width="6" height="1" fill="#2e6c48" />

                                        <!-- Digital media (bottom right) -->
                                        <circle cx="85" cy="70" r="5" fill="#0f7dbd" opacity="0.7" />
                                        <rect x="82" y="67" width="6" height="6" rx="1" fill="none" stroke="#0f7dbd" stroke-width="0.8" />
                                        <path d="M 84 69 L 85 71 L 86 69" stroke="#0f7dbd" stroke-width="1" fill="none" />

                                        <!-- Connection lines -->
                                        <line x1="25" y1="22" x2="32" y2="30" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="75" y1="22" x2="68" y2="30" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="20" y1="65" x2="30" y2="62" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                        <line x1="80" y1="65" x2="70" y2="62" stroke="#e9ecef" stroke-width="1" opacity="0.5" />
                                    </svg>
                                    <span class="medieninformatik-dashboard-text">Medien- informatik</span>
                                </div>
                            </a>
                            <?php if (!$is_guest) { ?>
                                <a class="boxWrapper__a" href="timeline">
                                    <div class="timeline-dashboard-icon">
                                    <?php } else { ?>
                                        <a class="boxWrapper__a boxWrapper__a--disabled">
                                            <div class="timeline-dashboard-icon timeline-dashboard-icon--disabled">
                                                <span class="no-access-banner">Für Gäste nicht verfügbar</span>
                                            <?php } ?>
                                            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="10" cy="20" r="3" fill="#0f7dbd" />
                                                <circle cx="10" cy="40" r="3" fill="#2e6c48" />
                                                <circle cx="10" cy="60" r="3" fill="#d9534f" />
                                                <circle cx="10" cy="80" r="3" fill="#f0ad4e" />
                                                <line x1="10" y1="20" x2="10" y2="80" stroke="#e9ecef" stroke-width="2" />
                                                <rect x="20" y="17" width="70" height="6" rx="3" fill="#0f7dbd" opacity="0.8" />
                                                <rect x="20" y="37" width="60" height="6" rx="3" fill="#2e6c48" opacity="0.8" />
                                                <rect x="20" y="57" width="65" height="6" rx="3" fill="#d9534f" opacity="0.8" />
                                                <rect x="20" y="77" width="55" height="6" rx="3" fill="#f0ad4e" opacity="0.8" />
                                            </svg>
                                            <span class="timeline-dashboard-text">Timeline</span>
                                            </div>
                                        </a>
                                    </div>
                        </div>
                        <?php

                        $sql = "SELECT role FROM user WHERE user_name = :user_name";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
                        $stmt->execute();
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if (!$user || $user['role'] == 'admin') { ?>
                            <div class="boxWrapper__inner">
                                <a class="boxWrapper__a" href="add_comp">
                                    <div class="cover-note-dashboard-icon">
                                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                            <!-- Document -->
                                            <rect x="25" y="15" width="50" height="70" rx="3" fill="#f0ad4e" opacity="0.8" />
                                            <rect x="35" y="25" width="30" height="2" fill="#ffffff" opacity="0.9" />
                                            <rect x="35" y="35" width="30" height="2" fill="#ffffff" opacity="0.9" />
                                            <rect x="35" y="45" width="30" height="2" fill="#ffffff" opacity="0.9" />

                                            <!-- Pen -->
                                            <path d="M 60 60 L 80 80 L 85 75 L 65 55 Z" fill="#d9534f" />
                                            <path d="M 60 60 L 55 65 L 60 65 Z" fill="#333" />
                                        </svg>
                                        <span class="cover-note-dashboard-text">Unternehmen Hinzufügen</span>
                                    </div>
                                </a>
                                <a class="boxWrapper__a" href="admin/relations.php">Zuweisungen verwalten</a>
                    </a>
                    <a class="boxWrapper__a" href="admin/access_logs.php">Access Logs</a></a>
                    <a class="boxWrapper__a" href="ai_demos">AI-Demos</a></a>
                <?php } ?>
                <div class="mb-2">
                    <!-- Benötige Icon hier -->
                    <h4>Du willst digitalisieren? Kontaktiere mich!</h4>
                    <span></span>Ich möchte weiterhin meine Erfahrung und Kenntnisse mit anderen Menschen teilen. Daher möchte ich gerne eine kostenlose Beratungen anbieten. Hierbei geht es nicht um eine bezahlte Arbeit als Freiberufler sondern um die Möglichkeit, anderen Menschen zu helfen und Erfahrungen zu gewinnen. Falls Sie also kleines oder mittelständiges Unternehmen sind, und aktuell mit dem Gedanken spielen Ihr Unternehmen zu digitalisieren, dürfen Sie mich gerne mit einer kurzen Beschreibung der Problemstellung und des gewünschten Ziels, über das Kontaktformular kontaktieren. Mein Gewinn ist hierbei die Erfahrung.</span>
                </div>
                <h4>Zukünftige Funktionen und Projekte</h4>
                <span>Da auch die Didaktik für mich eine wichtige Rolle spielt, werden hier zukünftig weitere Funktionen und Projekte hinzugefügt. Unter anderem verschiedene Tutorials über die Themen Programmierung, Künstliche Intelligenz und Computer Vision.</span>
            </div>
            <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
<!-- <div class="devBtn"></div> -->

</html>