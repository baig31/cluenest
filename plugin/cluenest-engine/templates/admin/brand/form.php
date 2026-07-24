<?php

defined('ABSPATH') || exit;

$product = $product ?? (object) [];

$isEdit = !empty($product->id);

$name = $product->name ?? '';
$slug = $product->slug ?? '';
$brandId = $product->brand_id ?? '';
$categoryId = $product->category_id ?? '';
$modelNumber = $product->model_number ?? '';
$shortDescription = $product->short_description ?? '';
$longDescription = $product->long_description ?? '';
$editorialRating = $product->editorial_rating ?? 0;
$status = $product->status ?? 'draft';
$featuredImageId = $product->featured_image_id ?? '';

$featuredImageUrl = $featuredImageId
    ? wp_get_attachment_image_url($featuredImageId, 'medium')
    : '';

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
        <label>Featured Image</label>
    </th>
    <td>

        <input
            type="hidden"
            id="featured_image_id"
            name="featured_image_id"
            value="<?php echo esc_attr($featuredImageId); ?>">

        <div id="featured-image-preview">

            <?php if ($featuredImageUrl) : ?>

                <img
                    src="<?php echo esc_url($featuredImageUrl); ?>"
                    style="max-width:180px;height:auto;border:1px solid #ddd;padding:5px;display:block;margin-bottom:10px;">

            <?php endif; ?>

        </div>

        <button
            type="button"
            class="button"
            id="select-featured-image">

            Select Image

        </button>

        <button
            type="button"
            class="button"
            id="remove-featured-image"
            <?php echo empty($featuredImageId) ? 'style="display:none;"' : ''; ?>>

            Remove Image

        </button>

        <p class="description">
            Choose a featured image from the WordPress Media Library.
        </p>

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
                <label for="model_number">Model Number</label>
            </th>
            <td>
                <input
                    type="text"
                    id="model_number"
                    name="model_number"
                    class="regular-text"
                    value="<?php echo esc_attr($modelNumber); ?>">
            </td>
        </tr>

        <tr>
            <th>
                <label for="short_description">Short Description</label>
            </th>
            <td>
                <textarea
                    id="short_description"
                    name="short_description"
                    rows="4"
                    cols="60"><?php echo esc_textarea($shortDescription); ?></textarea>

                <p class="description">
                    A brief summary of the product.
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="long_description">Long Description</label>
            </th>
            <td>
                <textarea
                    id="long_description"
                    name="long_description"
                    rows="8"
                    cols="60"><?php echo esc_textarea($longDescription); ?></textarea>

                <p class="description">
                    Detailed product description, features, specifications and buying guide.
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="editorial_rating">Editorial Rating</label>
            </th>
            <td>
                <input
                    type="number"
                    id="editorial_rating"
                    name="editorial_rating"
                    min="0"
                    max="5"
                    step="0.1"
                    value="<?php echo esc_attr($editorialRating); ?>">

                <p class="description">
                    Enter a rating between 0.0 and 5.0.
                </p>
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