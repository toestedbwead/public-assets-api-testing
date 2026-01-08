<?php
// api_sender.php - Sends data to Citizen System
function sendToCitizenSystem($announcement_id, $title, $content, $category) {
    
    $api_url = CITIZEN_API_URL;
    $api_key = CITIZEN_API_KEY;
    
    // Prepare data
    $data = [
        'source_system' => 'public_assets',
        'source_id' => $announcement_id,
        'title' => $title,
        'content' => $content,
        'category' => $category
    ];
    
    // Create context for file_get_contents (alternative to cURL)
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 
                "Content-Type: application/json\r\n" .
                "X-API-Key: " . $api_key . "\r\n",
            'content' => json_encode($data),
            'timeout' => 10,
            'ignore_errors' => true // To get response even on HTTP error
        ]
    ];
    
    $context = stream_context_create($options);
    
    try {
        $response = @file_get_contents($api_url, false, $context);
        
        if ($response === FALSE) {
            return [
                'success' => false,
                'error' => 'Could not connect to Citizen system. Is XAMPP running?'
            ];
        }
        
        return json_decode($response, true);
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => 'Exception: ' . $e->getMessage()
        ];
    }
}
?>  