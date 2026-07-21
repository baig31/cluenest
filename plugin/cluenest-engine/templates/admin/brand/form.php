<?php

defined('ABSPATH') || exit;

$isEdit = !empty($brand['id']);

$name = $brand['name'] ?? '';
$slug = $brand['slug'] ?? '';
$description = $brand['description'] ?? '';
$website = $brand['website'] ?? '';
$logo = $brand['logo'] ?? '';
$status = $brand['status'] ?? 'draft';
?>

<form method="post">

    <?php if ($isEdit) : ?>

        <?php wp_nonce_field('cluenest_update_brand'); ?>

    <?php else : ?>

        <?php wp_nonce_field('cluenest_create_brand'); ?>

    <?php endif; ?>

    <table class="form-table">

        <tr>
            <th>
                <label for="name">Brand Name <span style="color:#d63638;">*</span></label>
            </th>
            <td>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="regular-text"
                    value="<?php echo esc_attr($name); ?>"
                    required>

                <p class="description">
                    Enter the brand name (e.g. Samsung, Apple, Sony).
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

                <p class="description">
                    Optional. Leave blank to automatically generate the slug from the brand name.
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="description">Description</label>
            </th>
            <td>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="large-text"><?php echo esc_textarea($description); ?></textarea>

                <p class="description">
                    Optional description about the brand.
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="website">Website</label>
            </th>
            <td>
                <input
                    type="url"
                    id="website"
                    name="website"
                    class="regular-text"
                    value="<?php echo esc_attr($website); ?>">

                <p class="description">
                    Optional. Example: https://www.samsung.com
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="logo">Logo URL</label>
            </th>
            <td>
                <input
                    type="text"
                    id="logo"
                    name="logo"
                    class="regular-text"
                    value="<?php echo esc_attr($logo); ?>">

                <p class="description">
                    Optional. Media Library integration will be added in a future sprint.
                </p>
            </td>
        </tr>

        <tr>
            <th>
                <label for="status">Status</label>
            </th>
            <td>
                <select id="status" name="status">

                    <option value="draft" <?php selected($status, 'draft'); ?>>
                        Draft
                    </option>

                    <option value="publish" <?php selected($status, 'publish'); ?>>
    Published
</option>

                </select>
            </td>
        </tr>

    </table>

    <?php submit_button($isEdit ? 'Update Brand' : 'Save Brand'); ?>

</form>