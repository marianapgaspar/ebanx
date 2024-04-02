$('[name=v1_carga_inf], [name=v2_carga_inf], [name=v3_carga_inf]').change(function(){
    var v1_carga_inf = Number(($("[name=v1_carga_inf]").val()).replace(",","."));
    var v2_carga_inf = Number(($("[name=v2_carga_inf]").val()).replace(",","."));
    var v3_carga_inf = Number(($("[name=v3_carga_inf]").val()).replace(",","."));

    if((v1_carga_inf != '') && (v2_carga_inf != '') && (v3_carga_inf != '')){
        var total = (v1_carga_inf + v2_carga_inf + v3_carga_inf) / 3;
        $("[name=vl_carga_inf]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_carga_inf]").val('');
    }
});
$('[name=v1_carga_100], [name=v2_carga_100], [name=v3_carga_100]').change(function(){
    var v1_carga_100 = Number(($("[name=v1_carga_100]").val()).replace(",","."));
    var v2_carga_100 = Number(($("[name=v2_carga_100]").val()).replace(",","."));
    var v3_carga_100 = Number(($("[name=v3_carga_100]").val()).replace(",","."));

    if((v1_carga_100 != '') && (v2_carga_100 != '') && (v3_carga_100 != '')){
        var total = (v1_carga_100 + v2_carga_100 + v3_carga_100) / 3;
        $("[name=vl_carga_100]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_carga_100]").val('');
    }
});

$('[name=v1_carga_75], [name=v2_carga_75], [name=v3_carga_75]').change(function(){
    var v1_carga_75 = Number(($("[name=v1_carga_75]").val()).replace(",","."));
    var v2_carga_75 = Number(($("[name=v2_carga_75]").val()).replace(",","."));
    var v3_carga_75 = Number(($("[name=v3_carga_75]").val()).replace(",","."));

    if((v1_carga_75 != '') && (v2_carga_75 != '') && (v3_carga_75 != '')){
        var total = (v1_carga_75 + v2_carga_75 + v3_carga_75) / 3;
        $("[name=vl_carga_75]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_carga_75]").val('');
    }
});

$('[name=v1_carga_50], [name=v2_carga_50], [name=v3_carga_50]').change(function(){
    var v1_carga_50 = Number(($("[name=v1_carga_50]").val()).replace(",","."));
    var v2_carga_50 = Number(($("[name=v2_carga_50]").val()).replace(",","."));
    var v3_carga_50 = Number(($("[name=v3_carga_50]").val()).replace(",","."));

    if((v1_carga_50 != '') && (v2_carga_50 != '') && (v3_carga_50 != '')){
        var total = (v1_carga_50 + v2_carga_50 + v3_carga_50) / 3;
        $("[name=vl_carga_50]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_carga_50]").val('');
    }
});

$('[name=i1_carga_inf], [name=i2_carga_inf], [name=i3_carga_inf]').change(function(){
    var i1_carga_inf = Number(($("[name=i1_carga_inf]").val()).replace(",","."));
    var i2_carga_inf = Number(($("[name=i2_carga_inf]").val()).replace(",","."));
    var i3_carga_inf = Number(($("[name=i3_carga_inf]").val()).replace(",","."));

    if((i1_carga_inf != '') && (i2_carga_inf != '') && (i3_carga_inf != '')){
        var total = (i1_carga_inf + i2_carga_inf + i3_carga_inf) / 3;
        $("[name=il_carga_inf]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=il_carga_inf]").val('');
    }
});
$('[name=i1_carga_100], [name=i2_carga_100], [name=i3_carga_100]').change(function(){
    var i1_carga_100 = Number(($("[name=i1_carga_100]").val()).replace(",","."));
    var i2_carga_100 = Number(($("[name=i2_carga_100]").val()).replace(",","."));
    var i3_carga_100 = Number(($("[name=i3_carga_100]").val()).replace(",","."));

    if((i1_carga_100 != '') && (i2_carga_100 != '') && (i3_carga_100 != '')){
        var total = (i1_carga_100 + i2_carga_100 + i3_carga_100) / 3;
        $("[name=il_carga_100]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=il_carga_100]").val('');
    }
});
$('[name=i1_carga_75], [name=i2_carga_75], [name=i3_carga_75]').change(function(){
    var i1_carga_75 = Number(($("[name=i1_carga_75]").val()).replace(",","."));  
    var i2_carga_75 = Number(($("[name=i2_carga_75]").val()).replace(",","."));
    var i3_carga_75 = Number(($("[name=i3_carga_75]").val()).replace(",","."));

    if((i1_carga_75 != '') && (i2_carga_75 != '') && (i3_carga_75 != '')){
        var total = (i1_carga_75 + i2_carga_75 + i3_carga_75) / 3;
        $("[name=il_carga_75]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=il_carga_75]").val('');
    }
});
$('[name=i1_carga_50], [name=i2_carga_50], [name=i3_carga_50]').change(function(){
    var i1_carga_50 = Number(($("[name=i1_carga_50]").val()).replace(",","."));
    var i2_carga_50 = Number(($("[name=i2_carga_50]").val()).replace(",","."));
    var i3_carga_50 = Number(($("[name=i3_carga_50]").val()).replace(",","."));

    if((i1_carga_50 != '') && (i2_carga_50 != '') && (i3_carga_50 != '')){
        var total = (i1_carga_50 + i2_carga_50 + i3_carga_50) / 3;
        $("[name=il_carga_50]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_carga_50]").val('');
    }
});

$('[name=v1_vazio], [name=v2_vazio], [name=v3_vazio]').change(function(){
    var v1_vazio = Number(($("[name=v1_vazio]").val()).replace(",",".")); 
    var v2_vazio = Number(($("[name=v2_vazio]").val()).replace(",","."));
    var v3_vazio = Number(($("[name=v3_vazio]").val()).replace(",","."));

    if((v1_vazio != '') && (v2_vazio != '') && (v3_vazio != '')){
        var total = (v1_vazio + v2_vazio + v3_vazio) / 3;
        $("[name=vl_vazio]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_vazio]").val('');
    }
});
$('[name=i1_vazio], [name=i2_vazio], [name=i3_vazio]').change(function(){
    var i1_vazio = Number(($("[name=i1_vazio]").val()).replace(",",".")); 
    var i2_vazio = Number(($("[name=i2_vazio]").val()).replace(",","."));
    var i3_vazio = Number(($("[name=i3_vazio]").val()).replace(",","."));

    if((i1_vazio != '') && (i2_vazio != '') && (i3_vazio != '')){
        var total = (i1_vazio + i2_vazio + i3_vazio) / 3;
        $("[name=il_vazio]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=il_vazio]").val('');
    }
});
$('[name=p_w_vazio], [name=vl_vazio], [name=il_vazio]').change(function(){
    var p_w_vazio = Number(($("[name=p_w_vazio]").val()).replace(",","."));
    var vl_vazio = Number(($("[name=vl_vazio]").val()).replace(",","."));
    var il_vazio = Number(($("[name=il_vazio]").val()).replace(",","."));

    if((p_w_vazio != '') && (vl_vazio != '') && (il_vazio != '')){
        var total = p_w_vazio / (vl_vazio * il_vazio * 1.732051);
        
        $("[name=cos_1_vazio]").val((total.toFixed(3)));
    }else{
        $("[name=cos_1_vazio]").val('');
    }
});

$('[name=corrente_a], [name=tensao_base], [name=tensao_v]').change(function(){
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
$('[name=kgf_m], [name=tensao_base], [name=tensao_v]').change(function(){
    var kgf_m = Number(($("[name=kgf_m]").val()).replace(",","."));
    var tensao_base = Number(($("[name=tensao_base]").val()).replace(",","."));
    var tensao_v = Number(($("[name=tensao_v]").val()).replace(",","."));

    if((kgf_m != '') && (tensao_base != '') && (tensao_v != '')){
        var total = kgf_m * ((tensao_base / tensao_v) ** 2);
        $("[name=kgf_m_calc]").val((total.toFixed(3)));
    }else{
        $("[name=kgf_m_calc]").val('');
    }
});

$(".cmax_cn").keyup(function(){
    var kgf_m_calc = Number(($("[name=kgf_m_calc]").val()).replace(",","."));
    var kgf_m_carga_100 = Number(($("[name=kgf_m_carga_100]").val()).replace(",","."));
    console.log(kgf_m_calc,kgf_m_carga_100);
    if((kgf_m_calc != '') && (kgf_m_carga_100 != '')){
        var total = (kgf_m_calc / kgf_m_carga_100);
        $("[name=cmax_cn]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=cmax_cn]").val('');
    }
});
$('[name=kgf_m_carga_100], [name=kgf_m_carga_75], [name=kgf_m_carga_50], [name=rpm_carga_100], [name=rpm_carga_75], [name=rpm_carga_50], [name=pw_carga_100], [name=pw_carga_75], [name=pw_carga_50], [name=kgf_m_carga_inf], [name=rpm_carga_inf], [name=pw_carga_inf]').change(function(){
    var kgf_m_carga_100 = Number(($("[name=kgf_m_carga_100]").val()).replace(",","."));    
    var kgf_m_carga_75  = Number(($("[name=kgf_m_carga_75]").val()).replace(",","."));
    var kgf_m_carga_50  = Number(($("[name=kgf_m_carga_50]").val()).replace(",","."));
    var rpm_carga_100   = Number(($("[name=rpm_carga_100]").val()).replace(",","."));
    var rpm_carga_75    = Number(($("[name=rpm_carga_75]").val()).replace(",","."));
    var rpm_carga_50    = Number(($("[name=rpm_carga_50]").val()).replace(",","."));
    var pw_carga_100    = Number(($("[name=pw_carga_100]").val()).replace(",","."));
    var pw_carga_75     = Number(($("[name=pw_carga_75]").val()).replace(",","."));
    var pw_carga_50     = Number(($("[name=pw_carga_50]").val()).replace(",","."));
    
    if($("[name=tipo_ensaio]").val() == 1){
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
$('[name=tensao_v_1], [name=tensao_v_2], .conjugado, [name=tensao_v_3], [name=tensao_v_4], [name=tensao_base], [name=kgf_m_carga_100], [name=il_carga_100]').change(function(){
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
    var il_carga_100 = Number(($("[name=il_carga_100]").val()).replace(",","."));
    var ip_in = ((i_a_calc) / il_carga_100);

    conjugado_kgf_calc = (isNaN(conjugado_kgf_calc) && !isFinite(conjugado_kgf_calc)) ? "" : (conjugado_kgf_calc.toFixed(3)).replace(".",",");
    cp_cn              = (isNaN(cp_cn) || !isFinite(cp_cn)) ? "" : (cp_cn.toFixed(2)).replace(".",",");
    i_a_calc           = (isNaN(i_a_calc) || !isFinite(i_a_calc)) ? "" : (i_a_calc.toFixed(3)).replace(".",",");
    ip_in              = (isNaN(ip_in) || !isFinite(ip_in)) ? "" : (ip_in.toFixed(3)).replace(".",",");

    $("[name=conjugado_kgf_calc]").val(conjugado_kgf_calc);
    $("[name=cp_cn]").val(cp_cn);
    $("[name=i_a_calc]").val(i_a_calc);
    $("[name=ip_in]").val(ip_in);
    
});

$(function(){
    if(($("[name=tipo_ensaio]").val()) == 9){
        $('[name=kgf_m_carga_175], [name=rpm_carga_175], [name=pw_carga_175], [name=kgf_m_carga_150], [name=rpm_carga_150], [name=pw_carga_150], [name=kgf_m_carga_125], [name=rpm_carga_125], [name=rpm_carga_125], [name=pw_carga_125], [name=kgf_m_carga_25], [name=rpm_carga_25], [name=pw_carga_25]').change(function(){
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
        $('[name=v1_carga_175], [name=v2_carga_175], [name=v3_carga_175], [name=v1_carga_150], [name=v2_carga_150], [name=v3_carga_150]').change(function(){
            var v1_carga_175 = Number(($("[name=v1_carga_175]").val()).replace(",","."));
            var v2_carga_175 = Number(($("[name=v2_carga_175]").val()).replace(",","."));
            var v3_carga_175 = Number(($("[name=v3_carga_175]").val()).replace(",","."));
        
            if((v1_carga_175 != '') && (v2_carga_175 != '') && (v3_carga_175 != '')){
                var total = (v1_carga_175 + v2_carga_175 + v3_carga_175) / 3;
                $("[name=vl_carga_175").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=vl_carga_175").val('');
            }
        });

        $('[name=v1_carga_150], [name=v2_carga_150], [name=v3_carga_150]').change(function(){
            var v1_carga_150 = Number(($("[name=v1_carga_150]").val()).replace(",","."));
            var v2_carga_150 = Number(($("[name=v2_carga_150]").val()).replace(",","."));
            var v3_carga_150 = Number(($("[name=v3_carga_150]").val()).replace(",","."));
        
            if((v1_carga_150 != '') && (v2_carga_150 != '') && (v3_carga_150 != '')){
                var total = (v1_carga_150 + v2_carga_150 + v3_carga_150) / 3;
                $("[name=vl_carga_150").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=vl_carga_150").val('');
            }
        });

        $('[name=v1_carga_125], [name=v2_carga_125], [name=v3_carga_125]').change(function(){
            var v1_carga_125 = Number(($("[name=v1_carga_125]").val()).replace(",","."));
            var v2_carga_125 = Number(($("[name=v2_carga_125]").val()).replace(",","."));
            var v3_carga_125 = Number(($("[name=v3_carga_125]").val()).replace(",","."));
        
            if((v1_carga_125 != '') && (v2_carga_125 != '') && (v3_carga_125 != '')){
                var total = (v1_carga_125 + v2_carga_125 + v3_carga_125) / 3;
                $("[name=vl_carga_125]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=vl_carga_125]").val('');
            }
        });

        $('[name=v1_carga_25], [name=v2_carga_25], [name=v3_carga_25]').change(function(){
            var v1_carga_25 = Number(($("[name=v1_carga_25]").val()).replace(",","."));
            var v2_carga_25 = Number(($("[name=v2_carga_25]").val()).replace(",","."));
            var v3_carga_25 = Number(($("[name=v3_carga_25]").val()).replace(",","."));
        
            if((v1_carga_25 != '') && (v2_carga_25 != '') && (v3_carga_25 != '')){
                var total = (v1_carga_25 + v2_carga_25 + v3_carga_25) / 3;
                $("[name=vl_carga_25]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=vl_carga_25]").val('');
            }
        });

        $('[name=i1_carga_175], [name=i2_carga_175], [name=i3_carga_175]').change(function(){
            var i1_carga_175 = Number(($("[name=i1_carga_175]").val()).replace(",","."));
            var i2_carga_175 = Number(($("[name=i2_carga_175]").val()).replace(",","."));
            var i3_carga_175 = Number(($("[name=i3_carga_175]").val()).replace(",","."));
        
            if((i1_carga_175 != '') && (i2_carga_175 != '') && (i3_carga_175 != '')){
                var total = (i1_carga_175 + i2_carga_175 + i3_carga_175) / 3;
                $("[name=il_carga_175]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=il_carga_175]").val('');
            }
        });

        $('[name=i1_carga_150], [name=i2_carga_150], [name=i3_carga_150]').change(function(){
            var i1_carga_150 = Number(($("[name=i1_carga_150]").val()).replace(",","."));
            var i2_carga_150 = Number(($("[name=i2_carga_150]").val()).replace(",","."));
            var i3_carga_150 = Number(($("[name=i3_carga_150]").val()).replace(",","."));
        
            if((i1_carga_150 != '') && (i2_carga_150 != '') && (i3_carga_150 != '')){
                var total = (i1_carga_150 + i2_carga_150 + i3_carga_150) / 3;
                $("[name=il_carga_150]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=il_carga_150]").val('');
            }
        });

        $('[name=i1_carga_125], [name=i2_carga_125], [name=i3_carga_125]').change(function(){
            var i1_carga_125 = Number(($("[name=i1_carga_125]").val()).replace(",","."));
            var i2_carga_125 = Number(($("[name=i2_carga_125]").val()).replace(",","."));
            var i3_carga_125 = Number(($("[name=i3_carga_125]").val()).replace(",","."));
        
            if((i1_carga_125 != '') && (i2_carga_125 != '') && (i3_carga_125 != '')){
                var total = (i1_carga_125 + i2_carga_125 + i3_carga_125) / 3;
                $("[name=il_carga_125]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=il_carga_125]").val('');
            }
        });

        $('[name=i1_carga_25], [name=i2_carga_25], [name=i3_carga_25]').change(function(){
            var i1_carga_25 = Number(($("[name=i1_carga_25]").val()).replace(",","."));
            var i2_carga_25 = Number(($("[name=i2_carga_25]").val()).replace(",","."));
            var i3_carga_25 = Number(($("[name=i3_carga_25]").val()).replace(",","."));
        
            if((i1_carga_25 != '') && (i2_carga_25 != '') && (i3_carga_25 != '')){
                var total = (i1_carga_25 + i2_carga_25 + i3_carga_25) / 3;
                $("[name=il_carga_25]").val((total.toFixed(2)).replace(".",","));
            }else{
                $("[name=il_carga_25]").val('');
            }
        });

        $('[name=pw_carga_175], [name=il_carga_175], [name=vl_carga_175]').change(function(){
            var pw_carga_175 = Number(($("[name=pw_carga_175]").val()).replace(",","."));
            var il_carga_175 = Number(($("[name=il_carga_175]").val()).replace(",","."));
            var vl_carga_175 = Number(($("[name=vl_carga_175]").val()).replace(",","."));
        
            if((pw_carga_175 != '') && (il_carga_175 != '') && (vl_carga_175 != '')){
                var total = pw_carga_175 / (il_carga_175 * vl_carga_175 * 1.732051);
                $("[name=cos_carga_175]").val((total.toFixed(3)));
            }else{
                $("[name=cos_carga_175]").val('');
            }
        });

        $('[name=pw_carga_150], [name=il_carga_150], [name=vl_carga_150]').change(function(){
            var pw_carga_150 = Number(($("[name=pw_carga_150]").val()).replace(",","."));
            var il_carga_150 = Number(($("[name=il_carga_150]").val()).replace(",","."));
            var vl_carga_150 = Number(($("[name=vl_carga_150]").val()).replace(",","."));
        
            if((pw_carga_150 != '') && (il_carga_150 != '') && (vl_carga_150 != '')){
                var total = pw_carga_150 / (il_carga_150 * vl_carga_150 * 1.732051);
                
                $("[name=cos_carga_150]").val((total.toFixed(3)));
            }else{
                $("[name=cos_carga_150]").val('');
            }
        });

        $('[name=pw_carga_125], [name=il_carga_125], [name=vl_carga_125]').change(function(){
            var pw_carga_125 = Number(($("[name=pw_carga_125]").val()).replace(",","."));
            var il_carga_125 = Number(($("[name=il_carga_125]").val()).replace(",","."));
            var vl_carga_125 = Number(($("[name=vl_carga_125]").val()).replace(",","."));
        
            if((pw_carga_125 != '') && (il_carga_125 != '') && (vl_carga_125 != '')){
                var total = pw_carga_125 / (il_carga_125 * vl_carga_125 * 1.732051);
                
                $("[name=cos_carga_125]").val((total.toFixed(3)));
            }else{
                $("[name=cos_carga_125]").val('');
            }
        });

        $('[name=pw_carga_25], [name=il_carga_25], [name=vl_carga_25]').change(function(){
            var pw_carga_25 = Number(($("[name=pw_carga_25]").val()).replace(",","."));
            var il_carga_25 = Number(($("[name=il_carga_25]").val()).replace(",","."));
            var vl_carga_25 = Number(($("[name=vl_carga_25]").val()).replace(",","."));
        
            if((pw_carga_25 != '') && (il_carga_25 != '') && (vl_carga_25 != '')){
                var total = pw_carga_25 / (il_carga_25 * vl_carga_25 * 1.732051);
                
                $("[name=cos_carga_25]").val((total.toFixed(3)));
            }else{
                $("[name=cos_carga_25]").val('');
            }
        });
    }

    $('[name=pw_carga_inf], [name=il_carga_inf], [name=vl_carga_inf]').change(function(){
        var pw_carga_inf = Number(($("[name=pw_carga_inf]").val()).replace(",","."));
        var il_carga_inf = Number(($("[name=il_carga_inf]").val()).replace(",","."));
        var vl_carga_inf = Number(($("[name=vl_carga_inf]").val()).replace(",","."));
    
        if((pw_carga_inf != '') && (il_carga_inf != '') && (vl_carga_inf != '')){
            var total = pw_carga_inf / (il_carga_inf * vl_carga_inf * 1.732051);
            
            $("[name=cos_carga_inf]").val((total.toFixed(3)));
        }else{
            $("[name=cos_carga_inf]").val('');
        }
    });

    $('[name=pw_carga_100], [name=il_carga_100], [name=vl_carga_100]').change(function(){
        var pw_carga_100 = Number(($("[name=pw_carga_100]").val()).replace(",","."));
        var il_carga_100 = Number(($("[name=il_carga_100]").val()).replace(",","."));
        var vl_carga_100 = Number(($("[name=vl_carga_100]").val()).replace(",","."));
    
        if((pw_carga_100 != '') && (il_carga_100 != '') && (vl_carga_100 != '')){
            var total = pw_carga_100 / (il_carga_100 * vl_carga_100 * 1.732051);
            $("[name=cos_carga_100]").val((total.toFixed(3)));
        }else{
            $("[name=cos_carga_100]").val('');
        }
    });

    $('[name=pw_carga_75], [name=il_carga_75], [name=vl_carga_75]').change(function(){
        var pw_carga_75 = Number(($("[name=pw_carga_75]").val()).replace(",","."));
        var il_carga_75 = Number(($("[name=il_carga_75]").val()).replace(",","."));
        var vl_carga_75 = Number(($("[name=vl_carga_75]").val()).replace(",","."));
    
        if((pw_carga_75 != '') && (il_carga_75 != '') && (vl_carga_75 != '')){
            var total = pw_carga_75 / (il_carga_75 * vl_carga_75 * 1.732051);
            
            $("[name=cos_carga_75]").val((total.toFixed(3)));
        }else{
            $("[name=cos_carga_75]").val('');
        }
    });

    $('[name=pw_carga_50], [name=il_carga_50], [name=vl_carga_50]').change(function(){
        var pw_carga_50 = Number(($("[name=pw_carga_50]").val()).replace(",","."));
        var il_carga_50 = Number(($("[name=il_carga_50]").val()).replace(",","."));
        var vl_carga_50 = Number(($("[name=vl_carga_50]").val()).replace(",","."));
    
        if((pw_carga_50 != '') && (il_carga_50 != '') && (vl_carga_50 != '')){
            var total = pw_carga_50 / (il_carga_50 * vl_carga_50 * 1.732051);
            
            $("[name=cos_carga_50]").val((total.toFixed(3)));
        }else{
            $("[name=cos_carga_50]").val('');
        }
    });
})
