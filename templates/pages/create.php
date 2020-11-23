
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-primary">
        <h5 class="text-white text-center">Dodawanie nowej notatki</h5>
    </ol>
</nav>
<form method="post" action="/?action=create">
    <div class="form-group">
        <label><h5>Tytuł:</h5></label>
        <input name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label><h5>Opis:</h5></label>
        <textarea class="form-control" name="description" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-lg btn-primary d-block m-auto">Dodaj</button>
</form>
