<?php

function drawTable($length, $height)
{
    for ($i = 1; $i <= $height; $i++) {
        print('<tr>');
        for ($j = 1; $j <= $length; $j++) {
            $isEvenRow = ($i % 2) == 0;
            $isEvenColumn = ($j % 2) == 0;
            $isEven = $isEvenRow && $isEvenColumn || !$isEvenRow && !$isEvenColumn;
            $current_position = [
                'x' => 5,
                'y' => 5,
            ];
            $allowed_cells = allowedCells($current_position['x'], $current_position['y'], $length, $height);

            if (($i == $current_position['y']) && (in_array($j, $allowed_cells['x']))) {
                print("<td class='bg-green-500 w-16 h-16 rounded-3xl'></td>");
            } elseif (($j == $current_position['x']) && (in_array($i, $allowed_cells['y']))) {
                print("<td class='bg-green-500 w-16 h-16 rounded-3xl'></td>");
            } else {
                if ($isEven) {
                    if ($i == $current_position['y'] && $j == $current_position['x']) {
                        print("<td class='text-red-300 bg-gray-600 w-16 h-16 rounded-lg text-3xl flex justify-center items-center'>❌</td>");
                    } else {
                        print("<td class='text-red-300 bg-gray-600 w-16 h-16 rounded-lg'></td>");
                    }
                } else {
                    if ($i == $current_position['y'] && $j == $current_position['x']) {
                        print("<td class='text-red-300 bg-gray-200 w-16 h-16 rounded-lg text-3xl flex justify-center items-center'>❌</td>");
                    } else {
                        print("<td class='text-red-300 bg-gray-200 w-16 h-16 rounded-lg'></td>");
                    }
                }
            }
        }
        print('</tr>');
    }
}



function allowedCells($x, $y, $length, $height)
{
    $allowed_x = [$x - 1, $x + 1];
    $allowed_y = [$y - 1, $y + 1];
    $allowed_cells = [];

    if ($allowed_x[0] < 1) {
        array_shift($allowed_x);
    }
    if (isset($allowed_x[0])) {
        $allowed_cells['x'][] = $allowed_x[0];
    }

    if (isset($allowed_x[1]) && $allowed_x[1] > $length) {
        array_pop($allowed_x);
    }
    if (isset($allowed_x[1])) {
        $allowed_cells['x'][] = $allowed_x[1];
    }

    if ($allowed_y[0] < 1) {
        array_shift($allowed_y);
    }
    if (isset($allowed_y[0])) {
        $allowed_cells['y'][] = $allowed_y[0];
    }

    if (isset($allowed_y[1]) && $allowed_y[1] > $height) {
        array_pop($allowed_y);
    }
    if (isset($allowed_y[1])) {
        $allowed_cells['y'][] = $allowed_y[1];
    }

    return $allowed_cells;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chess rook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white flex items-center justify-center h-screen flex-col">
    <div class="shadow-2xl p-6 bg-gray-200 rounded-lg">
        <table class="text-center">
            <tbody>
                <?php
                drawTable(9, 9);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>