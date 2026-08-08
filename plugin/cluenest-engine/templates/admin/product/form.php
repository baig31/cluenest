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

    $galleryImageIds = !empty($product->gallery_image_ids)
    ? json_decode($product->gallery_image_ids, true)
    : [];

$galleryImageIds = is_array($galleryImageIds)
    ? $galleryImageIds
    : [];

    $specifications = $specifications ?? [];

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
        <label>Product Gallery</label>
    </th>
    <td>

        <div id="gallery-preview">

            <?php foreach ($galleryImageIds as $imageId) : ?>

                <div
                    class="gallery-item"
                    data-id="<?php echo esc_attr($imageId); ?>">

                    <?php
                    echo wp_get_attachment_image(
                        $imageId,
                        'thumbnail'
                    );
                    ?>

                    <input
                        type="hidden"
                        name="gallery_image_ids[]"
                        value="<?php echo esc_attr($imageId); ?>">

                    <button
                        type="button"
                        class="button remove-gallery-image">
                        Remove
                    </button>

                </div>

            <?php endforeach; ?>

        </div>

        <p>

            <button
                type="button"
                class="button"
                id="select-gallery-images">

                Add Gallery Images

            </button>

        </p>

        <p class="description">
            Select one or more images from the WordPress Media Library.
            Drag and drop support will be added in this sprint.
        </p>

    </td>
</tr>

<tr>
    <th>
        <label>Specifications</label>
    </th>

    <td>

        <div id="product-specifications">

            <?php if (!empty($specifications)) : ?>

                <?php foreach ($specifications as $specification) : ?>

                    <div class="product-specification-row">

                        <input
                            type="text"
                            name="specification[]"
                            class="regular-text"
                            placeholder="Specification"
                            value="<?php echo esc_attr($specification->specification); ?>">

                        <input
                            type="text"
                            name="value[]"
                            class="regular-text"
                            placeholder="Value"
                            value="<?php echo esc_attr($specification->value); ?>">

                        <button
                            type="button"
                            class="button remove-specification">

                            Remove

                        </button>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="product-specification-row">

                    <input
                        type="text"
                        name="specification[]"
                        class="regular-text"
                        placeholder="Specification">

                    <input
                        type="text"
                        name="value[]"
                        class="regular-text"
                        placeholder="Value">

                    <button
                        type="button"
                        class="button remove-specification">

                        Remove

                    </button>

                </div>

            <?php endif; ?>

        </div>

        <p>

            <button
                type="button"
                class="button button-secondary"
                id="add-specification">

                + Add Specification

            </button>

        </p>

        <p class="description">
            Add unlimited specifications for this product.
        </p>

    </td>

</tr>

<tr>
    <th>
        <label>Product Highlights</label>
    </th>

    <td>

        <div id="product-highlights">

            <?php if (!empty($highlights)) : ?>

                <?php foreach ($highlights as $highlight) : ?>

                    <div class="product-highlight-row">

                        <input
                            type="text"
                            name="highlight[]"
                            class="regular-text"
                            placeholder="Highlight"
                            value="<?php echo esc_attr($highlight->highlight); ?>">

                        <button
                            type="button"
                            class="button remove-highlight">

                            Remove

                        </button>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="product-highlight-row">

                    <input
                        type="text"
                        name="highlight[]"
                        class="regular-text"
                        placeholder="Highlight">

                    <button
                        type="button"
                        class="button remove-highlight">

                        Remove

                    </button>

                </div>

            <?php endif; ?>

        </div>

        <p>

            <button
                type="button"
                class="button button-secondary"
                id="add-highlight">

                + Add Highlight

            </button>

        </p>

        <p class="description">
            Add the product's key selling points.
        </p>

    </td>

</tr>


<tr>
    <th>
        <label>Product Pricing & Affiliate</label>
    </th>

    <td>

        <table class="widefat" style="max-width:700px;">

            <tr>
                <td style="width:180px;">
                    <label for="price">
                        <strong>Current Price</strong>
                    </label>
                </td>

                <td>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        class="regular-text"
                        min="0"
                        step="0.01"
                        value="<?php echo esc_attr($pricing->price ?? ''); ?>"
                        placeholder="14999.00">

                    <span>INR</span>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="original_price">
                        <strong>Original Price</strong>
                    </label>
                </td>

                <td>
                    <input
                        type="number"
                        id="original_price"
                        name="original_price"
                        class="regular-text"
                        min="0"
                        step="0.01"
                        value="<?php echo esc_attr($pricing->original_price ?? ''); ?>"
                        placeholder="19999.00">

                    <span>INR</span>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="affiliate_network">
                        <strong>Affiliate Network</strong>
                    </label>
                </td>

                <td>
                    <select
                        id="affiliate_network"
                        name="affiliate_network">

                        <option value="">Select Network</option>

                        <option
                            value="amazon"
                            <?php selected(
                                $pricing->affiliate_network ?? '',
                                'amazon'
                            ); ?>>
                            Amazon
                        </option>

                        <option
                            value="flipkart"
                            <?php selected(
                                $pricing->affiliate_network ?? '',
                                'flipkart'
                            ); ?>>
                            Flipkart
                        </option>

                        <option
                            value="other"
                            <?php selected(
                                $pricing->affiliate_network ?? '',
                                'other'
                            ); ?>>
                            Other
                        </option>

                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="affiliate_url">
                        <strong>Affiliate URL</strong>
                    </label>
                </td>

                <td>
                    <input
                        type="url"
                        id="affiliate_url"
                        name="affiliate_url"
                        class="large-text"
                        value="<?php echo esc_attr($pricing->affiliate_url ?? ''); ?>"
                        placeholder="https://www.amazon.in/...">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="currency">
                        <strong>Currency</strong>
                    </label>
                </td>

                <td>
                    <select
                        id="currency"
                        name="currency">

                        <option
                            value="INR"
                            <?php selected(
                                $pricing->currency ?? 'INR',
                                'INR'
                            ); ?>>
                            INR (₹)
                        </option>

                    </select>
                </td>
            </tr>

        </table>

        <p class="description">
            Enter the current selling price, original price and affiliate purchase URL.
        </p>

    </td>
</tr>
<tr>
    <th>
        <label>Product SEO</label>
    </th>

    <td>

        <div class="product-seo-fields">

            <p>
                <label for="seo_title">
                    <strong>SEO Title</strong>
                </label>
            </p>

            <input
                type="text"
                id="seo_title"
                name="seo_title"
                class="large-text"
                maxlength="255"
                value="<?php echo esc_attr($seo->seo_title ?? ''); ?>">

            <p class="description">
                Recommended: keep the SEO title concise and relevant to the product.
            </p>


            <p>
                <label for="meta_description">
                    <strong>Meta Description</strong>
                </label>
            </p>

            <textarea
                id="meta_description"
                name="meta_description"
                rows="4"
                class="large-text"
                maxlength="160"><?php echo esc_textarea($seo->meta_description ?? ''); ?></textarea>

            <p class="description">
                A short description that can be used by search engines in search results.
            </p>


            <p>
                <label for="focus_keyword">
                    <strong>Focus Keyword</strong>
                </label>
            </p>

            <input
                type="text"
                id="focus_keyword"
                name="focus_keyword"
                class="regular-text"
                value="<?php echo esc_attr($seo->focus_keyword ?? ''); ?>">

            <p class="description">
                Main keyword or search phrase for this product.
            </p>


            <p>
                <label for="canonical_url">
                    <strong>Canonical URL</strong>
                </label>
            </p>

            <input
                type="url"
                id="canonical_url"
                name="canonical_url"
                class="large-text"
                value="<?php echo esc_attr($seo->canonical_url ?? ''); ?>">

            <p class="description">
                Leave empty if the product's normal URL should be canonical.
            </p>


            <p>
                <label for="robots_index">
                    <strong>Search Engine Indexing</strong>
                </label>
            </p>

            <select
                id="robots_index"
                name="robots_index">

                <option
                    value="index"
                    <?php selected(
                        $seo->robots_index ?? 'index',
                        'index'
                    ); ?>>
                    Index
                </option>

                <option
                    value="noindex"
                    <?php selected(
                        $seo->robots_index ?? 'index',
                        'noindex'
                    ); ?>>
                    Noindex
                </option>

            </select>

            <p class="description">
                Choose whether search engines should index this product page.
            </p>

        </div>

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
        <label>Product Pros & Cons</label>
    </th>

    <td>

        <h4 style="margin-bottom: 8px;">Pros</h4>

        <div id="product-pros">

            <?php
            $pros = array_filter(
                $prosCons ?? [],
                static fn ($item) => isset($item->type) && $item->type === 'pro'
            );
            ?>

            <?php if (!empty($pros)) : ?>

                <?php foreach ($pros as $pro) : ?>

                    <div class="product-pros-cons-row" style="margin-bottom: 10px;">

                        <input
                            type="hidden"
                            name="pros_cons_type[]"
                            value="pro">

                        <input
                            type="text"
                            name="pros_cons_content[]"
                            class="regular-text"
                            placeholder="Product advantage"
                            value="<?php echo esc_attr($pro->content); ?>">

                        <button
                            type="button"
                            class="button remove-pros-cons">
                            Remove
                        </button>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="product-pros-cons-row" style="margin-bottom: 10px;">

                    <input
                        type="hidden"
                        name="pros_cons_type[]"
                        value="pro">

                    <input
                        type="text"
                        name="pros_cons_content[]"
                        class="regular-text"
                        placeholder="Product advantage">

                    <button
                        type="button"
                        class="button remove-pros-cons">
                        Remove
                    </button>

                </div>

            <?php endif; ?>

        </div>

        <p>
            <button
                type="button"
                class="button button-secondary"
                id="add-product-pro">
                + Add Pro
            </button>
        </p>


        <h4 style="margin-top: 25px; margin-bottom: 8px;">Cons</h4>

        <div id="product-cons">

            <?php
            $cons = array_filter(
                $prosCons ?? [],
                static fn ($item) => isset($item->type) && $item->type === 'con'
            );
            ?>

            <?php if (!empty($cons)) : ?>

                <?php foreach ($cons as $con) : ?>

                    <div class="product-pros-cons-row" style="margin-bottom: 10px;">

                        <input
                            type="hidden"
                            name="pros_cons_type[]"
                            value="con">

                        <input
                            type="text"
                            name="pros_cons_content[]"
                            class="regular-text"
                            placeholder="Product disadvantage"
                            value="<?php echo esc_attr($con->content); ?>">

                        <button
                            type="button"
                            class="button remove-pros-cons">
                            Remove
                        </button>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="product-pros-cons-row" style="margin-bottom: 10px;">

                    <input
                        type="hidden"
                        name="pros_cons_type[]"
                        value="con">

                    <input
                        type="text"
                        name="pros_cons_content[]"
                        class="regular-text"
                        placeholder="Product disadvantage">

                    <button
                        type="button"
                        class="button remove-pros-cons">
                        Remove
                    </button>

                </div>

            <?php endif; ?>

        </div>

        <p>
            <button
                type="button"
                class="button button-secondary"
                id="add-product-con">
                + Add Con
            </button>
        </p>

        <p class="description">
            Add the main advantages and disadvantages of this product.
        </p>

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