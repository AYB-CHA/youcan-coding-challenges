<?php

namespace App\Console\Commands;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Console\Command;

class CreateProduct extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {description} {price} {image url} {--c|categories=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle(ProductRepositoryInterface $product_repository)
    {
        $product_info = [
            "name" => $this->argument('name'),
            "description" => $this->argument('description'),
            "price" => $this->argument('price'),
            "image" => $this->argument('image url'),
        ];

        $categories = $this->option('categories');

        $product_repository->createProduct($product_info, $categories);

        $this->info('Product was created successfully.');
    }
}
