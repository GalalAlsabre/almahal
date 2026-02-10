<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">إجمالي الغرف</h6>
                        <h2 class="mb-0"><?= $stats['total_rooms'] ?></h2>
                    </div>
                    <i class="fas fa-door-open fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">المتاحة الآن</h6>
                        <h2 class="mb-0"><?= $stats['available_rooms'] ?></h2>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">المشغولة</h6>
                        <h2 class="mb-0"><?= $stats['busy_rooms'] ?></h2>
                    </div>
                    <i class="fas fa-user-check fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">تحت التنظيف</h6>
                        <h2 class="mb-0"><?= $stats['dirty_rooms'] ?></h2>
                    </div>
                    <i class="fas fa-broom fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>خريطة الغرف</span>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" onclick="location.reload()"><i class="fas fa-sync"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="room-box room-<?= $room['status'] ?>"
                                 data-bs-toggle="tooltip"
                                 title="<?= $room['type_name'] ?> - <?= number_format($room['base_price']) ?> YER"
                                 onclick="handleRoomClick(<?= $room['id'] ?>, '<?= $room['status'] ?>', '<?= $room['room_number'] ?>')">
                                <span class="fw-bold"><?= $room['room_number'] ?></span>
                                <small style="font-size: 10px;"><?= $room['type_name'] ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                الحجوزات النشطة
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>الغرفة</th>
                                <th>النزيل</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($activeBookings)): ?>
                                <tr><td colspan="3" class="text-center text-muted py-3">لا توجد حجوزات نشطة</td></tr>
                            <?php else: ?>
                                <?php foreach ($activeBookings as $b): ?>
                                    <tr>
                                        <td><?= $b['room_number'] ?></td>
                                        <td><?= $b['guest_name'] ?></td>
                                        <td>
                                            <a href="/bookings/view/<?= $b['id'] ?>" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Booking/Check-in -->
<div class="modal fade" id="roomModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">غرفة <span id="modalRoomNumber"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
function handleRoomClick(id, status, number) {
    document.getElementById('modalRoomNumber').innerText = number;
    const modalBody = document.getElementById('modalBody');

    if (status === 'available') {
        modalBody.innerHTML = `
            <p>الغرفة متاحة. هل تريد البدء في عملية التسكين؟</p>
            <div class="d-grid gap-2">
                <a href="/bookings/new?room_id=${id}" class="btn btn-success">تسكين جديد</a>
            </div>
        `;
    } else if (status === 'busy') {
        modalBody.innerHTML = `
            <p>الغرفة مشغولة حالياً.</p>
            <div class="d-grid gap-2">
                <button class="btn btn-danger" onclick="location.href='/bookings/checkout_view?room_id=${id}'">تسجيل خروج (Check-out)</button>
                <button class="btn btn-primary">إضافة خدمة</button>
            </div>
        `;
    } else if (status === 'dirty') {
        modalBody.innerHTML = `
            <p>الغرفة تحت التنظيف.</p>
            <button class="btn btn-warning w-100" onclick="updateRoomStatus(${id}, 'available')">تم التنظيف - تحويل إلى متاحة</button>
        `;
    } else {
        modalBody.innerHTML = `<p>الغرفة خارج الخدمة.</p>`;
    }

    const myModal = new bootstrap.Modal(document.getElementById('roomModal'));
    myModal.show();
}

function updateRoomStatus(id, status) {
    $.post('/rooms/update_status', {id: id, status: status}, function(res) {
        if(res.success) location.reload();
    });
}
</script>
