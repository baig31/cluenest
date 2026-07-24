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

    <?php if (isset($_GET['message'])) : ?>

        <div class="notice notice-success is-dismissible">
            <p>
                <?php
                switch ($_GET['message']) {
                    case 'created':
                        echo 'Product created successfully.';
                        break;

                    case 'updated':
                        echo 'Product updated successfully.';
                        break;

                    case 'deleted':
                        echo 'Product deleted successfully.';
                        break;
                }
                ?>
            </p>
        </div>

    <?php endif; ?>

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
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th width="120">Status</th>
                    <th width="180">Actions</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($products as $product) : ?>

                    <tr>

                        <td><?php echo esc_html($product->id); ?></td>

                        <td><?php echo esc_html($product->name); ?></td>

                        <td>
                            <?php echo esc_html($product->brand_name ?: '—'); ?>
                        </td>

                        <td>
                            <?php echo esc_html($product->category_name ?: '—'); ?>
                        </td>

                        <td>
                            <?php echo esc_html(ucfirst($product->status)); ?>
                        </td>

                        <td>

                            <a
                                href="<?php echo esc_url(
                                    admin_url(
                                        'admin.php?page=cluenest-product-edit&id=' . $product->id
                                    )
                                ); ?>"
                                class="button button-secondary">
                                Edit
                            </a>

                            <a
                                href="<?php echo esc_url(
                                    wp_nonce_url(
                                        admin_url(
                                            'admin.php?page=cluenest-product-delete&id=' . $product->id
                                        ),
                                        'cluenest_delete_product'
                                    )
                                ); ?>"
                                class="button button-link-delete"
                                onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>