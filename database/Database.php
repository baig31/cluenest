<?php

declare(strict_types=1);

namespace ClueNest\Database;

defined('ABSPATH') || exit;

final class Database
{
    public const VERSION = '1.0.0';

    public static function getPrefix(): string
    {
        global $wpdb;

        return $wpdb->prefix . 'cn_';
    }
}