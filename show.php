<?php
require_once 'lib/common.php';

// Get the post ID
if (isset($_GET['post_id'])) //associative array of variables passed to the current script via the URL parameters.
{
    $postId = $_GET['post_id'];
} else {
    // So we always have a post ID var defined
    $postId = 0;
}

$pdo = getPDO();
//*$pdo = new PDO($dsn); //Tenta di stabilire una connessione al database utilizzando la stringa di connessione appena creata ($dsn).

try {
    $stmt = $pdo->query(
        'SELECT
      title, created_at, body
    FROM
      post
    WHERE
        id = :id'
    );
} catch (PDOException $e) {
    echo "Errore durante l'esecuzione della query: " . $e->getMessage();
    // Potrebbero essere aggiunti qui ulteriori codici di gestione errori specifici
}

$result = $stmt->execute(
    array('id' => $postId,)
);
if ($result === false) {
    throw new Exception('There was a problem running this query');
}
// Let's get a row
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog PHP |<?php echo htmlEscape($row['title']) ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="container-fluid bg-body-secondary vh-100">
        <div class="row align-items-center h-100 justify-content-center">

            <!-- PDO::FETCH_ASSOC specifica che il risultato deve essere restituito come un array associativo, dove le chiavi dell'array corrispondono ai nomi dei campi della tabella selezionata nella query. -->
            <article class="col-12 col-md-8 bg-info d-flex flex-column align-items-center text-start">
                <h1>
                    <?php echo htmlEscape($row['title']) ?>
                </h1>
                <div>
                    <?php echo $row['created_at'] ?>
                </div>
                <p>
                    <?php echo htmlEscape($row['body']) ?>
                </p>
            </article>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>