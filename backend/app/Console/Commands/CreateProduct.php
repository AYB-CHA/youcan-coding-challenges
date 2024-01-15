<?php

namespace App\Console\Commands;

use App\Services\Validation\Contracts\ProductValidationServiceInterface;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Validation\ValidationException;
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

    public function __construct(
        private ProductValidationServiceInterface $productValidationService,

    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(ProductRepositoryInterface $product_repository): void
    {
        $product_info = [
            "name" => $this->argument('name'),
            "description" => $this->argument('description'),
            "price" => $this->argument('price'),
            "image" => $this->argument('image url'),
        ];

        $categories = $this->option('categories');

        try {
            $this->productValidationService->createProductValidation([
                ...$product_info,
                'categories' => $categories,
            ]);
        } catch (ValidationException $error) {
            $this->error($error->validator->errors()->first());
            return;
        }

        $product_repository->createProduct($product_info, $categories);

        $this->info('Product was created successfully.');
    }
}
