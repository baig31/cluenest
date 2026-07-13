<?php

defined('ABSPATH') || exit;

$isEdit = isset($product);

$name = $product['name'] ?? '';
$slug = $product['slug'] ?? '';
$status = $product['status'] ?? 'draft';
?>

<form method="post">

    <?php if ($isEdit) : ?>

        <?php wp_nonce_field('cluenest_update_product'); ?>

    <?php else : ?>

        <?php wp_nonce_field('cluenest_create_product'); ?>

    <?php endif; ?>

    <table class="form-table">

        <tr>

            <th>
                <label for="name">Product Name</label>
            </th>

            <td>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="regular-text"
                    value="<?php echo esc_attr($name); ?>"
                    required>

            </td>

        </tr>

        <tr>

            <th>
                <label for="slug">Slug</label>
            </th>

            <td>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="regular-text"
                    value="<?php echo esc_attr($slug); ?>"
                    required>

            </td>

        </tr>

        <tr>

            <th>
                <label for="status">Status</label>
            </th>

            <td>

                <select
                    id="status"
                    name="status">

                    <option value="draft"
                        <?php selected($status, 'draft'); ?>>
                        Draft
                    </option>

                    <option value="published"
                        <?php selected($status, 'published'); ?>>
                        Published
                    </option>

                </select>

            </td>

        </tr>

    </table>

    <?php submit_button($isEdit ? 'Update Product' : 'Save Product'); ?>

</form>