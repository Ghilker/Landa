<html>
  <body style='background-image: url("../themes/tok1/imgs/pattern.png"); display: flex; align-items: flex-start; position: relative;'>
    <div style="text-align:center;">
      <img src="../imgs/sfondopg.png" alt="" style="margin: 0 auto; max-width: 100%; max-height: 100%;">
      <div style="position:absolute;">
        Descrizione dettagliata luogo
      </div>
    </div>
  </body>
</html>

<html>
    <body style='background-image: url("../themes/tok1/imgs/pattern.png"); display: flex; align-items: flex-start; position: relative;'>
        <img src="../imgs/sfondopg.png" style='display: block; max-width: 100%; max-height: 100%; position: absolute; top: 0;'>
        <div style='position: absolute; z-index: 1; text-align: center;'>Descrizione dettagliata luogo</div>
    <?php
    session_start();
    echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];?>
    </body>
</html>

