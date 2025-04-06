<div class="table-responsive">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <?php foreach ($cabecera as $campo) echo "<th scope='col'>$campo</th>"; ?>
                <th scope='col'></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $informacion){ ?>
            <tr>
                <?php foreach ($informacion as $campo) echo "<td>$campo</td>"; ?>
                <td>
                <?php if($informacion["5"]=="Pendiente"){ ?>    <button class="btn btn-sm btn-<?php echo $btn_color?> info" name="<?php echo $btn_name?>" data-bs-toggle="modal" data-bs-target="#<?php echo $modal?>"><i class="bi bi-<?php echo $btn_icon?>" title="Modificar"></i></button><?php } ?>
                </td>
            </tr>
            <?php  }?>
        </tbody>
    </table>
</div>