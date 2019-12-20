<?php

ini_set('display_errors', E_ALL);

include 'includes/init.php';


$type = htmlentities($_GET['type']);

$data = ['title' => $type];

$typeId = null;
$typeName = null;
$stmt = $mysqli->prepare("SELECT id, name FROM character_type WHERE name = ?");
$stmt->bind_param("s", $type);

/* execute query */
$stmt->execute();

/* bind result variables */
$stmt->bind_result($typeId, $typeName);

/* fetch value */
$stmt->fetch();

/* close statement */
$stmt->close();

include 'includes/header.php';

if ($typeId === null) :
?>
    this type does not exist....
<?php else : ?>
<?php

    $charName = null;
    $charDesc = null;
    $charPic = null;
    $stmt = $mysqli->prepare("SELECT char_name, char_description, picture FROM entities WHERE typeId = ?");
    print_r($mysqli->error);
    $stmt->bind_param("i", $typeId);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($charName, $charDesc, $charPic);

    while ($stmt->fetch()) : ?>
        <div class="characters">
            <h2><?= $charName ?></h2>
            <img id="rad" src="img/zone/<?= $charPic ?>">
            <p><?= $charDesc ?></p>
        </div>
    <?php
    endwhile;

    /* close statement */
    $stmt->close();
    ?>

<?php
endif;
include 'includes/footer.php';

?>
