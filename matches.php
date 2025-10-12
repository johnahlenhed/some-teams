<?php
require __DIR__ . '/data.php';

//Normailize inconsistent team name from data
function normalizeTeamName($name)
{
    $mapping = [
        'Bayern Münich' => 'Bayern Munich',
        'Bayern Munich' => 'Bayern Munich'
    ];
    return $mapping[$name] ?? $name;
}

function generateRounds($teams)
{
    $rounds = [];
    $matchesProcessed = [];

    //Creating 6 rounds
    for ($roundNum = 0; $roundNum < 6; $roundNum++) {
        $rounds[$roundNum] = [];
        $teamsUsedInRound = [];



        foreach ($teams as $teamName => $teamData) {
            $normalizedTeamName = normalizeTeamName($teamName);

            //If team is used in round, skip
            if (in_array($normalizedTeamName, $teamsUsedInRound)) {
                continue;
            }

            //Finds opponent
            foreach ($teamData['opponents'] as $opponent) {
                $normalizedOpponent = normalizeTeamName($opponent);

                //Check if match is possible
                $matchKey1 = $normalizedTeamName . '_vs_' . $normalizedOpponent;
                $matchKey2 = $normalizedOpponent . '_vs_' . $normalizedTeamName;

                //If opponent is not used in round and match not processed yet, create match
                if (
                    !in_array($normalizedOpponent, $teamsUsedInRound) &&
                    !isset($matchesProcessed[$matchKey1]) &&
                    !isset($matchesProcessed[$matchKey2]) &&
                    isset($teams[$normalizedOpponent])
                ) {  // Check opponent exists

                    $rounds[$roundNum][] = [
                        'home' => $normalizedTeamName,
                        'away' => $normalizedOpponent
                    ];

                    //Mark teams as used in this round
                    $teamsUsedInRound[] = $normalizedTeamName;
                    $teamsUsedInRound[] = $normalizedOpponent;

                    //Mark match as processed
                    $matchesProcessed[$matchKey1] = true;
                    $matchesProcessed[$matchKey2] = true;

                    break;
                }
            }
        }
    }

    return $rounds;
}

//Generates rounds
$rounds = generateRounds($teams);

require __DIR__ . '/includes/header.php'; ?>

<main>
    <h1>Matches</h1>


    <?php

    foreach ($rounds as $roundNum => $matches): ?>

        <h2>Round <?= $roundNum + 1 ?> </h2>

        <?php foreach ($matches as $match): ?>

            <?php
            $homeTeam = $teams[$match['home']];
            $awayTeam = $teams[$match['away']];
            ?>

            <div>
                <div><?= $match['home'] ?></div>
            </div>

            <span> vs </span>

            <div>
                <div><?= $match['away'] ?></div>
            </div>

        <?php endforeach ?>

    <?php endforeach ?>

</main>

<?php
require __DIR__ . '/includes/footer.php';
?>