<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>شجرة الحسابات والأرصدة</h3>
    <div>
        <a href="/accounting/voucher_receipt" class="btn btn-success"><i class="fas fa-plus-circle"></i> سند قبض</a>
        <a href="/accounting/voucher_payment" class="btn btn-danger"><i class="fas fa-minus-circle"></i> سند صرف</a>
        <a href="/accounting/journal" class="btn btn-primary"><i class="fas fa-list"></i> قيود اليومية</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>الكود</th>
                    <th>اسم الحساب</th>
                    <th>النوع</th>
                    <th class="text-end">الرصيد الحالي (YER)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $acc): ?>
                    <tr>
                        <td><?= $acc['code'] ?></td>
                        <td><?= $acc['name'] ?></td>
                        <td>
                            <span class="badge bg-<?= $acc['type'] == 'asset' ? 'info' : ($acc['type'] == 'revenue' ? 'success' : ($acc['type'] == 'expense' ? 'danger' : 'secondary')) ?>">
                                <?= $acc['type'] ?>
                            </span>
                        </td>
                        <td class="text-end fw-bold <?= ($acc['balance'] < 0 && $acc['type'] == 'asset') ? 'text-danger' : '' ?>">
                            <?= number_format($acc['balance'] ?? 0, 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
