<?php
include 'includes/init.php';
include 'includes/header.php';

/**
 * @param mysqli_stmt $stmt
 * @param string $stalkerPart
 * @return array|searchable[]
 */
function setResultFromStmt(mysqli_stmt $stmt, $stalkerPart, $classType) {
    /** @var $results searchable[] */
    $results = [];
    $request = '%' . $stalkerPart . '%';
    $stmt->bind_param("ss", $request, $request);

    $stmt->execute();

    $stmt->bind_result($charId, $charName, $charDesc, $charPic);

    while ($stmt->fetch()) {
        $resultObject = new $classType($charName, $charDesc, $charPic);
        if (!isset($results[$charId])) {
            $results[$charId] = $resultObject;
        }
        $results[$charId]->highlightResult($stalkerPart);
    }

    return array_values($results);
}

if (isset($_POST['stalker'])) {
    $stalker = $_POST["stalker"];

}

$_SESSION['searchterms'][] = $stalker;

echo 'Results for '. $stalker;

$hint = "";

if ($stalker !== "") {
    $stalker = strtolower($stalker);
    $len=strlen($stalker);
}

// this variable will store results
$results = [];

$stalkerParts = explode(' ' , $stalker);
$i = 0;
$q = ' ';
foreach ($stalkerParts as $stalkerPart) {

    $results = [];

    $stmt = $mysqli->prepare("SELECT id, char_name, char_description, picture 
                                    FROM entities 
                                    WHERE char_name LIKE ? OR char_description LIKE ?");

    $newResults = setResultFromStmt($stmt, $stalkerPart, "entity");

    $results = array_merge($results, $newResults);

    /* close statement */
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT id, title, description, img 
                                    FROM feed 
                                    WHERE title LIKE ? OR description LIKE ?");

    $newResults = setResultFromStmt($stmt, $stalkerPart, "feed");

    $results = array_merge($results, $newResults);
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT id, product_name, product_description, picture 
                                    FROM products 
                                    WHERE product_name LIKE ? OR product_description LIKE ?");

    $newResults = setResultFromStmt($stmt, $stalkerPart, "product");

    $results = array_merge($results, $newResults);
    $stmt->close();


}

/* Bonus sort $results with e.g. usort*/
/**
 * @param $a searchable
 * @param $b searchable
 * @return int
 */
function cmp($a, $b) {
    if ($a->getScore() == $b->getScore()) {
        return 0;
    }
    return ($a->getScore() > $b->getScore()) ? -1 : 1;
}

usort($results, "cmp");




/**
 * - explode the string stalker
 * - loop with while or foreach throught the "parts" of exploded string
 * - search each time for the "part"
 * @var $result searchable
 */
foreach ($results as $result) : ?>
    <div class="searchTest">
        <h2><?= $result->getName() . ' ' . $result->getScore() ?></h2>
        <?php if (!empty($result->getPicture()) && file_exists('img/'.$result->getImgPath().'/'.$result->getPicture())) : ?>
            <img id="rad" src="img/<?= $result->getImgPath() ?>/<?= $result->getPicture() ?>">
        <?php endif; ?>
        <p><?= $result->getDescription() ?></p>
    </div>
<?php endforeach;


/* end of loop */

include 'includes/footer.php';

?>