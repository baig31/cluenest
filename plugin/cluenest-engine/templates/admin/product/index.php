<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">

    <h1 class="wp-heading-inline">Products</h1>

    <a href="<?php echo esc_url(admin_url('admin.php?page=cluenest-product-create')); ?>"
       class="page-title-action">
        Add Product
    </a>

    <hr class="wp-header-end">

    <?php if (empty($products)) : ?>

        <div class="notice notice-info inline">

            <p>

                <strong>No products found.</strong>

                Click <strong>Add Product</strong> to create your first product.

            </p>

        </div>

    <?php else : ?>

        <table class="widefat striped">

            <thead>

                <tr>

                    <th width="60">ID</th>

                    <th>Product Name</th>

                    <th width="120">Status</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($products as $product) : ?>

                    <tr>

                        <td><?php echo esc_html((string) $product['id']); ?></td>

                        <td><?php echo esc_html($product['name']); ?></td>

                        <td><?php echo esc_html($product['status']); ?></td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>