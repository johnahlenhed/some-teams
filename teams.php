<?php
require __DIR__ . '/data.php';

//Sorts array based on UEFA ranking
uasort($teams, function ($a, $b) {
    return $a['uefa-coefficient-ranking'] <=> $b['uefa-coefficient-ranking'];
});
require __DIR__ . '/includes/header.php';
?>

<main class="teams-main">
    <h1>Teams</h1>

    <article class="teams-list-article">
        <?php foreach ($teams as $teamName => $teamData): ?>
            <div class="teams-list-div">

                <img src="<?php echo $teamData['logo'] ?>" alt="Team Logo">
                <h2>
                    <?php echo $teamName ?>
                </h2>
                <ul>
                    <li> City:
                        <?php echo $teamData['city'] ?>
                    </li>
                    <li> League:
                        <?php echo $teamData['league'] ?>
                    </li>
                    <li> UEFA Ranking:
                        <?php echo $teamData['uefa-coefficient-ranking'] ?>
                    </li>
                </ul>
            </div>
        <?php endforeach ?>
    </article>

</main>

<?php
require __DIR__ . '/includes/footer.php';
?>