<table class="table" width="100%">
    <?php
    foreach ($tampildata as $rowMessage) :
    ?>
        <tr>
            <td>
                <h5><?= $rowMessage['sernama'] ?></h5>
                <p class="text-sm"><?= substr($rowMessage['serisi'], 0, 50) ?>...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </td>
        </tr>
    <?php endforeach ?>
</table>