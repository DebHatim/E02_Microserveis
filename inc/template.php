<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Ticket</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap');

    body {
      margin: 0;
      padding: 20px;
      background: #f4f4f4;
      font-family: 'Montserrat', sans-serif;
    }

    header,
    main,
    footer {
      border: 2px solid black;
      margin: 10px 0;
    }

    header {
      display: flex !important;
      background-color: #e50914;
      color: white;
      text-align: center;
      padding: 5px;
    }

    header .qrcode {
      width: 10em !important;
    }

    header h1 {
      margin: 0;
    }

    main {
      display: flex !important;
    }

    main section {
      width: 100%;
      padding: 10px;
    }

    main p {
      margin: 10px;
    }

    main p span {
      font-weight: bold;
    }

    footer {
      padding-top: 15px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div id="container">
    <header>
      <h1><?= htmlspecialchars($nom) ?></h1>
    </header>

    <main>
      <section id="info" style="display: flex !important;"> 
        <p><span class="label">Data:</span> <?= htmlspecialchars($data) ?></p>
        <p><span class="label">Horari:</span> <?= htmlspecialchars($horainici) ?> - <?= htmlspecialchars($horafinal) ?></p>
        <p><span class="label">Lloc:</span> <?= htmlspecialchars($lloc) ?></p>
        <p><span class="label">Preu:</span> <?= htmlspecialchars($preu) ?> €</p>
        <p><span class="label">Tipus:</span> <?= htmlspecialchars($tipus) ?></p>
        </div>
      </section>

      <section id="seating">
        <div class="qrcode"><?= $cqr ?></div>
        <p><span class="label">Fila:</span> <?= htmlspecialchars($fila) ?></p>
        <p><span class="label">Seient:</span> <?= htmlspecialchars($seient) ?></p>
      </section>

      <section id="media">
        <img src="<?= $poster ?>" alt="Cartel del espectáculo" style="width: 50mm; height: auto;">
      </section>
    </main>

    <footer>
      <div class="barcode"><?= $cbarres ?></div>
      <p>© <?= htmlspecialchars($data) ?> <?= htmlspecialchars($nom) ?>.</p>
    </footer>

  </div>
</body>

</html>