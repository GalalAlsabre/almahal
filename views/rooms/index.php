<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>إدارة الغرف</h3>
    <button class="btn btn-primary"><i class="fas fa-plus"></i> إضافة غرفة جديدة</button>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>رقم الغرفة</th>
                            <th>الطابق</th>
                            <th>النوع</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                            <th>الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td><?= $room['room_number'] ?></td>
                                <td><?= $room['floor'] ?></td>
                                <td><?= $room['type_name'] ?></td>
                                <td><?= number_format($room['base_price']) ?> YER</td>
                                <td>
                                    <span class="status-badge room-<?= $room['status'] ?>">
                                        <?= $room['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
