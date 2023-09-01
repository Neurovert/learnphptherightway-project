<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Check #</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($transactions)): ?>
        hihi
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $transaction['date'] ?></td>
                <td><?= $transaction['checkNumber'] ?></td>
                <td><?= $transaction['description'] ?></td>
                <td>
                    <?php if ($transaction['amount'] < 0): ?>
                    <span style="color: red;">
                    <?php elseif ($transaction['amount'] > 0): ?>
                        <span style="color: green;">
                    <?php endif ?>
                    <?= amountFormat($transaction['amount']) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Total Income:</th>
        <td> <?php if ($income > 0): ?>
                <span style="color: green;">
                <?= amountFormat($income) ?>
            </span>
            <?php else : ?>
                <span>
                    <?= amountFormat($income) ?>
                </span>
            <?php endif ?>
        </td>
    </tr>
    <tr>
        <th colspan="3">Total Expense:</th>
        <td> <?php if ($expenses < 0): ?>
                <span style="color: red;">
                <?= amountFormat($expenses) ?>
                </span>
            <?php else : ?>
                <span>
                <?= amountFormat($expenses) ?>
            </span>
            <?php endif ?></td>
    </tr>
    <tr>
        <th colspan="3">Net Total:</th>
        <td> <?php if ($netTotal < 0): ?>
                <span style="color: red;">
                <?= amountFormat($netTotal) ?>
            </span>
            <?php else: ?>
                <span style="color: green;">
                <?= amountFormat($netTotal) ?>
            </span>
            <?php endif ?>
        </td>
    </tr>
    </tfoot>
</table>
</body>
</html>