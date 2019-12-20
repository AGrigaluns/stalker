<?php
include 'includes/init.php';

include 'includes/header.php';
?>

<div class="header">
    <h4>S.T.A.L.K.E.R. blog</h4>
</div>

<div class="row">
    <div class="leftColumn">
        <?php
        $typeId = 4;
        $stmt = $mysqli->prepare("SELECT title, sec_title, description, img FROM feed WHERE typeId = ? order by creation_date desc");
        $stmt->bind_param("i", $typeId);


        $stmt->execute();

        $stmt->bind_result($title, $secTitle, $newsDesc, $newsImg);

        while ($stmt->fetch()) : ?>
            <div class="card">
                <h2><?= $title ?></h2>
                <h5><?= $secTitle ?></h5>
                <div class="blogImg">
                    <img src="img/blog/<?= $newsImg ?>">
                    <p><?= nl2br($newsDesc) ?></p>
                </div>
            </div>
        <?php
        endwhile;


        $stmt->close();
        ?>
    </div>
    <div class="rightColumn">
        <div class="card">
            <h3>Popular</h3>
            <div class="blogImg">
                <a href="#">
                    <img id="blogPic" src="img/blog/forblog.jpg">
                </a>
                <p>About Stalker 1979</p>
            </div>
            <div class="blogImg">
                <a href="#">
                <img id="blogPic" src="img/blog/blogpic2.jpeg">
                </a>
                <p>Metro 2033</p>
            </div>
            <div class="blogImg">
                <a href="#">
                <img id="blogPic" src="img/news/stalker2.jpeg">
                </a>
                <p>Stalker 2</p>
            </div>
        </div>
        <div class="card">
            <h3>Follow Stalker</h3>
            <a href="#">More content here --></a>
        </div>
    </div>
</div>

<?php

include 'includes/footer.php';

?>

