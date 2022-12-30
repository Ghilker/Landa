
<div class="bg-image">
  <!-- content here -->
</div>

<?php
require '../ref_header.inc.php';
require '../footer.inc.php';

session_start();

echo $_SESSION['descrizione_luogo']['descrizione_dettagliata'];

?>