<?php
function generateText($input) {
    $apiKey = 'AIzaSyDOHW7JhFJYdDbItJLUYpbhVqwRg2yplkM'; // Replace with your actual API key
    $url = 'https://generativelanguage.googleapis.com/v1/generateText'; // API endpoint for generating text

    // Prepare the data to be sent in the request
    $data = [
        'prompt' => $input,
        // Add other parameters as required by the API
    ];

    // Initialize cURL session
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return null; // Return null on error
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response
    $decodedResponse = json_decode($response, true);

    // Check for API-specific errors in the response
    if (isset($decodedResponse['error'])) {
        echo 'API error: ' . $decodedResponse['error']['message'];
        return null; // Return null on API error
    }

    return $decodedResponse; // Return the decoded response
}

// Example usage
$inputData = "What is the capital of France?";
$response = generateText($inputData);

if ($response) {
    print_r($response); // Process the response as needed
} else {
    echo "Error generating text.";
}
?>