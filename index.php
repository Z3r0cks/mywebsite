<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
    <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
    <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>
<body>
    <main>
        <div class="container">
            <div class="lp_header">
                <div class="lp_header__container">
                    <div class="lp_header__img">
                        <img class="lp_header__img--img" src="./assets/img/me_lecture_6_24.png">
                    </div>
                    <pre class="lp_header__pre-hw">
#  #       #  #          #   #           #     #  #
#  #   ##  #  #   ##     #   #   ##      #     #  #
####  #### #  #  #  #    #   #  #  #  ## #   ###  #
#  #  #    #  #  #  #    # # #  #  # #   #  #  #
#  #   ##   #  #  ##      # #    ##  #    #  ###  #
                    </pre>
                </div>
                <pre class="lp_header__pre-code">
1  Host: your_company.com
2  Content-Type: application/json
3  // HR won't read this
4
5  {
6      "candidate": {
7          "name": "Patrick Kaserer",
8          "email": "mail@patrick-kaserer.de",
10          "location": "Karlsruhe, Germany",
11          "linkedIn": "https://www.linkedin.com/in/patrick-kaserer/",
12          "github": "https://github.com/Z3r0cks",
13          "availability": "immediately",
15      }
16  

18  <strong>IF</strong> job == „computer science" && candidate == „Patrick Kaserer"
19      print „Good candidate found!"
20  <strong>END IF</strong>

22  <strong>FUNCTION</strong> motivation
23      return "Finding solutions where others see problems."
20  <strong>END FUNCTION</strong>

25  function apply_for_job with "Patrick Kaserer";
26  >
                </pre>
           </div><div class="lp_name"><div><p class="lp_name-black">PATRICK</p><p class="lp_name-white">PATRICK</p></div><div class="lp_name lp_name--surename"><div><p class="lp_name-black">KASERER</p><p class="lp_name-white">KASERER</p></div></div><div class="banner">Page Is Work In Progess! </div></div><form class="mb-2 display-flex flex-column login" action="check_login.php" method="POST"><div class="display-flex flex-justify-between"><div class="mr-10-px login--input"><label for="user_name">Benutzername</label><input type="text" placeholder="Login Name" id="user_name" name="user_name" required></div><div class="ml-10-px login--input"><label for="password">Passwort</label><input class="" type="password" placeholder="Passwort" id="password" name="password" required><input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"></div></div><button class="button_form" type="submit">Anmelden</button></form><div class="link_logo--wrapper"><a href=https://www.linkedin.com/in/patrick-kaserer><img class="link_logo link_logo--linked" src=./assets/img/linkedin_logo.png alt=linkedIn></a><a href=https://www.xing.com/profile/Patrick_Kaserer><img class="link_logo link_logo--xing" src=./assets/img/xing_logo.png alt=Xing></a><a href=https://github.com/Z3r0cks><img class="link_logo link_logo--github" src=./assets/img/github_logo.png alt=Github></a><a href="mailto:mail@patrick-kaserer.de"><img class="link_logo link_logo--mail" src=./assets/img/mail.png alt=Mail></a></div></div></main></body></html>