<head>
    <style>
        body {
            background-image: url('/themes/tok1/imgs/pattern.png');
            background-repeat: repeat;
            background-position: left top;
        }

        #container {
            background-image: url('/imgs/sfondopg.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }
    </style>
</head>

<body>
    <div id="container">
        <p>Descrizione dettagliata luogo</p>
    </div>
</body>
<?php
session_start();
echo $_SESSION['descrizione_luogo']['descrizione_dettagliata']; ?>