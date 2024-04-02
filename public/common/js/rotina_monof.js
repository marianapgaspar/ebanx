
$("[name=i1_carga_inf]").keyup(function(){
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( "[name=i1_carga_inf]" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 3){
        var total = total / 3;
        $("[name=il_carga_inf]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_carga_inf]").val('');
    }
});
$("[name=i1_carga_100]").keyup(function(){
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( "[name=i1_carga_100]" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 3){
        var total = total / 3;
        $("[name=il_carga_100]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_carga_100]").val('');
    }
});
$(".i_carga_75").keyup(function(){
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( ".i_carga_75" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 3){
        var total = total / 3;
        $("[name=il_carga_75]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_carga_75]").val('');
    }
});
$(".i_carga_50").keyup(function(){
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( ".i_carga_50" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 3){
        var total = total / 3;
        $("[name=il_carga_50]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_carga_50]").val('');
    }
});

$(".imax_a_calc").keyup(function(){
    var corrente_a = Number(($("[name=corrente_a]").val()).replace(",","."));
    var tensao_base = Number(($("[name=tensao_base]").val()).replace(",","."));
    var tensao_v = Number(($("[name=tensao_v]").val()).replace(",","."));
    
    if((corrente_a != '') && (tensao_base != '') && (tensao_v != '')){
        var total = ((corrente_a * tensao_base) / tensao_v);
        $("[name=imax_a]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=imax_a]").val('');
    }
    
});

$(".kgfm_calc").keyup(function(){
    var kgf_m = Number(($("[name=kgf_m]").val()).replace(",","."));
    var tensao_base = Number(($("[name=tensao_base]").val()).replace(",","."));
    var tensao_v = Number(($("[name=tensao_v]").val()).replace(",","."));

    if((kgf_m != '') && (tensao_base != '') && (tensao_v != '')){
        var total = kgf_m * ((tensao_base / tensao_v) ** 2);
        $("[name=kgf_m_calc]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=kgf_m_calc]").val('');
    }
});

$(".cmax_cn").keyup(function(){
    var kgf_m_calc = Number(($("[name=kgf_m_calc]").val()).replace(",","."));
    var kgf_m_carga_100 = Number(($("[name=kgf_m_carga_100]").val()).replace(",","."));

    if((kgf_m_calc != '') && (kgf_m_carga_100 != '')){
        var total = (kgf_m_calc / kgf_m_carga_100);
        $("[name=cmax_cn]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=cmax_cn]").val('');
    }
});
$(".kgfm_rend").keyup(function(){
    
    var kgf_m_carga_100 = Number(($("[name=kgf_m_carga_100]").val()).replace(",","."));    
    var kgf_m_carga_75  = Number(($("[name=kgf_m_carga_75]").val()).replace(",","."));
    var kgf_m_carga_50  = Number(($("[name=kgf_m_carga_50]").val()).replace(",","."));
    var rpm_carga_100   = Number(($("[name=rpm_carga_100]").val()).replace(",","."));
    var rpm_carga_75    = Number(($("[name=rpm_carga_75]").val()).replace(",","."));
    var rpm_carga_50    = Number(($("[name=rpm_carga_50]").val()).replace(",","."));
    var pw_carga_100    = Number(($("[name=pw_carga_100]").val()).replace(",","."));
    var pw_carga_75     = Number(($("[name=pw_carga_75]").val()).replace(",","."));
    var pw_carga_50     = Number(($("[name=pw_carga_50]").val()).replace(",","."));
    
    if($("[name=tipo_ensaio]").val() == 3){
        
        var kgf_m_carga_inf = Number(($("[name=kgf_m_carga_inf]").val()).replace(",","."));
        var rpm_carga_inf   = Number(($("[name=rpm_carga_inf]").val()).replace(",","."));
        var pw_carga_inf    = Number(($("[name=pw_carga_inf]").val()).replace(",","."));

        if((kgf_m_carga_inf != '') && (rpm_carga_inf != '') && (pw_carga_inf != '')){
            var rend_inf = ((((kgf_m_carga_inf * rpm_carga_inf) / 716) * 736) / pw_carga_inf) * 100;
            $("[name=rend_carga_inf]").val((rend_inf.toFixed(2)).replace(".",","));
        }else{
            $("[name=rend_carga_inf]").val('');
        }
    }

    if((kgf_m_carga_100 != '') && (rpm_carga_100 != '') && (pw_carga_100 != '')){
        var rend_100 = ((((kgf_m_carga_100 * rpm_carga_100) / 716) * 736) / pw_carga_100) * 100;
        $("[name=rend_carga_100]").val((rend_100.toFixed(2)).replace(".",","));
    }else{
        $("[name=rend_carga_100]").val('');
    }

    if((kgf_m_carga_75 != '') && (rpm_carga_75 != '') && (pw_carga_75 != '')){
        var rend_75 = ((((kgf_m_carga_75 * rpm_carga_75) / 716) * 736) / pw_carga_75) * 100;
        $("[name=rend_carga_75]").val((rend_75.toFixed(2)).replace(".",","));
    }else{
        $("[name=rend_carga_75]").val('');
    }
    
    if((kgf_m_carga_50 != '') && (rpm_carga_50 != '') && (pw_carga_50 != '')){
        var rend_50 = ((((kgf_m_carga_50 * rpm_carga_50) / 716) * 736) / pw_carga_50) * 100;
        $("[name=rend_carga_50]").val((rend_50.toFixed(2)).replace(".",","));
    }else{
        $("[name=rend_carga_50]").val('');
    }
});

$(".conjugado_kgf_calc").keyup(function(){
    var conjugados = {};
    var tensoes = {};

    // Conjugado calculado
    $.each( $( ".conjugado" ), function() {
        if((this.value) != ''){
            index = (this.name).charAt((this.name).length-1);
            conjugados[index] =  Number((this.value).replace(",","."));
        }
    }); 
    
    var arr = Object.keys(conjugados).map(function(key) {return conjugados[key]; });
    
    // Funcao para retornar o menor valor de um array
    Array.min = function(conjugados) {
        return Math.min.apply(Math, conjugados);
    };
    var menor_conj = (Array.min(arr));
    //var key_menor_conj = arr.indexOf(menor_conj);
    for (var data in conjugados) {
        if(conjugados[data] == menor_conj){
            var key_menor_conj = data;
            break;
        }
    }
    var tensoes = {
        1 : Number(($("[name=tensao_v_1]").val()).replace(",",".")), 
        2 : Number(($("[name=tensao_v_2]").val()).replace(",",".")), 
        3 : Number(($("[name=tensao_v_3]").val()).replace(",",".")),
        4 : Number(($("[name=tensao_v_4]").val()).replace(",","."))
    };
    
    var tensao_base = Number(($("[name=tensao_base]").val()).replace(",","."));
    var conjugado_kgf_calc = menor_conj * ((tensao_base / tensoes[key_menor_conj]) ** 2);

    // cp_cn
    var carga_100 = Number(($("[name=kgf_m_carga_100]").val()).replace(",","."));
    var cp_cn = (conjugado_kgf_calc / carga_100);

    // I (A) cálculado
    var i_a = Number(($("[name=i_a]").val()).replace(",","."));
    i_a_calc = ((i_a * tensao_base) / tensoes[key_menor_conj]);

    // Ip/In
    var i1_carga_100 = Number(($("[name=i1_carga_100]").val()).replace(",","."));
    var ip_in = ((i_a_calc) / i1_carga_100);

    conjugado_kgf_calc = (isNaN(conjugado_kgf_calc) && !isFinite(conjugado_kgf_calc)) ? "" : (conjugado_kgf_calc.toFixed(3)).replace(".",",");
    cp_cn              = (isNaN(cp_cn) || !isFinite(cp_cn)) ? "" : (cp_cn.toFixed(2)).replace(".",",");
    i_a_calc           = (isNaN(i_a_calc) || !isFinite(i_a_calc)) ? "" : (i_a_calc.toFixed(3)).replace(".",",");
    ip_in              = (isNaN(ip_in) || !isFinite(ip_in)) ? "" : (ip_in.toFixed(3)).replace(".",",");

    $("[name=conjugado_kgf_calc]").val(conjugado_kgf_calc);
    $("[name=cp_cn]").val(cp_cn);
    $("[name=i_a_calc]").val(i_a_calc);
    $("[name=ip_in]").val(ip_in);
    
});

$(".cos_inf").keyup(function(){
    var pw_carga_inf = Number(($("[name=pw_carga_inf]").val()).replace(",","."));
    var i1_carga_inf = Number(($("[name=i1_carga_inf]").val()).replace(",","."));
    var v1_carga_inf = Number(($("[name=v1_carga_inf]").val()).replace(",","."));
    if((pw_carga_inf != '') && (i1_carga_inf != '') && (v1_carga_inf != '')){
        var total = pw_carga_inf / (i1_carga_inf * v1_carga_inf);
        
        $("[name=cos_carga_inf]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=cos_carga_inf]").val('');
    }
});
$(".cos_100").keyup(function(){
    var pw_carga_100 = Number(($("[name=pw_carga_100]").val()).replace(",","."));
    var i1_carga_100 = Number(($("[name=i1_carga_100]").val()).replace(",","."));
    var v1_carga_100 = Number(($("[name=v1_carga_100]").val()).replace(",","."));

    if((pw_carga_100 != '') && (i1_carga_100 != '') && (v1_carga_100 != '')){
        var total = pw_carga_100 / (i1_carga_100 * v1_carga_100);
        
        $("[name=cos_carga_100]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=cos_carga_100]").val('');
    }
});
$(".cos_75").keyup(function(){
    var pw_carga_75 = Number(($("[name=pw_carga_75]").val()).replace(",","."));
    var i1_carga_75 = Number(($("[name=i1_carga_75]").val()).replace(",","."));
    var v1_carga_75 = Number(($("[name=v1_carga_75]").val()).replace(",","."));

    if((pw_carga_75 != '') && (i1_carga_75 != '') && (v1_carga_75 != '')){
        var total = pw_carga_75 / (i1_carga_75 * v1_carga_75);
        
        $("[name=cos_carga_75]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=cos_carga_75]").val('');
    }
});
$(".cos_50").keyup(function(){
    var pw_carga_50 = Number(($("[name=pw_carga_50]").val()).replace(",","."));
    var i1_carga_50 = Number(($("[name=i1_carga_50]").val()).replace(",","."));
    var v1_carga_50 = Number(($("[name=v1_carga_50]").val()).replace(",","."));

    if((pw_carga_50 != '') && (i1_carga_50 != '') && (v1_carga_50 != '')){
        var total = pw_carga_50 / (i1_carga_50 * v1_carga_50);
        
        $("[name=cos_carga_50]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=cos_carga_50]").val('');
    }
});

$(".cos_vazio").keyup(function(){
    var p_w_vazio = Number(($("[name=p_w_vazio]").val()).replace(",","."));
    var v1_vazio = Number(($("[name=v1_vazio]").val()).replace(",","."));
    var i_a_vazio = Number(($("[name=i_a_vazio]").val()).replace(",","."));

    if((p_w_vazio != '') && (v1_vazio != '') && (i_a_vazio != '')){
        var total = p_w_vazio / (v1_vazio * i_a_vazio);
        
        $("[name=cos_1_vazio]").val((total.toFixed(3)).replace(".",","));
    }else{
        $("[name=cos_1_vazio]").val('');
    }
});

$(function(){
    if(($("[name=tipo_ensaio]").val()) == 10){

        $(".kgfm_rend").keyup(function(){
            var kgf_m_carga_175 = Number(($("[name=kgf_m_carga_175]").val()).replace(",","."));    
            var rpm_carga_175   = Number(($("[name=rpm_carga_175]").val()).replace(",","."));
            var pw_carga_175    = Number(($("[name=pw_carga_175]").val()).replace(",","."));
        
            if((kgf_m_carga_175 != '') && (rpm_carga_175 != '') && (pw_carga_175 != '')){
                var rend_175 = ((((kgf_m_carga_175 * rpm_carga_175) / 716) * 736) / pw_carga_175) * 100;
                $("[name=rend_carga_175]").val((rend_175.toFixed(2)).replace(".",","));
            }else{
                $("[name=rend_carga_175]").val('');
            }

            var kgf_m_carga_150 = Number(($("[name=kgf_m_carga_150]").val()).replace(",","."));    
            var rpm_carga_150   = Number(($("[name=rpm_carga_150]").val()).replace(",","."));
            var pw_carga_150    = Number(($("[name=pw_carga_150]").val()).replace(",","."));
        
            if((kgf_m_carga_150 != '') && (rpm_carga_150 != '') && (pw_carga_150 != '')){
                var rend_150 = ((((kgf_m_carga_150 * rpm_carga_150) / 716) * 736) / pw_carga_150) * 100;
                $("[name=rend_carga_150]").val((rend_150.toFixed(2)).replace(".",","));
            }else{
                $("[name=rend_carga_150]").val('');
            }

            var kgf_m_carga_125 = Number(($("[name=kgf_m_carga_125]").val()).replace(",","."));    
            var rpm_carga_125   = Number(($("[name=rpm_carga_125]").val()).replace(",","."));
            var pw_carga_125    = Number(($("[name=pw_carga_125]").val()).replace(",","."));
        
            if((kgf_m_carga_125 != '') && (rpm_carga_125 != '') && (pw_carga_125 != '')){
                var rend_125 = ((((kgf_m_carga_125 * rpm_carga_125) / 716) * 736) / pw_carga_125) * 100;
                $("[name=rend_carga_125]").val((rend_125.toFixed(2)).replace(".",","));
            }else{
                $("[name=rend_carga_125]").val('');
            }

            var kgf_m_carga_25 = Number(($("[name=kgf_m_carga_25]").val()).replace(",","."));    
            var rpm_carga_25   = Number(($("[name=rpm_carga_25]").val()).replace(",","."));
            var pw_carga_25    = Number(($("[name=pw_carga_25]").val()).replace(",","."));
        
            if((kgf_m_carga_25 != '') && (rpm_carga_25 != '') && (pw_carga_25 != '')){
                var rend_25 = ((((kgf_m_carga_25 * rpm_carga_25) / 716) * 736) / pw_carga_25) * 100;
                $("[name=rend_carga_25]").val((rend_25.toFixed(2)).replace(".",","));
            }else{
                $("[name=rend_carga_25]").val('');
            }

        });

        $(".cos_175").keyup(function(){
            var pw_carga_175 = Number(($("[name=pw_carga_175]").val()).replace(",","."));
            var i1_carga_175 = Number(($("[name=i1_carga_175]").val()).replace(",","."));
            var v1_carga_175 = Number(($("[name=v1_carga_175]").val()).replace(",","."));
        
            if((pw_carga_175 != '') && (i1_carga_175 != '') && (v1_carga_175 != '')){
                var total = pw_carga_175 / (i1_carga_175 * v1_carga_175);
                console.log(total);
                $("[name=cos_carga_175]").val((total.toFixed(3)).replace(".",","));
            }else{
                $("[name=cos_carga_175]").val('');
            }
        });
        $(".cos_150").keyup(function(){
            var pw_carga_150 = Number(($("[name=pw_carga_150]").val()).replace(",","."));
            var i1_carga_150 = Number(($("[name=i1_carga_150]").val()).replace(",","."));
            var v1_carga_150 = Number(($("[name=v1_carga_150]").val()).replace(",","."));
        
            if((pw_carga_150 != '') && (i1_carga_150 != '') && (v1_carga_150 != '')){
                var total = pw_carga_150 / (i1_carga_150 * v1_carga_150);
                
                $("[name=cos_carga_150]").val((total.toFixed(3)).replace(".",","));
            }else{
                $("[name=cos_carga_150]").val('');
            }
        });
        $(".cos_125").keyup(function(){
            var pw_carga_125 = Number(($("[name=pw_carga_125]").val()).replace(",","."));
            var i1_carga_125 = Number(($("[name=i1_carga_125]").val()).replace(",","."));
            var v1_carga_125 = Number(($("[name=v1_carga_125]").val()).replace(",","."));
        
            if((pw_carga_125 != '') && (i1_carga_125 != '') && (v1_carga_125 != '')){
                var total = pw_carga_125 / (i1_carga_125 * v1_carga_125);
                
                $("[name=cos_carga_125]").val((total.toFixed(3)).replace(".",","));
            }else{
                $("[name=cos_carga_125]").val('');
            }
        });
        $(".cos_25").keyup(function(){
            var pw_carga_25 = Number(($("[name=pw_carga_25]").val()).replace(",","."));
            var i1_carga_25 = Number(($("[name=i1_carga_25]").val()).replace(",","."));
            var v1_carga_25 = Number(($("[name=v1_carga_25]").val()).replace(",","."));
        
            if((pw_carga_25 != '') && (i1_carga_25 != '') && (v1_carga_25 != '')){
                var total = pw_carga_25 / (i1_carga_25 * v1_carga_25);
                
                $("[name=cos_carga_25]").val((total.toFixed(3)).replace(".",","));
            }else{
                $("[name=cos_carga_25]").val('');
            }
        });

    }

})
