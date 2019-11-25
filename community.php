<?php

ini_set('display_errors', E_ALL);

include 'includes/databaseconnect.php';

$type = htmlentities($_GET['type']);

$data = ['title' => $type];

$typeId = null;
$typeName = null;
$stmt = $mysqli->prepare("SELECT id, name FROM community WHERE name = ?");
$stmt->bind_param("s", $type);

$stmt->execute();

$stmt->bind_result($typeId, $typeName);

$stmt->fetch();

$stmt->close();

include 'includes/header.php';

if ($typeId === null) :
?>
        this not exists...

<?php else : ?>
    <?php

$pic = null;
$title = null;
$sec_title = null;
$description = null;
$stmt = $mysqli->prepare("SELECT title, sec_title, pic FROM community_types WHERE id = ?");
print_r($mysqli->error);
$stmt->bind_param("i", $typeId);
$stmt->execute();
$stmt->bind_result($title, $sec_title, $pic, $description);
while ($stmt->fetch()) : ?>
<div class="community">
    <h4><?= $title ?></h4>
    <h2><?= $sec_title ?></h2>
    <p><?= $description ?></p>
    <img src="<?= $pic ?>">
</div>

<?php
endwhile;

$stmt->close();

?>

<?php
endif;
include 'includes/footer.php';
?>
