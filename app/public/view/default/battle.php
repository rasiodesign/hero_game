<div>Loveste : <?php echo $value['loveste'] ?></div>
<div>Primeste : <?php echo $value['primeste'] ?></div>
<div>Damage : <?php echo $value['damage'] ?></div>

<?php if (isset($value['lucky'])) { ?>
    <div>Lucky : <?php echo $value['lucky'] ?></div>
<?php } ?>
<?php if (isset($value['rapid'])) { ?>
    <div>Rapid Strike : <?php echo $value['rapid'] ?></div>
<?php } ?>
<?php if (isset($value['magic'])) { ?>
    <div>Magic shield : <?php echo $value['magic'] ?></div>
<?php } ?>

<div><?php echo $value['first']; ?></div>
<div><?php echo $value['second']; ?></div>
<hr></hr>