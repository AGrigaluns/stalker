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
    ],
    ['label' => 'Story', 'url' => 'news.php?type=story'],
    ['label' => 'Blog', 'url' => 'blog.php'],
    ['label' => 'Pictures', 'url' => 'imgPage.php']
];
$totalQty = 0;

if (isset($_SESSION) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    foreach ($_SESSION["cart"] as $item) {
        $totalQty += $item['qty'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<header>
    <h1>Stalker Deliverance</h1>
</header>
<nav id="navBar" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php foreach ($menu as $entry) : ?>
            <?php if (isset($entry['dropdown'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $entry['label'] ?>
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <?php foreach ($entry['dropdown'] as $subEntry) : ?>
                                    <a href="<?= $entry['slug'] ?>.html?type=<?= $subEntry['url'] ?>" class="dropdown-item"><?= $subEntry['label'] ?></a>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a href="<?= $entry['url'] ?>"><?= $entry['label'] ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <form id="searchForm" action="search.php" method="POST">
                <input placeholder="Search..." type="search" id="search" name="stalker">
        <button id="btn2" type="submit">
            <i class='fas fa-search'></i>
        </button>
    </form>
    <button id="shopBtn" type="submit">
        <a href="cart.php">
        <i class="fas fa-shopping-cart"></i>
            <span id="amountInCart"><?= $totalQty>0 ? $totalQty : '' ?></span>
        </a>
    </button>
    <button class="registration"><a href="registration.php">Sign in</a></button>
    </div>
</nav>
<div class="kods">
    <div id="alerts"></div>