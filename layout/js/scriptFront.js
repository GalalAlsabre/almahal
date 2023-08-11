// 
// 
// 

$Products = [];
$PricToon = 0;
$ProName = 0;
$PricProduct = 0;
$NamberToon = 0;




$qtyqty = 0;
$price = 0;
$totalprice = 0;
$td1 = '';
$td5 = '';





$(document).ready(function() {

    $('.type').on('change', function() {
        $ProName = $(this).val();
        $rr = '.Ga' + $ProName;
        $($rr).removeClass('dis_non').siblings('div').addClass('dis_non');

        AddPriceToon($ProName);
        $('.price_toon').val($PricToon);
        $('.price_toon').attr('placeholder', $PricToon);

    });
    // تغير سعر الطن عند تعديل سعر الطن يدوي ويطلع بالنتيجه  
    $('.price_toon').on('change', function() {
        $PricToon = $(this).val();
        $(this).val($PricToon);
        $(this).attr('placeholder', $PricToon);
    });

    // عند اختيار نوع البتر اسود محبب الخ يتم عرض سعر الطن لكل نوع
    $('.betar_chose').on('change', function() {
        $ProNumer = parseInt($(this).val());
        $ProNumer += 100;
        AddThickBetarAtChing($(this).val());
        AddPriceToon($ProNumer);
        $('.price_toon').val($PricToon);
        $('.price_toon').attr('placeholder', $PricToon);

    });


    // shalman
    $('.shalman').on('change', function() { AddThickShalmanAtChing($(this).val()); });
    // mobasat
    $('.mobasat').on('change', function() { AddThickMobasatAtChing($(this).val()); });

    $('.hashap_ver').on('change', function() { AddHorHashabAtChing($(this).val()); });
    // عند تحديد عرض البتره يتم تحديد طوله تلقائي 
    $('.betar_ver').on('change', function() { AddHorrezantelBetarAtChingVertikal($(this).val()); });


    $(".form-horizontal").on('submit', function(e) {
        $(this).next('div').removeClass('dis_non');
        e.preventDefault();

        if ($(this).hasClass('pro1')) {
            // تنفيذ دالة الخاوي
            AddHaweeArry($(this));

        } else if ($(this).hasClass('pro2')) {
            // تنفيذ دالة القصيب
            AddMawaseerArry($(this));

        } else if ($(this).hasClass('pro3')) {
            // تنفيذ دالة الشلمان
            AddShalmansArry($(this));
        } else if ($(this).hasClass('pro4')) {
            // تنفيذ دالة المربع الصم
            AddMorabaaArry($(this));

        } else if ($(this).hasClass('pro5')) {
            // تنفيذ دالة المبسط
            AddMobastArry($(this));

        } else if ($(this).hasClass('pro6')) {
            AddAmlasArry($(this));

        } else if ($(this).hasClass('pro7')) {

            AddZangArry($(this));

        } else if ($(this).hasClass('pro8')) {
            AddBetarArry($(this));

        } else if ($(this).hasClass('pro9')) {
            AddHashabArry($(this));

        }

        // ShowProductsTabelEnd();


    });

    aaaaa();
});

function eeeeeee() {

    $r1 = $('.table_end_show tbody');
    $r2 = $r1.find("tr");
    $r2.each(function() {
        $r3 = $(this).find("td");
        $r3.each(function() {
            if ($(this).find("input.qty").length) {
                $qty = $(this).find('input.qty');

                $qty.closest("td").prev().find('input.price');

                $($qty).on('keyup', function() {
                    $p = $(this).closest("td").prev().find('input.price').val();
                    $n = $(this).closest("td").next("td");

                    $n.html($p * $(this).val());
                    aaaaa();
                    if ($(this).val() == 0) {

                        $(this).closest("td").closest("tr").attr('style', 'color:#c1bebe');
                        // $rr.addClass("yrtuyrtuywtutruytu");
                    } else {
                        $(this).closest("td").closest("tr").attr('style', 'color:black');
                    }
                });
            }
        });
    });

}



function aaaaa() {
    $PricProductTotal = 0;
    $r1 = $('.table_end_show tbody');
    $r2 = $r1.find("tr");
    $r2.each(function() {
        $r3 = $(this).find("td.price_text");
        $r3.each(function() {

            $e = parseInt($(this).text());
            $PricProductTotal += parseInt($(this).text());

            $('.price_pro_total').val($PricProductTotal);
            $('.price_pro_total').attr('placeholder', $PricProductTotal);
        });
    });


    // price qty

}


function AddQtyAnyThink($this, $PricProduct) {
    $count = 1;
    $button = $this.next().children().eq(0).next().children('button');
    $a1 = $button.closest("div").prev("table").children().children().eq(1);


    $g1 = $a1.find("td");
    $g1.each(function() {
        if ($(this).find("input.qty").length) {
            $a2 = $(this).find('input.qty');

            $($a2).on('keyup', function() {

                $p = $(this).closest("td").prev().find('input.price').val();
                $n = $(this).closest("td").next("td");
                $n.html($p * $(this).val());
                aaaaa();
                if ($(this).val() == 0) {

                    $(this).closest("td").closest("tr").attr('style', 'color:#c1bebe');
                } else {
                    $(this).closest("td").closest("tr").attr('style', 'color:black');
                }


                $totalprice = ($p * $(this).val());
                $price = $p;
                $qtyqty = $(this).val();
                $count = $(this).val();

            });
            if ($price == 0 || $qtyqty == 0) {

                // $td2.addClass("ssssss");
                $price = $PricProduct;
                $qtyqty = 1;
                $totalprice = $price * $qtyqty;
            } else {

                $price = $PricProduct;
                $qtyqty = $count;
                $totalprice = $price * $qtyqty;

            }



        }


    });

    aaaaa();
}


// الشلمانننننننننننننننننننننننننننن

function AddShalmansArry($id) {
    // الحقل الاول سماكة الزنج    
    // console.log('11');
    $input1 = $id.find('.input1').val();
    $input2 = $id.find('.input2').val();
    AddNumberToonOfShalmas($input1, $input2);
    // console.log($NamberToon);


    // ايجاد سعر الشلمان
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $td1 = ' <td> شلمان ' + $input1 + 'هـ ' + ' × ' + $input2 + ' تركي ' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);


    AddQtyAnyThink($id, $PricProduct);



}






// المبسططططططططططططططططططططططططططط
function AddMobastArry($id) {

    $input1 = $id.find('.input1').val();
    $input2 = $id.find('.input2').val();
    AddNumberToonOfMobasat($input1, $input2);
    console.log($NamberToon);


    // ايجاد سعر الشلمان
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);



    $td1 = ' <td> مبسط ' + $input1 + 'هـ ' + ' × ' + $input2 + ' تركي ' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $td1, $td2, $td3, $td4, $td5, $PricProduct)

}
// الاملسسسسسسسسسسسسسسسسسسسسسسسسسسسسسسسس
function AddAmlasArry($id) {
    // الحقل الاول للنوع هل مجلفن او اسود
    $input1 = $id.find('.input1').val();
    // لحفظ عدد الطن للاملس
    AddNumberToonOfAmlass($input1);
    // ايجاد سعر الخاوي
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $td1 = ' <td> أملس أبو ' + $input1 + ' ×  6 متر ' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);



}


// الزنجججججججججججججججججججججججج
function AddZangArry($id) {


    // الحقل الاول سماكة الزنج    
    $input1 = $id.find('.input1').val();
    console.log($input1);
    // لحفظ عدد الطن للخاوي
    $NamberToon = Math.round((1000 / 120 / 600 / $input1 / 8.1) * 1000000);
    // ايجاد سعر الخاوي
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $a = '1 × 6 × 0.';

    $td1 = ' <td> زنج هناجر ' + $a + $input1 + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);


}
// المربع الصممممممممممممممممممممممممممممممممم
function AddMorabaaArry($id) {


    // الحقل الاول للنوع هل مجلفن او اسود
    $input1 = $id.find('.input1').val();
    console.log($input1);
    // لحفظ عدد الطن للخاوي
    $NamberToon = Math.round((1000 / $input1 / $input1 / 6 / 7.85) * 1000);
    // ايجاد سعر الخاوي
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $td1 = ' <td> مربع صم ' + $input1 + ' ×  6 متر' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);


}

// القصبببببببببببببببببببببببببببببببب
function AddMawaseerArry($id) {


    $shareha = 0;

    // الحقل الاول للنوع هل مجلفن او اسود
    $input1_size = $id.find('.input1').val();

    $input2_thick = $id.find('.input2').val();

    $input3_diameter = $id.find('.input3').val();
    if ($input3_diameter == 32) {
        if ($input1_size == 1) {
            $shareha = 100;
            $arabik_color = 'قصب 1 هـ';
        }
        if ($input1_size == 1.25) {
            $shareha = 120;
            $arabik_color = 'قصب 1.25 هـ';
        }
        if ($input1_size == 1.5) {
            $shareha = 145;
            $arabik_color = 'قصب 1.5 هـ';
        }
        if ($input1_size == 2) {
            $shareha = 172;
            $arabik_color = 'قصب 2 هـ';
        }
        if ($input1_size == 0.75) {
            $shareha = 75;
            $arabik_color = 'قصب 0.75 هـ';
        }
        if ($input1_size == 0.5) {
            $shareha = 65;
            $arabik_color = 'قصب 0.5 هـ';
        }
    }

    // لحفظ عدد الطن للخاوي
    $NamberToon = Math.round((1000 / $shareha / 6 / 8.1 / parseFloat($input2_thick / 100)) * 1000);
    // ايجاد سعر الخاوي
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $td1 = ' <td>' + $arabik_color + ' × ' + $input2_thick + ' ×  قطر' + $input3_diameter + ' ×  6 متر' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);

}

// الخاوييييييييييييييييييييييييييييييييييي
function AddHaweeArry($id) {
    // لتحديد الكثافه للاسود او الابيض
    $intensity = 0;
    // لحفض الللفض بالعربي للعنصر لاجل عرضه بالمخرجات بشكل عربي
    $arabik_color = '';
    // الحقل الاول للنوع هل مجلفن او اسود
    $input1_color = $id.find('.input1').val();

    if ($input1_color == 'black') {
        $intensity = 7.85;
        $arabik_color = 'خاوي أسود';
    } else {
        $intensity = 8.1;
        $arabik_color = "خاوي مجلفن";
    }
    // العرض للخاوي
    $input2_ver = parseInt($id.find('.input2').val());
    // الطول للخاوي
    $input3_hor = parseInt($id.find('.input3').val());
    // حفظ السماكه قبل تحويله لعدد صحيح وذلك لاجل عرضه بالجدول 
    $th = parseFloat(($id.find('.input4').val()) / 100);
    // تحويل السماكه لعدد صحيح
    $input4_thick = $id.find('.input4').val();
    // لحفظ عدد الطن للخاوي
    $NamberToon = Math.floor((1000 / 6 / 4 / $intensity / (($input2_ver + $input3_hor) / 2) / $input4_thick) * 100000);
    // ايجاد سعر الخاوي
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);


    $td1 = ' <td>' + $arabik_color + '  ' + $input2_ver + ' × ' + $input3_hor + ' ×  ' + $th + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);


}

// البترررررررررررررررررررررررر
function AddBetarArry($id) {

    $input1_type = $id.find('.input1').val();
    $input2_ver = $id.find('.input2').val();
    $input3_hor = $id.find('.input3').val();
    $input3_thick = $id.find('.input4').val();
    $name_arabik = '';
    if ($input2_ver == 100) { $ver = 1; } else if ($input2_ver == 120) { $ver = 4; }
    if ($input3_hor == 200) { $hor = 2; } else if ($input3_hor == 240) { $hor = 8; }
    if ($input1_type == 1) { $name_arabik = 'بتر أسود'; } else if ($input1_type == 2) { $name_arabik = 'بتر محبب'; } else if ($input1_type == 3) { $name_arabik = 'بتر مجلفن'; } else if ($input1_type == 4) { $name_arabik = 'بتر شبك'; }

    AddNumberToonOfBetar($input1_type, $input2_ver, $input3_hor, $input3_thick);
    console.log($NamberToon);
    // ايجاد سعر 
    $PricProduct = parseInt(($PricToon * 143) / $NamberToon);
    // // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);

    $td1 = '<td>' + $name_arabik + '  ' + $ver + ' × ' + $hor + ' ×  ' + $input3_thick + ' تركي ' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);

}


// الخشبببببببببببببببببببببببببببببب
function AddHashabArry($id) {

    $input1_ver = $id.find('.input1').val();
    $input2_hor = $id.find('.input2').val();
    $input3_tool = $id.find('.input3').val();

    if ($input1_ver == 3 && $input2_hor == 5) {
        $NamberToon = Math.round((480 / $input3_tool) * 1);
    } else if ($input1_ver == 3 && $input2_hor == 6) {
        $NamberToon = Math.round((400 / $input3_tool) * 1);
    } else if ($input1_ver == 4 && $input2_hor == 6) {
        $NamberToon = Math.round((300 / $input3_tool) * 1);
    }
    // ايجاد سعر الخشبه
    $PricProduct = parseInt($PricToon / $NamberToon);
    // العنصر اللذي بنعرض مخرجاتنا فيه
    $table_show = $id.next(".table-responsive").children('table').children().children().eq(1);


    $td1 = '<td>' + 'خشب ' + $input1_ver + ' × ' + $input2_hor + ' × ' + $input3_tool + ' KTS ' + '</td>';
    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $PricProduct + '" value="' + $PricProduct + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="1" placeholder="1" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $PricProduct + ' </td>';
    $td5 = '<td> ' + $NamberToon + '</td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;
    $table_show.html($eee);

    AddQtyAnyThink($id, $PricProduct);

}




$('[placeholder]').focus(function() {

    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this).attr('placeholder', '');

}).blur(function() {

    $(this).attr('placeholder', $(this).attr('data-text'));
});


$('input').focus(function() {

    $(this).val('');
    $(this).attr('placeholder', '');

}).blur(function() {

    $(this).attr('placeholder', $(this).attr('data-text'));
});

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function AddNumberToonOfShalmas($input1, $input2) {
    if ($input1 == 1 && $input2 == 1.9) { $NamberToon = 249; } else if ($input1 == 1.25 && $input2 == 1.9) { $NamberToon = 235; } else if ($input1 == 0.75 && $input2 == 1.9) {
        $NamberToon = 322;
    } else if ($input1 == 1.5 && $input2 == 1.9) { $NamberToon = 174; } else if ($input1 == 1.5 && $input2 == 3.2) {
        $NamberToon = 110;
    } else if ($input1 == 2 && $input2 == 2.2) { $NamberToon = 110; } else if ($input1 == 2 && $input2 == 3.2) {
        $NamberToon = 84;
    } else if ($input1 == 2 && $input2 == 3.6) { $NamberToon = 73; } else if ($input1 == 2 && $input2 == 4.2) {
        $NamberToon = 65;
    } else if ($input1 == 2.5 && $input2 == 4) { $NamberToon = 100; }
}

function AddNumberToonOfMobasat($input1, $input2) {
    if ($input1 == 1 && $input2 == 2.8) { $NamberToon = 335; } else if ($input1 == 1.25 && $input2 == 2.8) { $NamberToon = 281; } else if ($input1 == 1.5 && $input2 == 2.8) {
        $NamberToon = 216;
    } else if ($input1 == 2 && $input2 == 2.8) { $NamberToon = 153; } else if ($input1 == 2 && $input2 == 4.7) {
        $NamberToon = 91;
    } else if ($input1 == 0.5 && $input2 == 2.8) { $NamberToon = 689; } else if ($input1 == 0.75 && $input2 == 2.8) {
        $NamberToon = 441;
    }
}
// اضافة عدد الطن للاملس
function AddNumberToonOfAmlass($input1) {
    if ($input1 == 16) { $NamberToon = 106; } else if ($input1 == 14) { $NamberToon = 136; } else if ($input1 == 11.5) { $NamberToon = 203; }
}

// عدد الطن للبتر
function AddNumberToonOfBetar($input1, $input2, $input3, $input4) {
    $ww = 0;
    if ($input1 == 3) { $ww = 8.1; } else if ($input1 == 1 || $input1 == 2 || $input1 == 4) { $ww = 7.85; }
    if ($input1 == 1 || $input1 == 2 || $input1 == 3) {
        $NamberToon = Math.round((1000 / $input2 / $input3 / $ww / parseFloat($input4 / 100)) * 10000);
    } else if ($input1 == 4) {
        if ($input2 == 100 && $input3 == 200) {
            if ($input4 == 1.5) { $NamberToon = 227; } else if ($input4 == 1.8) { $NamberToon = 185; } else if ($input4 == 2.5) { $NamberToon = 129; } else if ($input4 == 3.2) { $NamberToon = 105; }
        } else if ($input2 == 120 && $input3 == 240) {
            if ($input4 == 1.5) { $NamberToon = 165; } else if ($input4 == 1.8) { $NamberToon = 145; } else if ($input4 == 2.5) { $NamberToon = 105; } else if ($input4 == 3.2) { $NamberToon = 83; }

        }
    }

}

// ////////////////////////////////////////////////////////
// ///

// 
// ///////////////////////////////////////////////

function AddPriceToon(id) {
    if (id == 1) {
        $PricToon = 4400;
    } else if (id == 2) {
        $PricToon = 4400;
    } else if (id == 3) {
        $PricToon = 3700;
    } else if (id == 4) {
        $PricToon = 3600;
    } else if (id == 5) {
        $PricToon = 3600;
    } else if (id == 6) {
        $PricToon = 4300;
    } else if (id == 7) {
        $PricToon = 5300;
    } else if (id == 8) {
        $PricToon = 6000;
    } else if (id == 9) {
        $PricToon = 400000;
    } else if (id == 101) {
        $PricToon = 4800;

    } else if (id == 102) {
        $PricToon = 5500;
    } else if (id == 103) {
        $PricToon = 5500;
    } else if (id == 104) {
        $PricToon = 6000;
    }

}
// hashapppppppppppppppp
function AddHorHashabAtChing($id) {

    if ($id == 3) {
        $option = '<option value="5"> 5</option><option value="6"> 6</option>';
        $('.hashap_hor').html($option);
    } else if ($id == 4) {
        $option = '<option value="6"> 6</option>';
        $('.hashap_hor').html($option);
    }
}
// shalmaaannnnnnnnnnnnnnnnnnnnn
function AddThickShalmanAtChing($id) {
    if ($id == 1 || $id == 1.25 || $id == 0.75) {
        $option = '<option value="1.9"> 1.9</option>';
        $('.shalman_thick').html($option);
    } else if ($id == 1.5) {
        $option = ' <option value="1.9"> 1.9</option><option value="3.2">3.2</option>';
        $('.shalman_thick').html($option);
    } else if ($id == 2) {
        $option = ' <option value="2.2">2.2</option><option value="3.2">3.2</option><option value="3.6"> 3.6 </option><option value="4.2"> 4.2 </option>';
        $('.shalman_thick').html($option);
    } else if ($id == 2.5) {
        $option = '<option value="4">4 </option>';
        $('.shalman_thick').html($option);
    }
}
// mobasatttttttttttttttttttttt

function AddThickMobasatAtChing($id) {
    if ($id == 1 || $id == 1.25 || $id == 1.5 || $id == 0.75 || $id == 0.5) {
        $option = '<option value="2.8"> 2.8</option>';
        $('.mobasat_thick').html($option);
    } else if ($id == 2) {
        $option = '<option value="2.8"> 2.8</option><option value="4.7"> 4.7</option>';
        $('.mobasat_thick').html($option);
    }
}
// betarrrrrrrrrrrrrrrrrrrrr
function AddThickBetarAtChing($id) {
    if ($id == 1 || $id == 2 || $id == 3) { //اذا البتره اسود
        $option = '<input type="number" name="UserName" class="form-control input4" placeholder="80" autocomplete="off" required="required"  />';
        $('.betar_thick').html($option);
    } else if ($id == 4) { //اذا البتره شبك
        $option = ' <select name="statuse" class="form-control input4"><option value="1.5"> 1.5 </option><option value="1.8">1.8</option><option value="2.5">2.5</option><option value="3.2">3.2</option></select>';
        $('.betar_thick').html($option);
    }
}

// بتر عند اختيار العرض يعطينا الطول
function AddHorrezantelBetarAtChingVertikal($id) {

    if ($id == 120) { //اذا البتره شبك
        $option = '<option value="240"> 8 </option>';
        $('.betar_hor').html($option);
    } else if ($id == 100) { //اذا البتره شبك
        $option = '<option value="200"> 2</option>';
        $('.betar_hor').html($option);
    }
}

// tabel enddddddddddddddddddd
function ShowProductsTabelEnd() {
    $oo = '<tr class="main-tabel"><td>#</td><td> الصنف</td><td> السعر</td><td>الكميه</td><td> السعر النهائي</td><td>حذف</td></tr>';
    $tt = 1

    $rr = $('.table_end_show');
    $rr.html('');
    $rr.append($oo);
    for ($i = 0; $i < $Products.length; $i++) {
        $rr.append('<tr><td> ' + $tt++ + '</td>' + $Products[$i] + '</tr>');
    }

    eeeeeee();



}



$b = $('.table-responsive').children("div").children("button").addClass("sssssssssssssssss");
$b.on('click', function() {
    console.log($totalprice + "www" + $price + "yyyy" + $qtyqty + 'azzaz' + $count++);

    $td2 = '<td  style="width: 22%;"> ' + ' <input type="number" class="form-control qty_shalman price" placeholder="' + $price + '" value="' + $price + '" />' + '</td>';
    $td3 = '<td style="width: 11%;">' + '<input type="number" class="form-control qty_shalman qty" value="' + $qtyqty + '" placeholder="' + $qtyqty + '" autocomplete="off" />' + '</td>';
    $td4 = '<td class="price_text"> ' + $totalprice + ' </td>';
    $eee = $td1 + $td2 + $td3 + $td4 + $td5;

    $Products.push($eee);


    ShowProductsTabelEnd();
    aaaaa();

});