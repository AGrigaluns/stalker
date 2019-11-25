<?php

$menu = [
    ['label' => 'Home', 'url' => 'index.php'],
    ['label' => 'News', 'slug' => 'news', 'dropdown' =>
        [
            ['label' => 'Book news', 'url' => 'bookNews'],
            ['label' => 'Game news', 'url' => 'gameNews']
        ]
    ],
    ['label' => 'Contact', 'url' => 'contact.php'],
    ['label' => 'Shop', 'slug' => 'shop', 'dropdown' =>
        [
            ['label' => 'Books', 'url' => 'books'],
            ['label' => 'Games', 'url' => 'games'],
            ['label' => 'Wear', 'url' => 'wear']
        ]
    ],
    ['label' => 'Zone', 'slug' => 'characters', 'dropdown' =>
        [
            ['label' => 'Anomalies', 'url' => 'anomalies'],
            ['label' => 'Bandits', 'url' => 'bandits'],
            ['label' => 'Military', 'url' => 'military'],
            ['label' => 'Mutants', 'url' => 'mutants']
        ]
    ]

];

$menu2 = [
    ['label' => 'Story', 'url' => 'story.php'],
    ['label' => 'Blog', 'url' => 'blog.php']
]


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Javascript/php</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <h1>Stalker Deliverance</h1>
</header>
<nav>
    <div id="navBar">

        <?php foreach ($menu as $entry) : ?>
        <?php if (isset($entry['dropdown'])): ?>
            <div class="dropDown">
                <button class="dropBtn"><?= $entry['label'] ?>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="content">
                    <?php foreach ($entry['dropdown'] as $subEntry) : ?>
                        <a href="<?= $entry['slug'] ?>.html?type=<?= $subEntry['url'] ?>"><?= $subEntry['label'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else : ?>
            <a href="<?= $entry['url'] ?>"><?= $entry['label'] ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
        <form id="searchForm" action="search.php" method="POST">
            <input placeholder="Search..." type="search" id="search" name="stalker">
            <button id="btn2" type="submit">
                <i class='fas fa-search'></i>
            </button>
        </form>
    </div>
    <?php foreach ($menu2 as $entry) : ?>
        <div id="mySidenav" class="sidenav">
            <a href="<?= $entry['url'] ?>" id="story"><?= $entry['label'] ?></a>
            <?php endforeach; ?>
        </div>
</nav>
<div class="kods">

