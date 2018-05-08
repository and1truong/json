<?php

define('BASE_URL', 'http://jsonviewer.stack.hu');

if ('cli-server' === php_sapi_name()) {
    $file = preg_replace('/\?.+/', '', __DIR__ . $_SERVER['REQUEST_URI']);

    if (!is_file($file)) {
      $url = str_replace(__DIR__, $base_url, $file);
      $path = trim(parse_url($url)['path'], '/');
      $dir = dirname($path);

      exec(implode('; ', [
        "mkdir -p '$dir'",
        "wget '$url' -O '$path'"
      ]));
    }

    return false;
}
