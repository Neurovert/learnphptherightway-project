<?php
declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);


require APP_PATH . "App.php";
require APP_PATH . "helpers.php";

$files = getFiles(FILES_PATH);

$transactions = [];
$expenses = 0.0;
$netTotal = 0.0;
$income = 0.0;

foreach ($files as $file) {
    $transactionStrings = getTransactions($file);
    foreach ($transactionStrings as $transaction) {
        $data = getTransactionData($transaction);
        $transactions[] = $data;
        $amount = (float)$data['amount'];
        if ($amount < 0) {
            $expenses += $amount;

        } else {
            $income += $amount;
        }
    }
    $netTotal = $expenses + $income;
}

require VIEWS_PATH . "transactions.php";

