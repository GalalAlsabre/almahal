<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-user-plus"></i> تسكين نزيل جديد - غرفة <?= $room['room_number'] ?>
            </div>
            <div class="card-body">
                <form action="/bookings/create" method="POST">
                    <input type="hidden" name="room_id" value="<?= $room['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">اسم النزيل الرباعي</label>
                        <input type="text" name="guest_name" class="form-control" required placeholder="مثلاً: أحمد محمد علي">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الهوية / الجواز</label>
                            <input type="text" name="id_number" class="form-control">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">نوع الغرفة</label>
                            <input type="text" class="form-control" value="<?= $room['type_name'] ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">السعر لليلة (YER)</label>
                            <input type="text" class="form-control" value="<?= number_format($room['base_price']) ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">مبلغ العربون / الدفعة المقدمة</label>
                        <div class="input-group">
                            <input type="number" name="deposit" class="form-control" value="0">
                            <span class="input-group-text">YER</span>
                        </div>
                        <small class="text-muted">سيتم إنشاء سند قبض آلي بهذا المبلغ.</small>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">تأكيد الحجز والتسكين <i class="fas fa-check-circle"></i></button>
                        <a href="/dashboard" class="btn btn-light">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
