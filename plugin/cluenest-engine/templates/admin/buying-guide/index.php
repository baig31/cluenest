<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">

    <h1 class="wp-heading-inline">
        Buying Guides
    </h1>

    <a
        href="<?php echo esc_url(
            admin_url('admin.php?page=cluenest-buying-guide-create')
        ); ?>"
        class="page-title-action"
    >
        Add New
    </a>

    <hr class="wp-header-end">

    <?php if (empty($guides)) : ?>

        <p>
            No buying guides found.
        </p>

    <?php else : ?>

        <table class="widefat fixed striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($guides as $guide) : ?>

                    <tr>

                        <td>
                            <?php echo esc_html($guide->id); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo esc_html($guide->title); ?>
                            </strong>
                        </td>

                        <td>
                            <?php echo esc_html($guide->category_id); ?>
                        </td>

                        <td>
                            <?php echo esc_html($guide->status); ?>
                        </td>

                        <td>
                            <?php echo esc_html($guide->created_at); ?>
                        </td>

                        <td>

                            <a
                                href="<?php echo esc_url(
                                    admin_url(
                                        'admin.php?page=cluenest-buying-guide-edit&id=' .
                                        (int) $guide->id
                                    )
                                ); ?>"
                            >
                                Edit
                            </a>

                            |
                            
                            <?php
                            $deleteUrl = wp_nonce_url(
                                admin_url(
                                    'admin.php?page=cluenest-buying-guide-delete&id=' .
                                    (int) $guide->id
                                ),
                                'cluenest_delete_buying_guide'
                            );
                            ?>

                            <a
                                href="<?php echo esc_url($deleteUrl); ?>"
                                onclick="return confirm('Are you sure you want to delete this buying guide?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>