<?php
function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("Environment file not found: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split the line into name and value
        [$name, $value] = explode('=', $line, 2);

        // Remove surrounding whitespace and quotes
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        // Set the environment variable
        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
}
?>