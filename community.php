<?php

include 'includes/init.php';

/**
 * @todo : characters.php, communitiy.php and news.php are really alike. Check if a merge can be done
 */

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
$stmt->bind_param("i", $typeId);
$stmt->execute();
$stmt->bind_result($title, $sec_title, $pic, $description);
while ($stmt->fetch()) : ?>
<div class="community">
    <h2><?= $title ?></h2>
    <h5><?= $sec_title ?></h5>
    <div class="blogImg">
        <img src="<?= $pic ?>">
    </div>
    <p><?= $description ?></p>
</div>

<?php
endwhile;

$stmt->close();

?>

<?php
endif;
include 'includes/footer.php';
?>
