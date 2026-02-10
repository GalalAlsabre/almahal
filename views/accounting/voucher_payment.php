<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-minus-circle"></i> إنشاء سند صرف جديد
            </div>
            <div class="card-body">
                <form action="/accounting/save_voucher" method="POST">
                    <input type="hidden" name="voucher_type" value="payment">

                    <div class="mb-3">
                        <label class="form-label">التاريخ</label>
                        <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">حساب المصروف</label>
                        <select name="debit_account_id" class="form-select" required>
                            <option value="">اختر الحساب...</option>
                            <?php foreach ($expenses as $exp): ?>
                                <option value="<?= $exp['id'] ?>"><?= $exp['code'] ?> - <?= $exp['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">المبلغ (YER)</label>
                        <input type="number" name="amount" class="form-control" required step="0.01">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البيان / الوصف</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="مثلاً: سداد فاتورة كهرباء شهر يناير"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">حفظ وتدقيق السند <i class="fas fa-save"></i></button>
                        <a href="/accounting" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
