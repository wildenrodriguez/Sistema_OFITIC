<?php
    foreach ($msg as $type => $message) {  
?>
        <div id="alerta" class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
        <?php echo $message;?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php

    }
?>