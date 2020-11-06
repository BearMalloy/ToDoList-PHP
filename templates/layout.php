<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/final.min.css?v=1.1">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1 class="header__h1">To do app <i class="fab fa-the-red-yeti"></i></h1>
        </header>
        <main class="main">
            <aside class="aside">
                <ul class="aside__ul">
                    <li class="aside__li"><a href="/">Strona główna</a></li>
                    <li class="aside__li"><a href="/?action=create">Nowa notatka</a></li>
                </ul>
            </aside>
            <section class="section">
                <?php if (isset($page)) {
                    require_once "pages/$page.php";
                } ?>
            </section>
        </main>
        <footer class="footer"></footer>
    </div>
    <script src="https://kit.fontawesome.com/9e7d514733.js" crossorigin="anonymous"></script>
</body>

</html>