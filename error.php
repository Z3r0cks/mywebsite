<!DOCTYPE html>
<html>

<head>
   <title>Falscher Login</title>
   <link rel="stylesheet" href="./style.css">
   <link rel="icon" type="image/png" href="./assets/favicons/favicon-96x96.png" sizes="96x96" />
   <link rel="icon" type="image/svg+xml" href="./assets/favicons/favicon.svg" />
   <link rel="shortcut icon" href="./assets/favicons/favicon.ico" />
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png" />
   <link rel="manifest" href="./assets/favicons/site.webmanifest" />
</head>

<body>
   <a href="index.php"><button class="btn btn--main btn--nav">Zurück</button></a>
   <div class="container">
      <h1>Da ist was schief gelaufen</h1>
      <p class="mb-3">Anscheinend waren die Login-Daten nicht korrekt :(</p>
      <h3>Noch ein Versuch?</h3>
      <form class="mb-2 display-flex flex-column login" action="check_login.php" method="POST">
         <div class="display-flex flex-justify-between">
            <div class="mr-10-px login--input">
               <label for="user_name">Benutzername</label>
               <input type="text" placeholder="Login Name" id="user_name" name="user_name" required>
            </div>
            <div class="ml-10-px login--input">
               <label for="password">Passwort</label>
               <input class="" type="password" placeholder="Passwort" id="password" name="password" required>
            </div>
         </div>
         <button class="button_form" type="submit">Anmelden</button>
      </form>
   </div>
</body>

</html>