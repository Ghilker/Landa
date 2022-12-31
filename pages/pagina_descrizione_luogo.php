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
    <?php
    require '../includes/functions.inc.php';
    echo '<div class="box_stato_luogo"><div class="box_stato_luogo_marquee"><marquee onmouseover="this.stop()" onmouseout="this.start()" direction="left" scrollamount="3" class="stato_luogo">&nbsp;' . $MESSAGE['interface']['maps']['Status'] . ':  -  ' . $_SESSION['descrizione_luogo']['descrizione_dettagliata'] . '</marquee></div></div>';
    ?>

</body>