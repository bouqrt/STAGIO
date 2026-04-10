<form method="POST" action="/entreprise/profile">
    @csrf

    <input name="name" placeholder="Nom entreprise">
    <input name="email" placeholder="Email">
    <input name="phone" placeholder="Téléphone">
    <input name="address" placeholder="Adresse">
    <textarea name="description" placeholder="Description"></textarea>

    <button type="submit">Créer profil</button>
</form>