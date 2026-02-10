<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h3>قائمة الدخل</h3>
                <p class="mb-0">للفترة المنتهية في <?= date('Y-m-d') ?></p>
            </div>
            <div class="card-body">
                <h5 class="border-bottom pb-2 mb-3 text-success">الإيرادات</h5>
                <?php
                $total_rev = 0;
                foreach ($revenues as $rev):
                    $total_rev += $rev['balance'];
                ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $rev['name'] ?></span>
                        <span><?= number_format($rev['balance'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-between fw-bold border-top pt-2 mb-4">
                    <span>إجمالي الإيرادات</span>
                    <span><?= number_format($total_rev, 2) ?></span>
                </div>

                <h5 class="border-bottom pb-2 mb-3 text-danger">المصروفات</h5>
                <?php
                $total_exp = 0;
                foreach ($expenses as $exp):
                    $total_exp += $exp['balance'];
                ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $exp['name'] ?></span>
                        <span><?= number_format($exp['balance'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-between fw-bold border-top pt-2 mb-4">
                    <span>إجمالي المصروفات</span>
                    <span><?= number_format($total_exp, 2) ?></span>
                </div>

                <div class="card <?= ($total_rev - $total_exp) >= 0 ? 'bg-success' : 'bg-danger' ?> text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">صافي الربح / (الخسارة)</h4>
                        <h4 class="mb-0"><?= number_format($total_rev - $total_exp, 2) ?> YER</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
