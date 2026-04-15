<form method="POST" action="/offres">
    @csrf

    <input name="title" placeholder="Titre">
    <textarea name="description" placeholder="Description"></textarea>
    <input name="location" placeholder="Lieu">

    <select name="type">
        <option value="stage">Stage</option>
        <option value="alternance">Alternance</option>
    </select>

    <button type="submit">Créer offre</button>
</form>