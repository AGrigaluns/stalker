<?php
include 'includes/init.php';

include 'includes/header.php';
?>

<div class="header-img">
    <h4>S.T.A.L.K.E.R. Art</h4>
</div>

<?php

$id = 1;
$stmt = $mysqli->prepare("SELECT pictures FROM img_grid");

$stmt->execute();

$stmt->bind_result($pictures);

while ($stmt->fetch()) : ?>

<div class="row">
    <div class="column">
        <img src="img/<?= $pictures ?>">
    </div>
</div>


<div class="row1">
    <div class="column">
        <img src="img/index.jpeg">
    </div>
</div>

<div class="row2">
    <div class="column">
        <img src="img/index2.jpeg">
    </div>
</div>

<div class="row3">
    <div class="column">
        <img src="img/index3.jpeg">
    </div>
</div>

<div class="row4">
    <div class="column">
        <img src="img/index4.jpeg">
    </div>
</div>

<div class="row5">
    <div class="column">
        <img src="img/index5.jpeg">
    </div>
</div>

<div class="row6">
    <div class="column">
        <img src="img/index6.jpeg">
    </div>
</div>

<div class="row7">
    <div class="column">
        <img src="img/index7.jpeg">
    </div>
</div>

<div class="row8">
    <div class="column">
        <img src="img/index8.jpeg">
    </div>
</div>

<?php

endwhile;

$stmt->close();



include 'includes/footer.php';
?>
