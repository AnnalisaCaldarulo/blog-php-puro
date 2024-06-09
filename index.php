<?php
//!Impostazione del percorso del database:
//*$root = __DIR__; //Questa riga ottiene il percorso della directory corrente del file PHP utilizzando la magic constant __DIR__.
//*$db = $root . '/data/data.sqlite'; //Costruisce il percorso completo del file del database SQLite. 
//!Connessione al database:
//*$dsn = 'sqlite:' . $db; //Crea una stringa di connessione PDO (PHP Data Objects) che specifica il tipo di database (SQLite) e il suo percorso ($db).
//!per evitare ripetizioni:
require_once 'lib/common.php';
require_once 'lib/components.php';

$pdo = getPDO();
//*$pdo = new PDO($dsn); //Tenta di stabilire una connessione al database utilizzando la stringa di connessione appena creata ($dsn).

try {
    $stmt = $pdo->query(
        'SELECT
      id, title, created_at, body
    FROM
      post
    ORDER BY
      created_at DESC'
    );
} catch (PDOException $e) {
    echo "Errore durante l'esecuzione della query: " . $e->getMessage();
    // Potrebbero essere aggiunti qui ulteriori codici di gestione errori specifici
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body class="bg-body-secondary vh-100">
    <?php echo returnNav() ?>
    <?php require 'templates/title.php' ?>
    <main class="container-fluid h-100">
        <div class="row align-items-center h-100 justify-content-center">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <!-- PDO::FETCH_ASSOC specifica che il risultato deve essere restituito come un array associativo, dove le chiavi dell'array corrispondono ai nomi dei campi della tabella selezionata nella query. -->
                <div class="col-12 col-md-4 mx-auto  d-flex flex-column align-items-center">
                    <?php echo returnArticle($row) ?>
                </div>
            <?php endwhile ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>