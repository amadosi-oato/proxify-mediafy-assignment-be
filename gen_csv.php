<?php

// Open output stream
$output = fopen('products.csv', 'w');

// Write headers
$headers = [
    'feed_product_id',
    'sku',
    'name',
    'qty',
    'status',
    'visibility',
    'price',
    'type_id',
    'description'
];

// Write header row
fputcsv($output, $headers);

$tags = ["home", "sport", "experience", "food", "travel", "tech"];

// Generate sample data
for ($i = 1; $i <= 2000; $i++) {
    $data = [
        'feed_product_id' => "PROD{$i}",
        'sku' => "SKU{$i}",
        'name' => "Product {$i}",
        'qty' => rand(1, 100),
        'status' => rand(0, 1),
        'visibility' => rand(0, 1) ? 'true' : 'false',
        'price' => number_format(rand(1000, 10000) / 100, 2),
        'type_id' => 'simple',
        'description' => "Description for Sample Product {$i}",
        'image' => "https://picsum.photos/id/" . rand(0, 500) . "/200/200",
        'tags' => join(",", array_rand(array_flip($tags), 3))
    ];

    // Write data row
    fputcsv($output, $data, ';');
}

// Close output stream
fclose($output);

?>
