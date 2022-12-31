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
            position: absolute;
        }

        #output {
            position: relative;
            top: 25px;
            bottom: 10px;
            right: 10px;
            left: 10px;
            width: auto;
            overflow: auto;
            text-align: center;
            background: url("") no-repeat center #0a1228;
            color: #7b859f;
            font-size: 18px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div id="container">
        <p>Descrizione dettagliata luogo</p>
    </div>
    <div id="output">
        <p><?php
        session_start();
        echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];
        ?><p>
    </div>
</body>