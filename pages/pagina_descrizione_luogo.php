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

        #output {
            position: absolute;
            top: 20px;
            bottom: 0;
            right: 0px;
            left: 0px;
            width: auto;
            overflow: auto;
            text-align: center;
            background: url("") no-repeat top center #0a1228;
        }
    </style>
</head>

<body>
    <div id="container">
        <p>Descrizione dettagliata luogo</p>
    </div>
    <div id="output">
        <?php
        session_start();
        echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];
        ?>
    </div>

</body>