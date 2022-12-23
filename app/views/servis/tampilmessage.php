<table class="table table-hover" width="100%">
    <?php
    foreach ($tampildata as $rowMessage) :
    ?>
        <tr>
            <td>
                <a href="#" onclick="lihat(<?= $rowMessage['serid'] ?>)">
                    <h5><?= $rowMessage['sernama'] ?></h5>
                    <p class="text-sm"><?= substr($rowMessage['serisi'], 0, 50) ?>...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<script>
    function lihat(id) {
        alert(id);
    }
</script>