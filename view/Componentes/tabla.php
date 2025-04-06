<div class="table-responsive">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
                <th scope='col'></th>
            </tr>
        </thead>
        <tbody id="t_configuracion">
            <?php foreach ($registros as $informacion){ ?>
            <tr>
                <?php foreach ($informacion as $campo) echo "<td>$campo</td>"; ?>
                <td>
                    <form method="post" id="form_config" autocomplete="off">
                        <input type="text" name="eliminar" hidden value="<?php echo "$origen $informacion[$btn_value]"; ?>">
                    <button class="btn btn-sm btn-<?php echo $btn_color?>" type="submit" name="<?php echo $btn_name?>" value="<?php echo "$origen $informacion[$btn_value]"; ?>" id="eliminar" title="Eliminar"><i class="bi bi-<?php echo $btn_icon?>"></i></button>
                    </form>
                </td>
            </tr>
            <?php   }?>
        </tbody>
    </table>
    
</div>