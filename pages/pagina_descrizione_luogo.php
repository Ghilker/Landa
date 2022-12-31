<head>
    <style>
        body {
            background-image: url('/themes/tok1/imgs/pattern.png');
            background-repeat: repeat;
            background-position: left top;
        }

        #desc_container {
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

        #desc_output {
            position: relative;
            width: auto;
            overflow: auto;
            text-align: center;
            background: url("") no-repeat center #0a1228;
            color: #7b859f;
            font-size: 18px;
            font-family: Arial, sans-serif;
            display: flex;
        }
    </style>
</head>

<body>
    <div id="desc_container">
        <p>Descrizione dettagliata luogo</p>
    </div>
    <div id="desc_output">
        <p><?php
        session_start();
        echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];
        ?><p>
    </div>
</body>