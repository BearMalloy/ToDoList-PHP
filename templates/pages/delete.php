<div class="delete">
    <h1 class="delete__h1">Notatka o id <span class="delete__h1 delete__h1--span"><?php if (isset($params)) : ?>
                <?php echo $params['id']; ?>
            <?php endif; ?>
        </span> została usunięta.</h1>

    <a href="/"><button class="delete__btn">Powrót</button></a>
</div>