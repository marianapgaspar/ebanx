$(".v_vazio").keyup(function(){ 
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( ".v_vazio" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 6){
        var total = total / 6;
        $("[name=vl_vazio]").val((total.toFixed(2)).replace(".",","));
    }else{
        $("[name=vl_vazio]").val('');
    }
});

$(".i_vazio").keyup(function(){
    var total = 0;
    var valor = "";
    var count = 0;
    $.each( $( ".i_vazio" ), function() {
        if((this.value) != ''){
            valor =  Number((this.value).replace(",","."));
            count += 1;
        }else{
            valor = 0;
        }
        total += valor;
    }); 

    if(count == 6){
        var total = total / 6;
        $("[name=il_vazio]").val((total.toFixed(2)).replace(",","."));
    }else{
        $("[name=il_vazio]").val('');
    }
});

$(".correlacao_vazio").keyup(function(){
    var inputs = [];
    var var_calc = [];
    var token = $("[name=token]").val();
    var prossiga_vazio = 1;
    
    $.each( $( ".correlacao_vazio" ), function() {
        if(this.value == ''){
            prossiga_vazio = 0;
        }
       inputs[this.name] = Number((this.value).replace(",","."));
    }); 

    if(prossiga_vazio == 1){
        var potencia_w_vazio = {
            "125"          : inputs['v1_vazio'] * inputs['i1_vazio'] * inputs['cos_1_vazio'] * 1.732051,
            "100"          : inputs['v2_vazio'] * inputs['i2_vazio'] * inputs['cos_2_vazio'] * 1.732051,
            "80"           : inputs['v3_vazio'] * inputs['i3_vazio'] * inputs['cos_3_vazio'] * 1.732051,
            "60"           : inputs['v4_vazio'] * inputs['i4_vazio'] * inputs['cos_4_vazio'] * 1.732051,
            "40"           : inputs['v5_vazio'] * inputs['i5_vazio'] * inputs['cos_5_vazio'] * 1.732051,
            "20"           : inputs['v6_vazio'] * inputs['i6_vazio'] * inputs['cos_6_vazio'] * 1.732051
        }; 

        var pjoule_w = {
            "125"          : 1.5*(inputs['i1_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2),
            "100"          : 1.5*(inputs['i2_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2),
            "80"           : 1.5*(inputs['i3_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2),
            "60"           : 1.5*(inputs['i4_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2),
            "40"           : 1.5*(inputs['i5_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2),
            "20"           : 1.5*(inputs['i6_vazio'] ** 2) * ((inputs['r1_ini_vazio']+inputs['r1_fim_vazio'])/2)
        }; 

        var pabsolvida_sub_pjoule = {
            "125"          : potencia_w_vazio['125'] - pjoule_w['125'],
            "100"          : potencia_w_vazio['100'] - pjoule_w['100'],
            "80"           : potencia_w_vazio['80'] - pjoule_w['80'],
            "60"           : potencia_w_vazio['60'] - pjoule_w['60'],
            "40"           : potencia_w_vazio['40'] - pjoule_w['40'],
            "20"           : potencia_w_vazio['20'] - pjoule_w['20']
        }; 

        var v_elevado = {
            "125"          : inputs['v1_vazio'] ** 2,
            "100"          : inputs['v2_vazio'] ** 2,
            "80"           : inputs['v3_vazio'] ** 2,
            "60"           : inputs['v4_vazio'] ** 2,
            "40"           : inputs['v5_vazio'] ** 2,
            "20"           : inputs['v6_vazio'] ** 2
        }; 

        var y = (inputs['i6_vazio'] < inputs['i5_vazio']) ? [pabsolvida_sub_pjoule['80'], pabsolvida_sub_pjoule['60'], pabsolvida_sub_pjoule['40'], pabsolvida_sub_pjoule['20']]
                                                        : [pabsolvida_sub_pjoule['100'], pabsolvida_sub_pjoule['80'], pabsolvida_sub_pjoule['60'], pabsolvida_sub_pjoule['40']] ;

        var x = (inputs['i6_vazio'] < inputs['i5_vazio']) ? [v_elevado['80'], v_elevado['60'], v_elevado['40'], v_elevado['20']]
                                                        : [v_elevado['100'], v_elevado['80'], v_elevado['60'], v_elevado['40']] ;

        $("[name=correl_vazio]").val("calculando...");
        $.ajax({
            type: "POST",
            url: "regressaoLinear",
            data: { y: y, x: x, token: token },
            dataType: "json",
            success: function(data){
                $("[name=correl_vazio]").val((data.toFixed(2)));
                if(data < 0.90){
                    $("[name=correl_vazio]").css("color", "red");
                }else{
                    $("[name=correl_vazio]").css("color", "black");
                }
            }
        });
    }else{
        $("[name=correl_vazio]").val('');
    }

});

$(".correlacao_carga, .correlacao_carga1").keyup(function(){
    var inputs = {};
    var var_calc = [];
    var token = $("[name=token]").val();
    var prossiga_carga = 1;

    $.each( $( ".correlacao_carga" ), function() {
        if(this.value == ''){
            prossiga_carga = 0;
        }
    }); 
    
    if(prossiga_carga == 1){
        $.each( $( ".form-control" ), function() {
           inputs[this.name] =  Number((this.value).replace(",","."));
        }); 
        
        $("[name=correl_carga]").val("calculando...");
        $.ajax({
            type: "POST",
            url: "regressaoLinearCarga",
            data: { campos: inputs, token: token },
            dataType: "json",
            success: function(data){
                $("[name=correl_carga]").val((data.toFixed(2)));
                if(data < 0.90){
                    $("[name=correl_carga]").css("color", "red");
                }else{
                    $("[name=correl_carga]").css("color", "black");
                }
            }
        });
    }else{
        $("[name=correl_carga]").val('');
    }
    
});

$(function() {
    var correl_vazio = Number(($("[name=correl_vazio]").val()).replace(",","."));
    var correl_carga =  Number(($("[name=correl_carga]").val()).replace(",","."));

    if(correl_vazio < 0.90)
        $("[name=correl_vazio]").css("color", "red");
    
    if(correl_carga < 0.90)
        $("[name=correl_carga]").css("color", "red");
  });