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
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="container">
        <p>Descrizione dettagliata luogo</p>
    </div>
    <?php session_start();
    echo '<pre>';
    var_dump($_SESSION['descrizione_luogo']['descrizione_dettagliata']);
    echo '</pre>';

    $variable = $_SESSION['descrizione_luogo']['descrizione_dettagliata'];
    echo '<h1>' . $variable . '</h1>'; ?>

</body>