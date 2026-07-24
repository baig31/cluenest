<?php

defined('ABSPATH') || exit;

$product = $product ?? (object) [];

$isEdit = !empty($product->id);

$name = $product->name ?? '';
$slug = $product->slug ?? '';
$brandId = $product->brand_id ?? '';
$categoryId = $product->category_id ?? '';
$status = $product->status ?? 'draft';
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
                <label for="brand_id">Brand</label>
            </th>
            <td>
                <select id="brand_id" name="brand_id">
                    <option value="">Select Brand</option>

                    <?php foreach ($brands as $brand) : ?>

                        <option
                            value="<?php echo esc_attr($brand->id); ?>"
                            <?php selected($brandId, $brand->id); ?>>

                            <?php echo esc_html($brand->name); ?>

                        </option>

                    <?php endforeach; ?>

                </select>
            </td>
        </tr>

        <tr>
            <th>
                <label for="category_id">Category</label>
            </th>
            <td>
                <select id="category_id" name="category_id">
                    <option value="">Select Category</option>

                    <?php foreach ($categories as $category) : ?>

                        <option
                            value="<?php echo esc_attr($category->id); ?>"
                            <?php selected($categoryId, $category->id); ?>>

                            <?php echo esc_html($category->name); ?>

                        </option>

                    <?php endforeach; ?>

                </select>
            </td>
        </tr>

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
                    value="<?php echo esc_attr($slug); ?>">
            </td>
        </tr>

        <tr>
            <th>
                <label for="status">Status</label>
            </th>
            <td>
                <select id="status" name="status">

                    <option
                        value="draft"
                        <?php selected($status, 'draft'); ?>>
                        Draft
                    </option>

                    <option
                        value="publish"
                        <?php selected($status, 'publish'); ?>>
                        Publish
                    </option>

                </select>
            </td>
        </tr>

    </table>

    <?php submit_button($isEdit ? 'Update Product' : 'Save Product'); ?>

</form>