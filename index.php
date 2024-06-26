<?php


function drawTable($length, $height, $steps)
{
    $rook = rookIcon("#fff", "#1f2937");
    for ($i = 1; $i <= $height; $i++) {
        print('<tr>');
        for ($j = 1; $j <= $length; $j++) {
            $current_position = [
                'x' => 5,
                'y' => 5,
            ];
            $allowed_cells = allowedCells($current_position['x'], $current_position['y'], $length, $height, $steps);
            $content = getCellContent($i, $j, $current_position, $allowed_cells, $rook);
            print("<td class='$content[0]'>$content[1]</td>");
        }
        print('</tr>');
    }
}

function getCellContent($i, $j, $current_position, $allowed_cells, $rook)
{
    $isEvenRow = ($i % 2) == 0;
    $isEvenColumn = ($j % 2) == 0;
    $isEven = $isEvenRow && $isEvenColumn || !$isEvenRow && !$isEvenColumn;
    $bgClass = $isEven ? 'bg-gray-600' : 'bg-gray-200';
    $tdClass = "$bgClass w-16 h-16 rounded-lg";
    $content = "";

    if ($i == $current_position['y'] && $j == $current_position['x']) {
        $content = "<div class='flex justify-center items-center w-full h-full'>$rook</div>";
    } else {
        if (($i == $current_position['y']) && (in_array($j, $allowed_cells['x']))) {
            $content = "<div class='flex justify-center items-center w-full h-full'><div class='bg-green-300 rounded-3xl h-3/5 w-3/5'></div></div>";
        } elseif (($j == $current_position['x']) && (in_array($i, $allowed_cells['y']))) {
            $content = "<div class='flex justify-center items-center w-full h-full'><div class='bg-green-300 rounded-3xl h-3/5 w-3/5'></div></div>";
        }
    }

    return [$tdClass, $content];
}


function rookIcon($fill, $stroke)
{
    return
        '<svg fill=' . $fill . ' version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="54px" height="54px" viewBox="-10 -10 120.00 120.00" enable-background="new 0 0 100 100" xml:space="preserve" stroke="#09090b" stroke-width="0.001">
            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke=' . $stroke . ' stroke-width="10"> <path d="M31,25V10h7v6h6v-6h12v6h6v-6h7v15c0,2.2-1.8,4-4,4H35C32.8,29,31,27.2,31,25z M65,34c1.1,0,2-0.9,2-2s-0.9-2-2-2H35 c-1.1,0-2,0.9-2,2s0.9,2,2,2H65z M30,84h40c1.1,0,2-0.9,2-2s-0.9-2-2-2H30c-1.1,0-2,0.9-2,2S28.9,84,30,84z M73,85H27 c-2.2,0-4,1.8-4,4s1.8,4,4,4h46c2.2,0,4-1.8,4-4S75.2,85,73,85z M68.262,79C66.464,72.752,62,70.139,62,35H38 c0,35.139-4.464,37.752-6.262,44H68.262z"/> </g>
            <g id="SVGRepo_iconCarrier"> <path d="M31,25V10h7v6h6v-6h12v6h6v-6h7v15c0,2.2-1.8,4-4,4H35C32.8,29,31,27.2,31,25z M65,34c1.1,0,2-0.9,2-2s-0.9-2-2-2H35 c-1.1,0-2,0.9-2,2s0.9,2,2,2H65z M30,84h40c1.1,0,2-0.9,2-2s-0.9-2-2-2H30c-1.1,0-2,0.9-2,2S28.9,84,30,84z M73,85H27 c-2.2,0-4,1.8-4,4s1.8,4,4,4h46c2.2,0,4-1.8,4-4S75.2,85,73,85z M68.262,79C66.464,72.752,62,70.139,62,35H38 c0,35.139-4.464,37.752-6.262,44H68.262z"/> </g>
            </svg>';
}





function allowedCells($x, $y, $length, $height, $steps)
{

    $allowed_cells = ['x' => [], 'y' => []];

    for ($i = 1; $i <= $steps; $i++) {

        if ($x - $i > 0) {
            $allowed_cells['x'][] = $x - $i;
        }
        if ($x + $i <= $length) {
            $allowed_cells['x'][] = $x + $i;
        }


        if ($y - $i > 0) {
            $allowed_cells['y'][] = $y - $i;
        }

        if ($y + $i <= $height) {
            $allowed_cells['y'][] = $y + $i;
        }
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
                drawTable(9, 9, 9);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>