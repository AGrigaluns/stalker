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
<div class="imgGrid">
    <div class="column">
        <img src="img/<?= $pictures ?>">
    </div>
</div>

<?php
endwhile;

$stmt->close();

include 'includes/footer.php';
?>
