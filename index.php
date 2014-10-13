<?php
// Start the session
session_start();
?>

<?php
    function renderBook($book)
    {
        if ($book == 'index') {
            include sprintf('books/%s.php', $book);
        } else {
            include sprintf('books/book-%d.php', $book);
        }
    }

    function showFlash()
    {
        if (isset($_SESSION['message'])) {
            return $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pan Tadeusz</title>
    <meta charset="UTF-8">
</head>
<body>
    <div>
        <?= showFlash() ?>
    </div>
    <div>
        <h1>Adam Mickiewicz</h1>

        <h2>PAN TADEUSZ</h2>

        <p class="tytul">
        czyli<br>
        OSTATNI ZAJAZD NA LITWIE<br>
        HISTORIA SZLACHECKA Z ROKU 1811 i 1812<br>
        WE DWUNASTU KSIĘGACH WIERSZEM
        </p>

    </div>
    <div>
        <ul>
            <li><a href="?book=index">Spis Ksiąg</a></li>
            <?php for ($i = 1; $i <= 12; $i++) { ?>
            <li>
                <a href="<?= sprintf('?book=%d', $i) ?>">Księga <?= $i ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div>
        <?php renderBook($_GET['book']) ?>
    </div>
    <?php include sprintf('reflection/list.php', $book); ?>
</body>
</html>
