<?php 
require __DIR__. '/data.php';

$teamName = $_GET['team'] ?? null;

if (!$teamName || !isset($teams[$teamName])) {
    header('Location: index.php');
    exit;
}

$team = $teams[$teamName];

require __DIR__. '/includes/header.php';
?>

<main class="team-main">
    <h1><?= htmlspecialchars($teamName) ?></h1>

    <div class="team-div">
        <img src="<?= htmlspecialchars($team['logo']) ?>" alt="Team Logo" width="150">

        <p><strong>League:</strong> <?= htmlspecialchars($team['league']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($team['city']) ?></p>
        <p><strong>UEFA Ranking:</strong> <?= htmlspecialchars($team['uefa-coefficient-ranking']) ?></p>

        <a href="<?= htmlspecialchars($team['url']) ?>" target="_blank">Official Website</a>
    </div>

</main>