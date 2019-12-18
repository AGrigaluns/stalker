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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Javascript/php</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<header>
    <h1>Stalker Deliverance</h1>
</header>
<nav id="navBar">
    <button type="button" id="burger">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="menu-bar">
        <?php foreach ($menu as $entry) : ?>
            <?php if (isset($entry['dropdown'])): ?>
                <li class="menu-entry">
                        <span class="dropBtn">
                            <?= $entry['label'] ?>
                            <i class="fa fa-caret-down"></i>
                        </span>
                    <div class="dropDown">
                        <ul>
                            <?php foreach ($entry['dropdown'] as $subEntry) : ?>
                                <li class="menu-entry"><a
                                            href="<?= $entry['slug'] ?>.html?type=<?= $subEntry['url'] ?>"><?= $subEntry['label'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php else : ?>
                <li class="menu-entry"><a href="<?= $entry['url'] ?>"><?= $entry['label'] ?></a></li>
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
    <button class="registration"><a href="registration.php"></a>Sign in</button>
</nav>
<div class="kods">
    <div id="alerts"></div>