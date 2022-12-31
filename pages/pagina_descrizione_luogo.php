<head>
    <style>
        body {
            background-image: url('/themes/tok1/imgs/pattern.png');
            background-repeat: repeat;
            background-position: left top;
        }

        #desc_wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        #desc_container {
            background-image: url('/imgs/sfondopg.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
            text-align: center;
            font-size: 30px;
            font-family: Arial, sans-serif;
            color: #031127;
            width: 100%;
        }

        #desc_output {
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            overflow: auto;
            text-align: center;
            background: url("") no-repeat center #0a1228;
            color: #7b859f;
            font-size: 12px;
            font-family: Arial, sans-serif;
            height: 100%;
        }
    </style>
</head>

<body>
    <div id="desc_wrapper">
        <div id="desc_container">
            <p>Descrizione dettagliata luogo</p>
        </div>
        <div id="desc_output">
            <p><?php
            session_start();
            echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];
            ?>
            <p>
        </div>
    </div>
</body>