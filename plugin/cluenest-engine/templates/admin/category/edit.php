<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">

    <h1>Edit Category</h1>

    <form method="post">

        <?php wp_nonce_field('cluenest_update_category'); ?>

        <?php require CN_PLUGIN_PATH . 'templates/admin/category/form.php'; ?>

    </form>

</div>