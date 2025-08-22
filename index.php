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
    <title>Patrick Kaserer</title>
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
1  <span class="c-comment">// HR won't read this</span>
2  <span class="c-exec">CONNECT</span> <span class="c-func">establish_link_to_future_employer</span>()
3
4  {
5    <span class="c-var">"candidate"</span>: {
6    <span class="c-var">"name"</span>: <span class="c-string">"Patrick Kaserer"</span>,
7    <span class="c-var">"email"</span>: <span class="c-string">"mail@patrick-kaserer.de"</span>,
8    <span class="c-var">"location"</span>: <span class="c-string">"Karlsruhe, Germany"</span>,
9    <span class="c-var">"skills"</span>: [
10     <span class="c-string">"Software Development"</span>, <span class="c-string">"AI"</span>,
11     <span class="c-string">"Neural Radiance Fields"</span>, <span class="c-string">"Computer Vision"</span>,
12     <span class="c-string">"Teamwork"</span>,<span class="c-string">"Communication"</span>,
13     <span class="c-string">"Leadership"</span>,<span class="c-string">"Problem Solving"</span>,
14     <span class="c-string">"Adaptability"</span>, <span class="c-string">"Project Management"</span>,
15     ],
16   <span class="c-var">"availability"</span>: <span class="c-string">"immediately"</span>,
17  }
18 
19  <span class="c-exec">IF</span> <span class="c-var">job</span> == <span class="c-string">"computer science"</span> && <span class="c-var">candidate</span> == <span class="c-string">"Patrick Kaserer"</span>
20      <span class="c-func">print</span> <span class="c-string">"Good candidate found!"</span>
21  <span class="c-exec">END IF</span>
22
23  <span class="c-func-pre">FUNCTION</span> <span class="c-func">motivation</span>
24      <span class="c-exec">return</span> <span class="c-string">"Finding solutions where others see problems."</span>
25  <span class="c-func-pre">END FUNCTION</span>
26
27  <span class="c-func-pre">function</span> <span class="c-func">apply_for_job</span> <span class="c-exec">with</span> <span class="c-string">"Patrick Kaserer"</span>
28  <span class="terminal-cursor">|</span>
                </pre>
            </div>
            <div class="lp_name">
                <div>
                    <p class="lp_name-black">PATRICK</p>
                    <p class="lp_name-white">PATRICK</p>
                </div>
                <div class="lp_name lp_name--surename">
                    <div>
                        <p class="lp_name-black">KASERER</p>
                        <p class="lp_name-white">KASERER</p>
                    </div>
                </div>
                <!-- <div class="banner">Page Is Work In Progess! </div> -->
            </div>
            <form class="display-flex flex-column login" action="check_login.php" method="POST">
                <div class="display-flex flex-justify-between">
                    <div class="mr-10-px login--input"><label for="user_name">Benutzername</label><input type="text" placeholder="Login Name" id="user_name" name="user_name" required></div>
                    <div class="ml-10-px login--input"><label for="password">Passwort</label><input class="" type="password" placeholder="Passwort" id="password" name="password" required><input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"></div>
                </div><button class="button_form" type="submit">Anmelden</button>
            </form>
            <div class="guest-login-section">
                <p class="text-center">oder</p>
                <form class="mb-2 display-flex flex-column login" action="guest_login.php" method="POST">
                    <button class="button_form" type="submit">Als Gast anmelden</button>
                </form>
            </div>
            <div class="link_logo--wrapper">
                <a href=https://www.linkedin.com/in/patrick-kaserer>
                    <img class="link_logo link_logo--linked" src="./assets/img/linkedin_logo.png" alt=linkedIn>
                </a>
                <a href=https://www.xing.com/profile/Patrick_Kaserer>
                    <img class="link_logo link_logo--xing" src="./assets/img/xing_logo.png" alt=Xing>
                </a>
                <a href=https://github.com/Z3r0cks>
                    <img class="link_logo link_logo--github" src="./assets/img/github_logo.png" alt=Github></a>
                <a href="mailto:mail@patrick-kaserer.de"><img class="link_logo link_logo--mail" src=./assets/img/mail.png alt=Mail></a>
            </div>
        </div>
    </main>
</body>

</html>