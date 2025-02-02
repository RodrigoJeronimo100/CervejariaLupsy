<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $fatura common\models\Fatura */
/* @var $items common\models\ItemFatura[] */

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<h1>Fatura #<?= Html::encode($fatura->id) ?></h1>
<p><strong>Data:</strong> <?= Html::encode($fatura->data_fatura) ?></p>
<p><strong>Total:</strong> <?= number_format($fatura->total, 2, ',', '.') ?> €</p>
<p><strong>Status:</strong> <?= Html::encode($fatura->estado) ?></p>

<table>
    <thead>
    <tr>
        <th>Item ID</th>
        <th>Cerveja</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= Html::encode($item->id) ?></td>
            <td><?= Html::encode($item->id_cerveja) ?></td>
            <td><?= Html::encode($item->quantidade) ?></td>
            <td><?= number_format($item->preco_unitario, 2, ',', '.') ?> €</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><strong>Obrigado pela sua compra!</strong></p>



