


<?php if (isset($params['data'])): ?>
<?php $row = $params['data'] ?>


<div class="jumbotron">
    <h1 class="font-weight-normal">Tytuł Notatki: <span class="font-weight-bold"><?= $row['title']; ?></h1>
    <p class="lead">Utworzono: <span class="font-weight-bold"> <?= $row['created']; ?> </span></p>
    <hr class="my-4">
    <h3>Opis:</h3>
    <p><?=$row['description']?></p>
    <a class="btn btn-outline-primary btn-lg" href="/?action=edit&id=<?= $row['id'] ?>" role="button">Edycja</a>
    <a class="btn btn-primary btn-lg" href="/" role="button">Powrót</a>
</div>
<?php endif; ?>
