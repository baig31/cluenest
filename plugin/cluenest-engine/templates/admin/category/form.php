<?php

defined('ABSPATH') || exit;

$category = $category ?? (object) [];
?>

<table class="form-table">

    <tr>
        <th scope="row">
            <label for="parent_id">Parent Category</label>
        </th>
        <td>
            <input
                type="number"
                id="parent_id"
                name="parent_id"
                class="regular-text"
                value="<?php echo esc_attr($category->parent_id ?? ''); ?>"
            />
            <p class="description">
                Leave empty for a top-level category.
            </p>
        </td>
    </tr>

    <tr>
        <th scope="row">
            <label for="name">Category Name</label>
        </th>
        <td>
            <input
                type="text"
                id="name"
                name="name"
                class="regular-text"
                required
                value="<?php echo esc_attr($category->name ?? ''); ?>"
            />
        </td>
    </tr>

    <tr>
        <th scope="row">
            <label for="slug">Slug</label>
        </th>
        <td>
            <input
                type="text"
                id="slug"
                name="slug"
                class="regular-text"
                value="<?php echo esc_attr($category->slug ?? ''); ?>"
            />
            <p class="description">
                Leave blank to generate automatically.
            </p>
        </td>
    </tr>

    <tr>
        <th scope="row">
            <label for="description">Description</label>
        </th>
        <td>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="large-text"><?php echo esc_textarea($category->description ?? ''); ?></textarea>
        </td>
    </tr>

    <tr>
        <th scope="row">
            <label for="status">Status</label>
        </th>
        <td>
            <select name="status" id="status">
                <option value="publish" <?php selected($category->status ?? '', 'publish'); ?>>
                    Publish
                </option>
                <option value="draft" <?php selected($category->status ?? 'draft', 'draft'); ?>>
                    Draft
                </option>
            </select>
        </td>
    </tr>

</table>

<?php
submit_button(
    !empty($category->id)
        ? 'Update Category'
        : 'Add Category'
);
?>