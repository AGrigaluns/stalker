<?php
include 'includes/init.php';

include 'includes/header.php';
?>

<div class="header">
    <h4>S.T.A.L.K.E.R. blog</h4>
</div>

<!-- left side column of blog whit description and picture (in database called 'feed') -->

<div class="row">
    <div class="leftColumn">
        <?php
        $typeId = 4;
        $stmt = $mysqli->prepare("SELECT title, sec_title, description, img, creation_date FROM feed WHERE typeId = ? order by creation_date desc");
        $stmt->bind_param("i", $typeId);

        $stmt->execute();

        $stmt->bind_result($title, $secTitle, $newsDesc, $newsImg, $createdAtTS);

        while ($stmt->fetch()) :
            $createdAt = new DateTime($createdAtTS); ?>
            <div class="card">
                <span class="blogDate"><?= $createdAt->format('d/m/Y \a\t H:i:s') ?></span>
                <h2><?= $title ?></h2>
                <h5><?= $secTitle ?></h5>
                <div class="blogImg">
                    <img alt="database pictures" src="img/blog/<?= $newsImg ?>">
                    <p><?= nl2br($newsDesc) ?></p>
                </div>
            </div>
        <?php
        endwhile;


        $stmt->close();
        ?>

        <!-- right side column 'popular' with img links to posts on left side -->
    </div>
    <div class="rightColumn">
        <div class="card">
            <h3>Popular</h3>
            <div class="blogImg">
                <a href="#">
                    <img alt="stalker movie" id="blogPic" class="aboutStalker" src="img/blog/forblog.jpg">
                </a>
                <p>About Stalker 1979</p>
            </div>
            <div class="blogImg">
                <a href="#">
                <img alt="metro 2033 game" id="blogPic" class="metro" src="img/blog/blogpic2.jpeg">
                </a>
                <p>Metro 2033</p>
            </div>
            <div class="blogImg">
                <a href="#">
                <img alt="upcoming stalker game" id="blogPic" class="secStalker" src="img/news/stalker2.jpeg">
                </a>
                <p>Stalker 2</p>
            </div>
        </div>

        <!-- 'More content here' column -->
        <div class="card">
            <h3>Follow Stalker</h3>
            <a href="#">More content here --></a>
        </div>
    </div>
</div>

<?php

include 'includes/footer.php';

?>

