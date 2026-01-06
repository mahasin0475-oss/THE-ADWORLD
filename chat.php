<?php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$userMessage = $input["message"];

$systemPrompt = "
You are an AI assistant for THE ADWORLD.
Company Details:
- Services: Graphic Designing, Logo Design, Printing, T-Shirt Design, Book & Cover Design,
  ID Card Printing, Photo Editing & Printing, Banner, Flex, Hoarding, Packaging Design,
  Complete Company Branding.
- Working Hours: 9:30 AM to 7:00 PM.
- Location: DLF Phase 3, V Block 11/44.
- Contact Number: 8851168835.
- Delivery Time: 2 to 5 working days.
Reply professionally, short and clear in English.
";

$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role"=>"system","content"=>$systemPrompt],
        ["role"=>"user","content"=>$userMessage]
    ]
];

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: "Authorization: Bearer YOUR_OPENAI_API_KEY"

]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
