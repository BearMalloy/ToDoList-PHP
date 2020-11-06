<div class="error">

    <?php if (!empty($params)) : ?>
        <?php switch ($params['action']) {
            case "show":
                echo "<p class='error__p'>Brak danych do wyswietlenia</p>";
                break;
            case "edit":
                echo "<p class='error__p'>brak danych do edytowania</p>";
                break;
        } ?>
    <?php endif; ?>
    <a href="/"><button class="error__btn">Powrót</button></a>
</div>