<div class="show">
    <?php

    if (isset($params['data'])) {
        $row = $params['data'];
    }
    ?>
    <p class="show__p">Tytuł Notatki: <span class="show__p--span"><?= $row['title']; ?></span></p>
    <p class="show__p">Opis:<span class="show__p--span"> <?= $row['description']; ?> </span></p>
    <p class="show__p">Utworzono: <span class="show__p--span"><?= $row['created']; ?> </span></p>
    <div class="show__buttons">
        <a href="/?action=edit&id=<?= $row['id'] ?>"><button class="show__btn">Edytuj</button></a>
        <a href="/"><button class="show__btn">Wróć</button></a>
    </div>

</div>