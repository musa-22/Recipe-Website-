<?php
include ('database/DB.php');

$column = array(
   
);

$query = "
SELECT * FROM recipesmarco
";

if (isset($_POST['filter_gender'], $_POST['filter_country'])  !='' && $_POST['filter_gender'] 
  != '' && $_POST['filter_country'] != '') {
        
        $xx = 'vegan';
       
        $xxx = 'vegetarian';
       
    $query .= '
 WHERE meat = "' . $_POST['filter_gender']. '" AND title = "' . $_POST['filter_country'] . '" 

 OR vegan = "' . $_POST['filter_gender']. '" AND title = "' . $_POST['filter_country'] . '"


 OR vegetarian = "' . $_POST['filter_gender']. '" AND title = "' . $_POST['filter_country'] . '"';
    
    
    
    
    
}

if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"] != - 1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $pdo->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $pdo->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();



foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['dae'];
    $sub_array[] = $row['title'];
    $sub_array[] = $row['meat'];
    $sub_array[] = $row['vegan'];
    $sub_array[] = $row['vegetarian'];
    
   
    $sub_array[] = $row['id']; 
    
    
    
    $data[] = $sub_array;
}

function count_all_data($pdo)
{
    $query = "SELECT * FROM recipesmarco";
    $statement = $pdo->prepare($query);
    $statement->execute();
    
    return $statement->rowCount();
}


$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => count_all_data($pdo),
    "recordsFiltered" => $number_filter_row,
    "data" => $data
    
);



echo json_encode($output);

?>


