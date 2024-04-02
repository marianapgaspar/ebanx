
$(".calc_a").keyup(function(){
    var dist_medicao = Number(($("[name=ens8_dist_medicao]").val()).replace(",","."));
    var comprimento = Number(($("[name=ens8_sup_med_compr]").val()).replace(",","."));

    if((dist_medicao != '') && (comprimento != '')){
        var total = dist_medicao + (comprimento/2);
        $("[name=ens8_area_super_med_a]").val((total.toFixed(4)).replace(".",","));
    }else{
        $("[name=ens8_area_super_med_a]").val('');
    }
    calcula_s();
});

$(".calc_b").keyup(function(){
    var dist_medicao = Number(($("[name=ens8_dist_medicao]").val()).replace(",","."));
    var largura = Number(($("[name=ens8_sup_med_larg]").val()).replace(",","."));

    if((dist_medicao != '') && (largura != '')){
        var total = dist_medicao + (largura/2);
        $("[name=ens8_area_super_med_b]").val((total.toFixed(4)).replace(".",","));
    }else{
        $("[name=ens8_area_super_med_b]").val('');
    }
    calcula_s();
});

$(".calc_c").keyup(function(){
    var dist_medicao = Number(($("[name=ens8_dist_medicao]").val()).replace(",","."));
    var altura = Number(($("[name=ens8_sup_med_alt]").val()).replace(",","."));

    if((dist_medicao != '') && (altura != '')){
        var total = dist_medicao + altura;
        $("[name=ens8_area_super_med_c]").val((total.toFixed(4)).replace(".",","));
    }else{
        $("[name=ens8_area_super_med_c]").val('');
    }
    calcula_s();
});

function calcula_s(){
    var calc_a = Number(($("[name=ens8_area_super_med_a]").val()).replace(",","."));
    var calc_b = Number(($("[name=ens8_area_super_med_b]").val()).replace(",","."));
    var calc_c = Number(($("[name=ens8_area_super_med_c]").val()).replace(",","."));

    if((calc_a != '') && (calc_b != '') && (calc_c != '')){
        var total = 4 * ((calc_a * calc_b) + (calc_b * calc_c) + (calc_c * calc_a));
        $("[name=ens8_area_super_med_s]").val((total.toFixed(4)).replace(".",","));
    }else{
        $("[name=ens8_area_super_med_s]").val('');
    }
}

$(".v1_calc").keyup(function(){
    var v1 = Number(($("[name=ens8_vert_sup1]").val()).replace(",","."));

    if((v1 != '')){
        var total = 10**(v1 / 10);
        $("[name=ens8_vert_sup1_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_vert_sup1_calc]").val('');
    }
});

$(".v2_calc").keyup(function(){
    var v2 = Number(($("[name=ens8_vert_sup2]").val()).replace(",","."));

    if((v2 != '')){
        var total = 10**(v2 / 10);
        $("[name=ens8_vert_sup2_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_vert_sup2_calc]").val('');
    }
});

$(".v3_calc").keyup(function(){
    var v3 = Number(($("[name=ens8_vert_sup3]").val()).replace(",","."));

    if((v3 != '')){
        var total = 10**(v3 / 10);
        $("[name=ens8_vert_sup3_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_vert_sup3_calc]").val('');
    }
});

$(".v4_calc").keyup(function(){
    var v4 = Number(($("[name=ens8_vert_sup4]").val()).replace(",","."));

    if((v4 != '')){
        var total = 10**(v4 / 10);
        $("[name=ens8_vert_sup4_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_vert_sup4_calc]").val('');
    }
});

$(".s_calc").keyup(function(){
    var s = Number(($("[name=ens8_sup_horizontal]").val()).replace(",","."));

    if((s != '')){
        var total = 10**(s / 10);
        $("[name=ens8_sup_horizontal_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_sup_horizontal_calc]").val('');
    }
});

$(".s12_calc").keyup(function(){
    var s = Number(($("[name=ens8_sup_vert1]").val()).replace(",","."));

    if((s != '')){
        var total = 10**(s / 10);
        $("[name=ens8_sup_vert1_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_sup_vert1_calc]").val('');
    }
});

$(".s14_calc").keyup(function(){
    var s = Number(($("[name=ens8_sup_vert2]").val()).replace(",","."));

    if((s != '')){
        var total = 10**(s / 10);
        $("[name=ens8_sup_vert2_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_sup_vert2_calc]").val('');
    }
});

$(".s23_calc").keyup(function(){
    var s = Number(($("[name=ens8_sup_vert3]").val()).replace(",","."));

    if((s != '')){
        var total = 10**(s / 10);
        $("[name=ens8_sup_vert3_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_sup_vert3_calc]").val('');
    }
});

$(".s34_calc").keyup(function(){
    var s = Number(($("[name=ens8_sup_vert4]").val()).replace(",","."));

    if((s != '')){
        var total = 10**(s / 10);
        $("[name=ens8_sup_vert4_calc]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=ens8_sup_vert4_calc]").val('');
    }
});

$(".calc_total_input").keyup(function(){
    var total = 0;
    var valor = "";
    var lp = 0;
    var lp_la = 0;
    var k = 0;
    var lw = 0;
    var med_pressao = Number(($("[name=ens8_med_pressao]").val()).replace(",","."));
    var s = Number(($("[name=ens8_area_super_med_s]").val()).replace(",","."));

    $.each( $( ".calc_total" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    lp = 10 * Math.log10((1/9) * total);
    lp_la = lp - med_pressao;

    if(lp_la < 6){
        k = 0;
    }else if(lp_la >= 6 && lp_la <= 8){
        k = 1;
    }else if(lp_la > 8 && lp_la <= 10){
        k = 0.5;
    }else{
        k = 0;
    }

    lw = (lp - k) + (10 * Math.log10(s));
    
    lp = (isNaN(lp)) ? "" : (lp.toFixed(2)).replace(".",",");
    lw = (s == '') ? "" : (lw.toFixed(2)).replace(".",",");

    $("[name=ens8_lp]").val(lp);
    $("[name=ens8_fator_conv_k_db_a]").val(k);
    $("[name=ens8_lw]").val(lw);

});
