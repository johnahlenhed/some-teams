<?php
require __DIR__. '/data.php';
require __DIR__. '/includes/header.php';
?>

<main>
    <h1>Start Page</h1>

    <section class="teams-section">
        <?php foreach ($teams as $teamName => $teamData): ?>
            <div class="teams-section-div">
            <a href="team.php?team=<?= urlencode($teamName) ?>">
            <?= htmlspecialchars($teamName) ?>
            <img src="<?= htmlspecialchars($teamData['logo']) ?>" alt="Team Logo">
            </a>
            </div>
        <?php endforeach ?>
    </section>

</main>



<?php
require __DIR__. '/includes/footer.php';
?>