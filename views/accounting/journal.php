<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list"></i> سجل قيود اليومية
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>التاريخ</th>
                    <th>البيان</th>
                    <th>المرجع</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($entries)): ?>
                    <tr><td colspan="4" class="text-center py-3">لا توجد قيود مسجلة بعد</td></tr>
                <?php else: ?>
                    <?php foreach ($entries as $e): ?>
                        <tr>
                            <td><?= $e['id'] ?></td>
                            <td><?= $e['entry_date'] ?></td>
                            <td><?= $e['description'] ?></td>
                            <td><?= $e['reference'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
