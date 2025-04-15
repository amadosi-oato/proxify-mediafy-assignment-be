<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportProducts extends Command
{

    private const IMPORT_FILE_NAME = 'products.csv';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--b|batch=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from file feed';

    /**
     * Execute the console command.
     * Process products from the file feed and update/create products in the database
     * @return void
     */
    public function handle()
    {
        try {
            $skipHeader = true;
            $importFile = Storage::disk('public')->path('') . self::IMPORT_FILE_NAME;
            $fileHandle = fopen($importFile, 'r');
            $newProducts = []; // Holds products to be loaded in batches
            $batchSize = $this->option('batch');
            $now = now();

            // Load existing product Ids
            $existingProductIds = Product::pluck('id', 'feed_product_id')->toArray();

            while ($csvRow = fgetcsv($fileHandle, null, ';')) {
                if ($skipHeader) {
                    $skipHeader = false;
                    continue;
                }

                // Skip rows with empty name or feed_product_id
                if (empty(trim($csvRow[0])) || empty(trim($csvRow[2]))) {
                    Log::warning('Skipped row with missing feed_product_id or name', ['row' => $csvRow]);
                    continue;
                }

                $feedProductId = $csvRow[0];
                $productData = [
                    'feed_product_id' => $feedProductId,
                    'sku' => $csvRow[1],
                    'name' => $csvRow[2],
                    'qty' => $csvRow[3],
                    'status' => $csvRow[4],
                    'visibility' => $csvRow[5],
                    'price' => $csvRow[6],
                    'type_id' => $csvRow[7],
                    'description' => $csvRow[8],
                    'image' => $csvRow[9],
                    'tags' => json_encode(array_map('trim', explode(',', $csvRow[10]))),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if (!isset($existingProductIds[$csvRow[0]])) {
                    $newProducts[] = array_merge(['feed_product_id' => $feedProductId], $productData);
                }

                // Insert product batch based on batchSize
                if (count($newProducts) >= $batchSize) {
                    Product::insert($newProducts);
                    $newProducts = [];
                }
            }

            if (!empty($newProducts)) {
                Product::insert($newProducts);
                $newProducts = [];
            }

            fclose($fileHandle);
        } catch (\Exception $e) {
            Log::critical(
                sprintf('Something went wrong during file import: %s', $e->getMessage()),
                ['exception' => $e]
            );
            throw $e;
        }
    }
}
