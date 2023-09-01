<?php
declare(strict_types=1);

// Get all files in directory
function getFiles(string $srcDir): array
{
    $files = [];

    foreach (scandir($srcDir) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $files[] = $srcDir . $file;
    }
    return $files;
}

// Read file contents
function getTransactions(string $filePath): array
{
    $transactions = [];
    // Open the file for reading
    $fileResource = fopen($filePath, 'r');
    if ($fileResource) {
        $firstLine = fgets($fileResource); // Read the first line

        // Loop through the file line by line
        while (($line = fgets($fileResource)) !== false) {
            // TODO Validate line contains valid columns and corresponding cells
            $lineColumns = [];

            // Split line into 2 segments, before and after '"'
            $intermediates = explode('"', $line);

            // Remove trailing comma
            $firstSegment = rtrim($intermediates[0], ',');
            // Split first segment
            $firstSegment = explode(",", $firstSegment);
            $lineColumns = array_merge($firstSegment, [$intermediates[1]]);

            $transaction = [];
            foreach ($lineColumns as $column) {
                $transaction[] = $column;
            }
            $transactions[] = $transaction;
        }

        fclose($fileResource);
    } else {
        echo "Failed to open the file.";
    }
    return $transactions;
}

function getTransactionData(array $transaction): array
{
    [$date, $checkNumber, $description, $amount] = $transaction;
    return [
        'date' => date('M j, Y', strtotime($date)),
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => str_replace(["$", ","], "", $amount)
    ];
}