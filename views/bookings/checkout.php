<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-sign-out-alt"></i> تسجيل خروج - غرفة <?= $booking['room_number'] ?>
            </div>
            <div class="card-body">
                <form action="/bookings/checkout_process" method="POST">
                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">اسم النزيل</label>
                        <input type="text" class="form-control" value="<?= $booking['guest_name'] ?>" disabled>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small text-muted">تاريخ الدخول</label>
                            <div><?= $booking['check_in_date'] ?></div>
                        </div>
                        <div class="col-6">
                            <label class="small text-muted">تاريخ الخروج (اليوم)</label>
                            <div><?= date('Y-m-d') ?></div>
                        </div>
                    </div>

                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>عدد الليالي:</span>
                                <strong><?= $nights ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>سعر الليلة:</span>
                                <strong><?= number_format($booking['base_price']) ?> YER</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>إجمالي الإقامة:</span>
                                <strong><?= number_format($total_room_charge) ?> YER</strong>
                                <input type="hidden" name="total_final" value="<?= $total_room_charge ?>">
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>المدفوع سابقاً (عربون):</span>
                                <strong><?= number_format($booking['paid_amount']) ?> YER</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0">المبلغ المتبقي للسداد:</h5>
                                <h5 class="mb-0 text-danger"><?= number_format($remaining) ?> YER</h5>
                                <input type="hidden" name="remaining_paid" value="<?= $remaining ?>">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info py-2">
                        <i class="fas fa-info-circle"></i> عند التأكيد، سيتم تحويل حالة الغرفة إلى "تحت التنظيف" وتوليد القيود المحاسبية للإيراد.
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg">تأكيد المغادرة وإصدار الفاتورة <i class="fas fa-file-invoice"></i></button>
                        <a href="/dashboard" class="btn btn-light">رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
