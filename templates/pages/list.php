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
        echo '<div class="alert alert-success" role="alert">
  Pomyślnie dodano nową notatkę.
</div>';
        break;
    case 'edited':
        echo '<div class="alert alert-success" role="alert">
  Pomyślnie zaktualizowano notatkę.
</div>';
        break;
} ?>

<form method="get" action="/" class="tools p-3">
    <div class="search">
        <label>
            <h5>Wyszukaj:</h5>
            <input type="text" class="form-control" name="phrase" value="<?= $phrase ?>">
        </label>
    </div>
    <div class="sort">
        <h4>Sortuj po:</h4>
        <label>
            Tytule:
            <input name="sort_by" type="radio" value="title"  <?php echo $sortBy === 'title' ? 'checked' : '' ?>>
        </label>
        <label class="sort__label"> Dacie:
            <input name="sort_by" type="radio" value="date"  <?php echo $sortBy === 'date' ? 'checked' : '' ?>>
        </label>
    </div>
    <div>
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
    <input type="submit" class="btn btn-primary" value="Wyślij">
</form>

<table class="table mt-3" cellpadding="0" cellspacing="0" border="0">
    <thead class="bg-primary text-white text-uppercase">
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
            <a class="d-inline-block" href="/?action=show&id=' . $row['id'] . '">
            <button class="btn btn-primary mr-1 mb-1">Szczegóły</button>
            </a>
            <a href="/?action=delete&id=' . $row['id'] . '">
            <button class="btn btn-primary">Usuń</button>
            </a>
            </th></tr>';
        }

        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" class="w-100 m-auto">
    <ul class="pagination d-flex justify-content-center">
        <?php if ($pageNumber > 1) : ?>
            <li class="page-item"> <a class="page-link" href="/?page=<?= $pageNumber - 1 ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>">Previous</a></li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
            <li class="page-item"><a class="page-link" href="/?page=<?= $i ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <?php if ($pageNumber < $pageCount) : ?>
            <li class="page-item"> <a class="page-link" href="/?page=<?= $pageNumber + 1 ?>&page_size=<?= $pageSize ?>&sort_by=<?= $sortBy ?>&sort_order=<?= $sortOrder ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>