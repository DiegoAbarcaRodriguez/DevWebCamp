<h2 class="dashboard__heading"> <?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    <?php if (empty($registros)) { ?>
        <p class="text-center">No Hay Registros Aún</p>
    <?php } else { ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th class="table__th">Nombre</th>
                    <th class="table__th">Email</th>
                    <th class="table__th">Plan</th>
                </tr>
            </thead>

            <tbody class="table__body">
                <?php foreach ($registros as $registro) { ?>
                    <tr class="table__tr">
                        <td class="table__td"> <?php echo $registro->usuario->nombre . ' ' . $registro->usuario->apellido ?></td>
                        <td class="table__td"> <?php echo $registro->usuario->email?></td>
                        <td class="table__td"> <?php echo $registro->paquete->nombre?></td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>