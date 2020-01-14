<?php
include 'includes/init.php';

/**
 * @todo : characters.php, communitiy.php and news.php are really alike. Check if a merge can be done (e.g. using a function that takes the query and sends back results)
 */



$type = htmlentities($_GET['type']);

$data = ['title' => $type];

/**
 * Takes all character types from database and puts in Zone dropdown to access
 */

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
<?php else :

    /**
     *  Displays all entities for each character type with typeId
     */

    $charName = null;
    $charDesc = null;
    $charPic = null;
    $stmt = $mysqli->prepare("SELECT char_name, char_description, picture FROM entities WHERE typeId = ?");
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
endif;
include 'includes/footer.php';
