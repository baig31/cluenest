<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

$isEdit = isset($guide->id);

$categoryId = isset($guide->category_id)
    ? (int) $guide->category_id
    : 0;

$featuredImageId = isset($guide->featured_image_id)
    ? (int) $guide->featured_image_id
    : 0;

$title = $guide->title ?? '';
$slug = $guide->slug ?? '';
$shortDescription = $guide->short_description ?? '';
$content = $guide->content ?? '';
$status = $guide->status ?? 'draft';

$featuredImageUrl = '';

if ($featuredImageId > 0) {
    $featuredImageUrl = wp_get_attachment_image_url(
        $featuredImageId,
        'medium'
    );
}
?>

<form method="post">

    <?php if ($isEdit) : ?>

        <?php wp_nonce_field('cluenest_update_buying_guide'); ?>

    <?php else : ?>

        <?php wp_nonce_field('cluenest_create_buying_guide'); ?>

    <?php endif; ?>

    <table class="form-table">

        <!-- Category -->

        <tr>

            <th>
                <label for="category_id">
                    Category
                </label>
            </th>

            <td>

                <select
                    id="category_id"
                    name="category_id"
                >

                    <option value="">
                        Select Category
                    </option>

                    <?php foreach ($categories as $category) : ?>

                        <option
                            value="<?php echo esc_attr($category->id); ?>"
                            <?php selected(
                                $categoryId,
                                (int) $category->id
                            ); ?>
                        >

                            <?php echo esc_html($category->name); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </td>

        </tr>

       <!-- Related Products -->

<tr>

    <th>
        <label>
            Related Products
        </label>
    </th>

    <td>

        <div
            id="buying-guide-products"
            style="max-width:700px;"
        >

            <?php if (!empty($products)) : ?>

                <?php foreach ($products as $product) : ?>

                    <?php
                    $isSelected = false;

                    foreach ($relatedProducts as $relatedProduct) {

                        if (
                            (int) $relatedProduct->product_id ===
                            (int) $product->id
                        ) {
                            $isSelected = true;
                            break;
                        }
                    }
                    ?>

                    <label
                        class="buying-guide-product-option"
                        style="
                            display:block;
                            margin-bottom:8px;
                            padding:10px;
                            border:1px solid #ddd;
                            background:#fff;
                        "
                    >

                        <input
                            type="checkbox"
                            class="buying-guide-product-checkbox"
                            value="<?php echo esc_attr($product->id); ?>"
                            <?php checked($isSelected); ?>
                        >

                        <strong>
                            <?php echo esc_html($product->name); ?>
                        </strong>

                        <?php if (!empty($product->model_number)) : ?>

                            <span>
                                — <?php echo esc_html($product->model_number); ?>
                            </span>

                        <?php endif; ?>

                    </label>

                <?php endforeach; ?>

            <?php else : ?>

                <p>
                    No products available.
                </p>

            <?php endif; ?>

        </div>


        <h4>
            Selected Products
        </h4>

        <p class="description">
            Drag and drop the products below to change their recommendation order.
        </p>


        <ul
            id="selected-buying-guide-products"
            style="
                max-width:700px;
                margin:10px 0;
                padding:0;
            "
        >

            <?php if (!empty($relatedProducts)) : ?>

                <?php foreach ($relatedProducts as $relatedProduct) : ?>

                    <?php
                    $relatedProductId = (int) $relatedProduct->product_id;

                    $relatedProductName = '';

                    foreach ($products as $product) {

                        if ((int) $product->id === $relatedProductId) {

                            $relatedProductName = $product->name;

                            break;
                        }
                    }
                    ?>

                    <?php if ($relatedProductName) : ?>

                        <li
                            class="selected-buying-guide-product"
                            data-product-id="<?php echo esc_attr($relatedProductId); ?>"
                            style="
                                list-style:none;
                                padding:10px;
                                margin-bottom:8px;
                                border:1px solid #ddd;
                                background:#fff;
                                cursor:move;
                            "
                        >

                            <span
                                style="
                                    margin-right:10px;
                                    color:#777;
                                "
                            >
                                ☰
                            </span>

                            <strong>
                                <?php echo esc_html($relatedProductName); ?>
                            </strong>

                        </li>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>

        </ul>


        <div id="buying-guide-product-hidden-inputs"></div>


        <p class="description">
            Select products above, then arrange the selected products in the order
            you want them to appear in the buying guide.
        </p>

    </td>

</tr>


        <!-- Featured Image -->

        <tr>

            <th>
                <label>
                    Featured Image
                </label>
            </th>

            <td>

                <input
                    type="hidden"
                    id="featured_image_id"
                    name="featured_image_id"
                    value="<?php echo esc_attr($featuredImageId); ?>"
                >

                <div id="featured-image-preview">

                    <?php if ($featuredImageUrl) : ?>

                        <img
                            src="<?php echo esc_url($featuredImageUrl); ?>"
                            style="max-width:180px;height:auto;border:1px solid #ddd;padding:5px;display:block;margin-bottom:10px;"
                        >

                    <?php endif; ?>

                </div>

                <button
                    type="button"
                    class="button"
                    id="select-featured-image"
                >
                    Select Image
                </button>

                <button
                    type="button"
                    class="button"
                    id="remove-featured-image"
                    <?php
                    echo empty($featuredImageId)
                        ? 'style="display:none;"'
                        : '';
                    ?>
                >
                    Remove Image
                </button>

                <p class="description">
                    Choose a featured image from the WordPress Media Library.
                </p>

            </td>

        </tr>


        <!-- Guide Title -->

        <tr>

            <th>
                <label for="title">
                    Guide Title
                </label>
            </th>

            <td>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="regular-text"
                    value="<?php echo esc_attr($title); ?>"
                    required
                >

                <p class="description">
                    Enter the title of the buying guide.
                </p>

            </td>

        </tr>


        <!-- Slug -->

        <tr>

            <th>
                <label for="slug">
                    Slug
                </label>
            </th>

            <td>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="regular-text"
                    value="<?php echo esc_attr($slug); ?>"
                >

                <p class="description">
                    URL-friendly version of the guide title.
                </p>

            </td>

        </tr>


        <!-- Short Description -->

        <tr>

            <th>
                <label for="short_description">
                    Short Description
                </label>
            </th>

            <td>

                <textarea
                    id="short_description"
                    name="short_description"
                    rows="4"
                    cols="60"
                ><?php echo esc_textarea($shortDescription); ?></textarea>

                <p class="description">
                    A short introduction to this buying guide.
                </p>

            </td>

        </tr>


        <!-- Guide Content -->

        <tr>

            <th>
                <label for="buying_guide_content">
                    Guide Content
                </label>
            </th>

            <td>

                <?php
                wp_editor(
                    $content,
                    'buying_guide_content',
                    [
                        'textarea_name' => 'content',
                        'textarea_rows' => 15,
                        'media_buttons' => true,
                        'teeny' => false,
                    ]
                );
                ?>

                <p class="description">
                    Write the complete buying guide here.
                </p>

            </td>

        </tr>


        <!-- Status -->

        <tr>

            <th>
                <label for="status">
                    Status
                </label>
            </th>

            <td>

                <select
                    id="status"
                    name="status"
                >

                    <option
                        value="draft"
                        <?php selected($status, 'draft'); ?>
                    >
                        Draft
                    </option>

                    <option
                        value="publish"
                        <?php selected($status, 'publish'); ?>
                    >
                        Publish
                    </option>

                </select>

            </td>

        </tr>

    </table>


    <?php
    submit_button(
        $isEdit
            ? 'Update Buying Guide'
            : 'Save Buying Guide'
    );
    ?>

</form>