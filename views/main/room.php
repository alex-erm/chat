<?php

$data = [
    'room' => $modelRoom->name,
    'idRoom' => $modelRoom->id,
    'arhiv' =>$modelArhiv,
];
//print_r($modelArhiv[1]);
header('Content-Type: application/json');
echo json_encode($data);
//echo json_encode($roomId);