<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="fas fa-plus-circle"></i> إنشاء سند قبض جديد
            </div>
            <div class="card-body">
                <form action="/accounting/save_voucher" method="POST">
                    <input type="hidden" name="voucher_type" value="receipt">

                    <div class="mb-3">
                        <label class="form-label">التاريخ</label>
                        <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الحساب الدائن (مصدر الأموال)</label>
                        <select name="credit_account_id" class="form-select" required>
                            <option value="3">ذمم النزلاء</option>
                            <option value="4">إيرادات الإقامة</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">المبلغ (YER)</label>
                        <input type="number" name="amount" class="form-control" required step="0.01">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البيان / الوصف</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="مثلاً: دفعة مقدمة من العميل..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">حفظ وتدقيق السند <i class="fas fa-save"></i></button>
                        <a href="/accounting" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
