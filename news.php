<?php

ini_set('display_errors', E_ALL);

include 'includes/databaseconnect.php';


$type = htmlentities($_GET['type']);

$data = ['title' => $type];

$typeId = null;
$typeName = null;
$stmt = $mysqli->prepare("SELECT id, name FROM news WHERE slug = ?");
$stmt->bind_param("s", $type);

$stmt->execute();

$stmt->bind_result($typeId, $typeName);

$stmt->fetch();

$stmt->close();

include 'includes/header.php';

if ($typeId === null) :
    ?>
    this type does not exist....
<?php else : ?>
    <?php

    $title  = null;
    $newsDesc = null;
    $newsImg = null;
    $stmt = $mysqli->prepare("SELECT title, description, img FROM feed WHERE id = ?");
    print_r($mysqli->error);
    $stmt->bind_param("i", $typeId);


    $stmt->execute();

    $stmt->bind_result($title, $newsDesc, $newsImg);

    while ($stmt->fetch()) : ?>
        <div class="news">
            <h2><?= $title ?></h2>
            <img id="newsPic" src="img/<?= $newsImg ?>">
            <p><?= nl2br($newsDesc) ?></p>
        </div>
    <?php
    endwhile;


    $stmt->close();
    ?>

<?php
endif;
include 'includes/footer.php';

?>

