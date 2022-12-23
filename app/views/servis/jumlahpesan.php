<?php
$total = 0;
foreach ($tampildata->getResultArray() as $rowMessage) :
?>
<?php $total++; ?>
<?php endforeach ?>

<?php
echo $total;
?>