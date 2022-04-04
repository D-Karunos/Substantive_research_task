<?php 

//pulling data from .CSV
if (($handle = fopen("interactions.csv", "r")) !== FALSE) {
    $id = array();
    $interaction_names = array();
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        //adding ID's in array to count their ammounts.
        array_push($id, $data[0]);

        //checking if array with refferal key already exists
        $check = array_key_exists($data[0], $interaction_names);
        if (!$check){
            $interaction_names[$data[0]] = $data[1];
            
        }

    }
    fclose($handle);
}


//Getting some numbers for percentage calculation
//getting total number of records
$total = count($id);

//counting all array values
$count = array_count_values($id);

//getting rid of repeating ID's as I can use them as identication to my $count and $interaction_names
$id=array_unique($id);
asort($id);
array_pop($id);
?>

<!<!DOCTYPE html>
<html>
<head>
    <!-- Linking bootstrap to have table style -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Percentage</th>
            </tr>
    </thead>
    <tbody>
        <tr>

            <?php
                foreach ($id as $val):
                    //getting percentage of interaction and formatting number to have 2 decimal numbers.
                    $average = $count[$val] / $total * 100;
                    $average = number_format($average, 0, '.', '');

            ?>
            <th scope="row"> <?=$val?> </th>
            <td><?=$interaction_names[$val] ?></td>
            <td><?=$average ?>%</td>
        </tr>
            <?php endforeach ?>

    </tbody>
</table>



</body>
</html>