### Assignment-be

This backend service is a laravel application. It is responsible for processing product feed file provided to us by a
3rd party. Import file is uploaded to `storage/app/public/products.csv` file daily, and is
processed via a custom command:

```
php artisan products:import
```

Semicolon (`;`) character is used as delimiter in CSV file, and product attributes such as name, sku, image,
description, etc.
are imported into database.

Database schema (`products` table) is using `id` as a primary key (`id` column), but the feed contains its own identifier, in the
form of `feed_product_id` column, which we're also storing and using as an identifier to update products.

Application provides an endpoint that can be accessed by `GET /api/products`, and accepts `page_size` and `page` parameters
to control pagination. This endpoint is used to obtain imported products, to be displayed on the frontend.

Application has been working well initially, but over time we've noticed a couple of problems with it.
Problems are described below.

1. Products that have visibility disabled, i.e. `visibility=false` in the database are also displayed on the
   frontend. We don't know why. Can you help?

2. For some unknown reason, our database gets filled with products without a name. Can you find the cause for this
   behaviour? We don't want to have products without a name in the DB.

3. During the import, we notice a huge spike in number of SQL queries being done to the database. Over time, we've been
   getting new products (import file has grown significantly), and import has been running longer and longer. Do you
   have any ideas on how to address this?

Technical information:

-   project can be run locally, using built-in laravel server:
    `php artisan serve --port=<port>`
-   `PHP >= 8.1`
-   Database - `sqlite` - example DB provided in `database.sqlite` file
-   `gen_csv.php` - can be used to generate an import file of different sizes
-   example import files: `products_small.csv`, `products_large.csv`
