<?php

if (!empty($_FILES["file"]["name"])) {

    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
    );

    $result = array();

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {

            //URL to the variable
            $url = $getData[0];

            // Use get_headers() function
            $headers = @get_headers($url);

            //Set in result varial           
            array_push(
                $result,
                array(
                    "url" => $url,
                    "status" => $headers[0],
                )
            );
        }
        // Close opened CSV file
        fclose($csvFile);
        echo json_encode($result);
    } else {
        echo "Error";
    }
} else {
    echo "Error";
}
