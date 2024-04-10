<?php
// Create a folder to store PHP files if not exists
if (!file_exists('php_files')) {
    mkdir('php_files');
}

// Retrieve PHP code from POST request
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);
$code = $data['code'];

// Save PHP code to a file
$filename = 'php_files/' . uniqid('php_code_', true) . '.php';
file_put_contents($filename, $code);

// Execute PHP code and capture output
ob_start();
$result = eval('?>' . $code);
$output = ob_get_clean();

// Display errors, if any
if ($result === false) {
    echo "Error occurred:\n";
    echo error_get_last()['message'];
} else {
    echo "Output:\n";
    echo $output;
}
?>
