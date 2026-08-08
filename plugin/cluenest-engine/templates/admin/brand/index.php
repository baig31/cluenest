<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">

    <h1 class="wp-heading-inline">Brands</h1>

    <a href="<?php echo esc_url(admin_url('admin.php?page=cluenest-brand-create')); ?>"
       class="page-title-action">
        Add Brand
    </a>

    <hr class="wp-header-end">

    <?php if (isset($_GET['message'])) : ?>

        <div class="notice notice-success is-dismissible">

            <p>

                <?php
                switch ($_GET['message']) {

                    case 'created':
                        echo 'Brand created successfully.';
                        break;

                    case 'updated':
                        echo 'Brand updated successfully.';
                        break;

                    case 'deleted':
                        echo 'Brand deleted successfully.';
                        break;
                }
                ?>

            </p>

        </div>

    <?php endif; ?>

    <?php if (empty($brands)) : ?>

        <div class="notice notice-info inline">

            <p>
                <strong>No brands found.</strong>
                Click <strong>Add Brand</strong> to create your first brand.
            </p>

        </div>

    <?php else : ?>

        <table class="widefat striped">

            <thead>

                <tr>
                    <th width="60">ID</th>
                    <th>Brand Name</th>
                    <th width="120">Status</th>
                    <th width="180">Actions</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($brands as $brand) : ?>

                    <tr>

                        <td><?php echo esc_html((string) $brand->id); ?></td>

<td><?php echo esc_html($brand->name); ?></td>

<td><?php echo esc_html(ucfirst($brand->status)); ?></td>

                        <td>

                            <a
                                href="<?php echo esc_url(
                                    admin_url(
                                        'admin.php?page=cluenest-brand-edit&id=' . $brand->id
                                    )
                                ); ?>"
                                class="button button-secondary">
                                Edit
                            </a>

                            <a
                                href="<?php echo esc_url(
                                    wp_nonce_url(
                                        admin_url(
                                            'admin.php?page=cluenest-brand-delete&id=' . $brand->id
                                        ),
                                        'cluenest_delete_brand'
                                    )
                                ); ?>"
                                class="button button-link-delete"
                                onclick="return confirm('Are you sure you want to delete this brand?');">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>