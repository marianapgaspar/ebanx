
$(".imax_a_calc").keyup(function(){
    var corrente_a = Number(($("#corrente_a").val()).replace(",","."));
    var tensao_base = Number(($("#tensao_base").val()).replace(",","."));
    var tensao_v = Number(($("#tensao_v").val()).replace(",","."));

    if((corrente_a != '') && (tensao_base != '') && (tensao_v != '')){
        var total = ((corrente_a * tensao_base) / tensao_v);
        $("#imax_a").val((total.toFixed(2)).replace(".",","));
    }else{
        $("#imax_a").val('');
    }
    
});
