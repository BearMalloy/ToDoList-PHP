
<div class="card w-50 m-auto">
    <div class="card-header">
        <h5>Informacja o usunięciu notatki.</h5>
    </div>
    <div class="card-body">
        <p class="card-text">Notatka o id <span class="text-danger font-weight-bold"><?php if (isset($params)) : ?>
                    <?php echo $params['id']; ?>
                <?php endif; ?>
        </span> została usunięta.</p>
        <a href="/" class="btn btn-primary">Powrót</a>
    </div>
</div>