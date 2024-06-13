#!/usr/bin/env php
<?php

// Prompt the user to enter the target directory path
$target_directory = readline("Enter the directory path where you want to create README.md: ");

// Trim any extra whitespace from user input
$target_directory = trim($target_directory);

// Validate the input directory path
if (empty($target_directory)) {
    echo "Error: Directory path cannot be empty.\n";
    exit(1);
}

// Ensure the target directory exists or create it if it doesn't
if (!is_dir($target_directory)) {
    if (!mkdir($target_directory, 0777, true)) {
        echo "Error: Failed to create target directory: $target_directory\n";
        exit(1);
    }
}

// File path for the template README.md file
$template_readme_file = __DIR__ . DIRECTORY_SEPARATOR . 'README_template.md';

// File path for the target README.md file
$readme_file = $target_directory . DIRECTORY_SEPARATOR . 'README.md';

// Check if the template README.md file exists
if (!file_exists($template_readme_file)) {
    echo "Error: Template README file not found.\n";
    exit(1);
}

// Read content from the template README.md file
$readme_content = file_get_contents($template_readme_file);

// Create the README.md file in the target directory
$file_handle = fopen($readme_file, 'w');

if ($file_handle === false) {
    echo "Failed to create README.md file in $target_directory.\n";
    exit(1);
}

if (fwrite($file_handle, $readme_content) === false) {
    echo "Failed to write content to README.md file.\n";
    fclose($file_handle);
    exit(1);
}

fclose($file_handle);

echo "README.md file has been successfully created in $target_directory.\n";
