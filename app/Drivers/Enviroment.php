<?php
namespace App\Drivers;
class Enviroment {
  public static function set(array $values) {
    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);
    if (count($values) > 0) {
      foreach ($values as $envKey => $envValue) {
        $envValue = '"' . str_replace("\r\n", "#BRBN&", $envValue) . '"';
        $str .= "\n"; // In case the searched variable is in the last line without \n
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, "\n", $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

        // If key does not exist, add it
        if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
          $str .= "{$envKey}={$envValue}\n";
        } else {
          $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        }
      }
    }
    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str)) {
      return false;
    }
    return true;
  }
  public static function get($key, $default=''){
    $value = env($key, $default);
    return str_replace("#BRBN&", "\r\n", $value);
  }
}