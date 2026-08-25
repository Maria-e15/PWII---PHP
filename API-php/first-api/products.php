<?php

header("Content-Type: application/json");

$products = [
    [
        "id" => 1,
        "name" => "Keyboard",
        "price" => 150.00
    ],
    [
        "id" => 2,
        "name" => "Mouse",
        "price" => 80.00
    ],
    [
        "id" => 3,
        "name" => "Monitor",
        "price" => 900.00
    ]
];

http_response_code(200);

echo json_encode($products);