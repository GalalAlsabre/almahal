<div class="card">
    <div class="card-header d-flex justify-content-between">
        <span><i class="fas fa-balance-scale"></i> ميزان المراجعة</span>
        <span>تاريخ التقرير: <?= date('Y-m-d') ?></span>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>كود الحساب</th>
                    <th>اسم الحساب</th>
                    <th class="text-end">مدين (Debit)</th>
                    <th class="text-end">دائن (Credit)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sum_debit = 0;
                $sum_credit = 0;
                foreach ($data as $row):
                    $sum_debit += $row['total_debit'];
                    $sum_credit += $row['total_credit'];
                ?>
                    <tr>
                        <td><?= $row['code'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td class="text-end"><?= number_format($row['total_debit'], 2) ?></td>
                        <td class="text-end"><?= number_format($row['total_credit'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th colspan="2">الإجمالي</th>
                    <th class="text-end"><?= number_format($sum_debit, 2) ?></th>
                    <th class="text-end"><?= number_format($sum_credit, 2) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
