<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Categories</h1>

    <a href="<?php echo esc_url(admin_url('admin.php?page=cluenest-category-create')); ?>" class="page-title-action">
        Add New
    </a>

    <hr class="wp-header-end">

    <?php if (isset($_GET['message'])) : ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <?php
                switch ($_GET['message']) {
                    case 'created':
                        echo 'Category created successfully.';
                        break;
                    case 'updated':
                        echo 'Category updated successfully.';
                        break;
                    case 'deleted':
                        echo 'Category deleted successfully.';
                        break;
                }
                ?>
            </p>
        </div>
    <?php endif; ?>

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <th width="60">ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th width="180">Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($categories)) : ?>

            <?php foreach ($categories as $category) : ?>

                <tr>
                    <td><?php echo esc_html($category->id); ?></td>

                    <td><?php echo esc_html($category->name); ?></td>

                    <td><?php echo esc_html($category->slug); ?></td>

                    <td><?php echo esc_html(ucfirst($category->status)); ?></td>

                    <td>

                        <a href="<?php echo esc_url(admin_url('admin.php?page=cluenest-category-edit&id=' . $category->id)); ?>">
                            Edit
                        </a>

                        |

                        <a href="<?php echo esc_url(
                            wp_nonce_url(
                                admin_url('admin.php?page=cluenest-category-delete&id=' . $category->id),
                                'cluenest_delete_category'
                            )
                        ); ?>"
                        onclick="return confirm('Delete this category?');">
                            Delete
                        </a>

                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>
                <td colspan="5">No categories found.</td>
            </tr>

        <?php endif; ?>

        </tbody>
    </table>
</div>