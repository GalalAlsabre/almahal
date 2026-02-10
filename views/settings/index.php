<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-hotel"></i> إعدادات الفندق العامة
            </div>
            <div class="card-body">
                <form action="/settings/save" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم الفندق</label>
                            <input type="text" name="hotel_name" class="form-control" value="<?= $settings['hotel_name'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">العملة الافتراضية</label>
                            <input type="text" name="currency" class="form-control" value="<?= $settings['currency'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">تفعيل الضريبة</label>
                            <select name="tax_enabled" class="form-select">
                                <option value="1" <?= $settings['tax_enabled'] == '1' ? 'selected' : '' ?>>مفعل</option>
                                <option value="0" <?= $settings['tax_enabled'] == '0' ? 'selected' : '' ?>>معطل</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نسبة الضريبة (%)</label>
                            <input type="number" name="tax_rate" class="form-control" value="<?= $settings['tax_rate'] ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ التغييرات <i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <i class="fas fa-users-cog"></i> إدارة المستخدمين
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>اسم المستخدم</th>
                            <th>الصلاحية</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>مدير النظام</td>
                            <td>admin</td>
                            <td><span class="badge bg-dark">مدير</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
