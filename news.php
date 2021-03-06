<?php

include 'includes/init.php';

/**
 * @todo : characters.php, communitiy.php and news.php are really alike. Check if a merge can be done
 */

$type = htmlentities($_GET['type']);

$data = ['title' => $type];

/**
 * selects all names from news and display it in each dropdown
 */

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

    /**
     * display a news dropdown from feed
     */

    $stmt = $mysqli->prepare("SELECT  title, sec_title, description, img, creation_date FROM feed WHERE typeId = ?");
    $stmt->bind_param("i", $typeId);


    $stmt->execute();

    $stmt->bind_result($title, $secTitle, $newsDesc, $newsImg, $createdAtTS);

    while ($stmt->fetch()) :
        $createdAt = new DateTime($createdAtTS); ?>
        <div class="news">
            <span class="date"><?= $createdAt->format('d/m/Y \a\t H:i:s') ?></span>
            <h2><?= $title ?></h2>
            <h5><?= $secTitle ?></h5>
            <img id="newsPic" src="img/news/<?= $newsImg ?>">
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

