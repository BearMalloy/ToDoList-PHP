<?php if (isset($params)) : ?>
    <span class="create-title">edycja notatki</span>
    <form class="form-create" method="post" action="/?action=create">
        <label for="title" class="form-create__title">
            Tytuł <span class="form-create__title--span">*</span>
            <input type="text" name="title" required class="form-create__title--input" value="<?= $params['title'] ?>">
        </label>
        <label for="description" class="form-create__description"> Opis
            <textarea name="description" cols="30" rows="10" class="form-create__description--textarea"><?= $params['description'] ?></textarea>
        <?php endif; ?>
        </label>
        </label>
        <br>
        <input type="submit" class="form-create__button" value="Edytuj">
    </form>