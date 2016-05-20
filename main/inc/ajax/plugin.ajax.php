<?php
/* For licensing terms, see /license.txt */
use \Michelf\MarkdownExtra;

/**
 * Responses to AJAX calls
 */

require_once '../global.inc.php';

$action = $_REQUEST['a'];

switch ($action) {
    case 'md_to_html':
        $plugin = isset($_GET['plugin']) ? $_GET['plugin'] : '';
        $appPlugin = new AppPlugin();
        $pluginList = $appPlugin->get_installed_plugins();
        $html = '';
        if (in_array($plugin, $pluginList)) {
            $file = api_get_path(SYS_PLUGIN_PATH).$plugin.'/README.md';
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $html = MarkdownExtra::defaultTransform($content);
            }
        }
        echo $html;
        break;
}