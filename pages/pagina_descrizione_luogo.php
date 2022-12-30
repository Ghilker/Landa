<html>
    <body style='background-image: url("../themes/tok1/imgs/pattern.png"); display: flex; align-items: flex-start;'>
        <img src="../imgs/sfondopg.png" style='display: block; max-width: 100%; max-height: 100%; position: absolute; top: 0;'>
            <h1 style='text-align: center;'>Descrizione dettagliata luogo</h1>
    <?php
    session_start();
    echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];?>
    </body>
</html>

