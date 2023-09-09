<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
<body>
    <div>
        <h1>Doc : Comment utiliser l'API BitChest</h1>
        <h2>Admin</h2>
        <div style="margin-left: 15px">
            <p>Afficher les Users : <strong>(GET) http://localhost:8000/api/users</strong></p>
            <p>Créer un Users : <strong>(POST) http://localhost:8000/api/users</strong>  avec pour paramètres : { username, password, role }</p>
            <p>Modifier un Users : <strong>(PUT) http://localhost:8000/api/users/{user_id}</strong>  avec pour paramètres : { username, role }</p>
            <p>Supprimer un Users : <strong>(DELETE) http://localhost:8000/api/users/{user_id}</strong></p>
            <p>Afficher les Cryptos : <strong>(GET) http://localhost:8000/api/cryptoValues</strong></p>
            <p>Afficher les details d'une Crypto : <strong>(GET) http://localhost:8000/api/cryptoValues/{crypto_id}</strong></p>
        </div>
        <h2>Client</h2>
        <div style="margin-left: 15px">
            <p>Il est possible d'afficher le profil d'un User avec toutes ses crypto seulement sur le site car la requête récupère l'id de l'Auth</p>
        </div>
    </div>
</body>
</html>
<style>
p {
    font-size: 1.2rem;
}
</style>
