<?php
$phrase = $params['data']['phrase'] ?? null;

$sortBy = $params['data']['sort_by'] ?? "";

$sortOrder = $params['data']['sort_order'] ?? "";

$pageSize = $params['data']['page_size'] ?? "";

$pageNumber = $params['data']['page'] ?? "";

$pageCount = $params['page_count'] ?? "";

$after = $params['after'] ?? "";
?>

<?php switch ($after) {
    case 'created':
        echo "<span class='message'>Dodano nową notatkę!</span>";
        break;
    case 'edited':
        echo "<span class='message'>Zaktualizowano dane w notatce!</span>";
        break;
} ?>
<form method="get" action="/" class="tools">
    <div class="search">
        <label>
            Wyszukaj:
            <input type="text" class="search__input" name="phrase" value="<?= $phrase ?>">
        </label>
    </div>
    <div class="sort">
        <h4>Sortuj po:</h4>
        <label class="sort__label">
            Tytule:
            <input name="sort_by" type="radio" value="title" class="sort__radio" <?php echo $sortBy === 'title' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label"> Dacie:
            <input name="sort_by" type="radio" value="date" class="sort__radio" <?php echo $sortBy === 'date' ? 'checked' : '' ?>>
        </label>
    </div>
    <div class="sort">
        <h4>
            Kierunek sortowania:
        </h4>
        <label class="sort__label"> Rosnąco:
            <input name="sort_order" type="radio" value="asc" class="sort__radio" <?php echo $sortOrder === 'asc' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label"> Malejąco:
            <input name="sort_order" type="radio" value="desc" class="sort__radio" <?php echo $sortOrder === 'desc' ? 'checked' : '' ?>>
        </label>
    </div>
    <div class="sort">
        <h4>
            Rozmiar paczki:
        </h4>
        <label class="sort__label">1
            <input type="radio" name="page_size" value=1 class="sort__radio" <?php echo $pageSize === '1' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label">5
            <input type="radio" name="page_size" value=5 class="sort__radio" <?php echo $pageSize === '5' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label">10
            <input type="radio" name="page_size" value=10 class="sort__radio" <?php echo $pageSize === '10' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label">25
            <input type="radio" name="page_size" value=25 class="sort__radio" <?php echo $pageSize === '25' ? 'checked' : '' ?>>
        </label>
    </div>
    <input type="submit" class="tools__button" value="Wyślij">
</form>

<table class="table" cellpadding="0" cellspacing="0" border="0">
    <thead>
        <tr class="table__main-tr">
            <th>id</th>
            <th>tytuł</th>
            <th>data</th>
            <th>opcje</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rows = $params['rows'];
        foreach ($rows as $row) {
            echo '<tr>
            <th>' . $row['id'] . '</th>' .
                '<th>' . $row['title'] . '</th>' .
                '<th>' . $row['created'] . '</th>' .
                '<th>
            <a href="/?action=show&id=' . $row['id'] . '">
            <button class="table__details">Szczegóły</button>
            </a>
            <a href="/?action=delete&id=' . $row['id'] . '">
            <button class="table__details">Usuń</button>
            </a>
            </th></tr>';
        }

        ?>
    </tbody>
</table>
<ul class="pagination">
    <?php if ($pageNumber > 1) : ?>
        <li> <a href="/?page=<?= $pageNumber - 1 ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>"><button class="pagination__btn pagination__btn--arrow">
                    <-</button> </a> </li> <?php endif; ?> <?php for ($i = 1; $i <= $pageCount; $i++) : ?> <li><a href="/?page=<?= $i ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>"><button class=pagination__btn><?= $i ?></button></a></li>
    <?php endfor; ?>
    <?php if ($pageNumber < $pageCount) : ?>
        <li><a href="/?page=<?= $pageNumber + 1 ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>"><button class="pagination__btn pagination__btn--arrow">-></button></a></li>
    <?php endif; ?>
</ul>