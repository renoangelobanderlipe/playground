<?php

if (!function_exists('convertArrayKeysToTitleCase')) {
  function convertArrayKeysToTitleCase(array $data)
  {
    return array_map(function ($data) {
      return ucwords(str_replace('_', ' ', $data));
    }, $data);
  }
}
