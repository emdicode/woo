<?php

function the_module($moduleName = '', $args = [])
{
    if (empty($moduleName)) {
        return false;
    }

    extract($args, EXTR_SKIP);

    locate_template('/modules/' . $moduleName . '/' . $moduleName . '.php', true, false);
}

function get_module($moduleName = '', $args = []): bool|string
{
    if (empty($moduleName)) {
        return false;
    }

    ob_start();
    the_module($moduleName, $args);

    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
