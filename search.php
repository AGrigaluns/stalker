<?php

ini_set('display_errors', E_ALL);

include 'includes/databaseconnect.php';

include 'includes/header.php';


if (isset($_POST['stalker'])) {
    $stalker = $_POST["stalker"];

}

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
    $request = '%' . $stalkerPart . '%';

    $stmt = $mysqli->prepare("SELECT id, char_name, char_description, picture 
                                    FROM entities 
                                    WHERE char_name LIKE ? OR char_description LIKE ?");

    $stmt->bind_param("ss", $request, $request);

    $stmt->execute();

    $stmt->bind_result($charId, $charName, $charDesc, $charPic);

    while ($stmt->fetch()) {
        $entryId = 'char_'.$charId;
        if (isset($results[$entryId])) {
            $results[$entryId]['score']++;
            $results[$entryId]['description'] = preg_replace('/('.$stalkerPart.')/i', '<strong>'.$stalkerPart.'</strong>', $results[$entryId]['description']);
        } else {
            $results[$entryId] = [
                'title' => $charName,
                'description' => preg_replace('/('.$stalkerPart.')/i', '<strong>'.$stalkerPart.'</strong>', $charDesc),
                'picture' => $charPic,
                'score' => 1
            ];
        }
    }

    /* close statement */
    $stmt->close();
}
/* Bonus sort $results with e.g. usort*/

function cmp($result, $results) {
    if ($result == $results) {
        return 0;
    }
    return ($result < $results) ? -1 : 1;
}

$result = array([3, 2, 5, 6, 1]);

usort($result, "cmp");




/**
 * - explode the string stalker
 * - loop with while or foreach throught the "parts" of exploded string
 * - search each time for the "part"
 */
foreach ($results as $result) : ?>
    <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div class="searchTest">
        <h2><?= $result['title'] ?></h2>
        <img id="rad" src="img/<?= $result['picture'] ?>">
        <p><?= $result['description'] ?></p>
    </div>
<?php endforeach;


/* end of loop */

include 'includes/footer.php';

?>