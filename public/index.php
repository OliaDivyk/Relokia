<?php
require 'vendor/autoload.php';

$credentials = base64_encode('olia.divyk@gmail.com:olia2805' ) ;
$client = new GuzzleHttp\Client;

$json = $client->request('GET',
    'https://oliadivyk.zendesk.com/api/v2/tickets.json',
    ['headers' =>
        [
            'Authorization' => "Basic {$credentials}"
        ]
    ])->getBody()->getContents();

$data = json_decode($json, true);

$csv = array();

foreach ( $data['tickets'] as $index => $ticket) {
    $csv[$index] = array(
        'Ticket ID' => $ticket['id'],
        'Description' => $ticket['description'],
        'Status' => $ticket['status'],
        'Priority'=> $ticket['priority'],
        'Group_id' => $ticket['group_id'],
        'Organization_id' => $ticket['organization_id']
    );
}

$filename = 'zandesk.csv';

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

$header = array_keys($csv[0]);

fputcsv($output, $header);

foreach ($csv as $row) {
    fputcsv($output, $row);
}
fclose($output);
