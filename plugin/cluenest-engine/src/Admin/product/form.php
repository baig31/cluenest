<?php

defined('ABSPATH') || exit;
?>

<form method="post">

    <?php wp_nonce_field('cluenest_create_product'); ?>

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

                    <option value="draft">Draft</option>
                    <option value="published">Published</option>

                </select>
            </td>
        </tr>

    </table>

    <?php submit_button('Save Product'); ?>

</form>