<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/style/style.css">
    <script src="./Public/script/script.js"defer></script>
    <title>Add Account</title>
</head>
<body>
    <form action="" method="post">
        <h1>Ajouter un compte</h1>
        <label for="pseudo">Saisir votre pseudo</label>
        <input type="text" name="pseudo">
        <label for="password">Saisir votre mot de passe</label>
        <input type="password" name="password">
        <label for="confirm">Confirmer votre mot de passe</label>
        <input type="password" name="confirm">
        <label for="code">Saisir votre code</label>
        <input type="text" name="code">
        <input type="submit" value="Ajouter" name="submit">
        <h1><?= $msg?></h1>
    </form>
</body>
</html>