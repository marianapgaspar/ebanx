const objEmitente = $('[name=selectEmitente]');
const objDataIni = $('[name=dtIni]');
const objDataFim = $('[name=dtFim]');


//getData Initial
getData();

//get dados do form
objEmitente.change(function() {
    getData();
});

objDataIni.change(function() {
    getData();
});

objDataFim.change(function() {
    getData();
});

var cDatashow = $('[data-show=yes]').length;

if (cDatashow > 0) {
    $('#modalSearch').modal({
        show: true
    });
}

/**
 * Buscar emitente
 * @author Felipe Corassari
 * @since 14/07
 */
function getEmitente() {
    return objEmitente.val();
}


/**
 * Exibir modal
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataModal(cod, nome_abrev) {

    objEmitente.append($('<option>', { value: cod, text: nome_abrev }))
        .val(cod)
        .trigger('change');

    $('#modalSearch').modal({
        show: true
    });
}

/**
 * Buscar Data Inicial
 * @author Felipe Corassari
 * @since 14/07
 */
function getDtIni() {
    return date2base(objDataIni.val());
}
/**
 * Buscar Data Final
 * @author Felipe Corassari
 * @since 14/07
 */
function getDtFim() {
    return date2base(objDataFim.val());
}

/**
 * Buscar informcoes
 * @author Felipe Corassari
 * @since 14/07
 */

function getData() {

    var $emitente = getEmitente();
    var $dtIni = getDtIni();
    var $dtFim = getDtFim();
    $('.init').css({ 'display': '' });
    $('.info').css({ 'display': 'none' });

    //getCadastro
    if ($emitente) {
        getDataCadastro($emitente, $dtIni, $dtFim);
        getDataCredito($emitente, $dtIni, $dtFim);
        getDataPedido($emitente, $dtIni, $dtFim);
        getDataNf($emitente, $dtIni, $dtFim);
        getDataFinanceiro($emitente, $dtIni, $dtFim);
        getDataContato($emitente, $dtIni, $dtFim);

        //exibir load
        $('.tab-content').css({ 'display': '' });
        setTimeout(function() {
            $('.init').css({ 'display': 'none' });
            $('.info').css({ 'display': '' });
        }, 1000);
    } else {
        $('.tab-content').css({ 'display': 'none' });
    }

}
/**
 * Get informacoes do cadastro
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataCadastro($_cod, $_dtIni, $_dtFim) {
    $.ajax({
        url: '/CRM/search/getDataCadastro?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {
            if ($data.length <= 0) {
                $('#msgCadastro').html('<p class="text-center pd-y-30">Nenhum dado Encontrado</p>');
                $('.table-search-cadastro').css({
                    'display': 'none'
                })
            } else {
                $('.table-search-cadastro').css({ 'display': '' });
                $('#msgCadastro').html('');
                $("#navCadastro span").each(function(index, el) {
                    var $field = $(el).attr('id');
                    var $id = $('#' + $field);

                    if ($field != undefined) {
                        if ($field.substring(0, 2) == 'dt') {
                            $eval = formataData(eval('$data.' + $field));
                        } else if ($field.substring(0, 2) == 'vl') {
                            $eval = formatValor(eval('$data.' + $field));
                        } else {
                            $eval = eval('$data.' + $field);
                        }

                        $($id).html($eval);
                    }
                });
            }
        },
        error: function($data) {
            //alert('error');
        }
    })
}

/**
 * Get informacoes do CREDTIO
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataCredito($_cod, $_dtIni, $_dtFim) {
    $.ajax({
        url: '/CRM/search/getDataCredito?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {

            $("#navCredito tr td").each(function(index, el) {
                var $field = $(el).attr('id');
                var $id = $('#' + $field);
                if ($field != undefined) {
                    $($id).html(eval('$data.' + $field));
                }
            });
        },
        error: function($data) {
            console.log('------------- [error getCredito] ------------');
            console.log($data);
        }
    })
}


/**
 * Get informacoes do PEDIDOS
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataPedido($_cod, $_dtIni, $_dtFim) {

    $.ajax({
        url: '/CRM/search/getDataPedido?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {
            // alert('/CRM/search/getDataPedido?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim)
            // console.log($data)
            if ($data.length <= 0) {
                $('#msgPedido').html('<p class="text-center pd-y-30">Nenhum dado Encontrado</p>');
                $('.table-search-pedido').css({
                    'display': 'none'
                })
            } else {
                $('.table-search-pedido').css({ 'display': '' });
                $('#msgPedido').html('');
                var $html = ''
                $.each($data, function(index, val) {
                    var $class = val.operacao == 'PEDIDO CANCELADO' ? 'text-danger tx-lg-medium' : '';
                    $html += '<tr class="' + $class + '">';
                    $html += '<td class="' + $class + '">' + val.cod_estabel + '</td>';
                    $html += '<td class="' + $class + '">' + val.nr_pedcli + '</td>';
                    $html += '<td class="' + $class + '">' + formataData(val.dt_implant) + '</td>';
                    $html += '<td class="' + $class + '">' + formataData(val.dt_entrega) + '</td>';
                    $html += '<td class="' + $class + '">' + val.it_codigo + '</td>';
                    $html += '<td class="' + $class + '"  style="text-align: left !important;">' + val.desc_item + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.qt_pedido) + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.qt_atendida) + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.vl_ped_real) + '</td>';
                    $html += '</tr>';
                });
                $('.table-search-pedido tbody').html($html);
            }

        },
        error: function($data) {
            console.log('------------- [error getPedido] ------------');
            console.log($data);
        }
    })

}
/**
 * Get informacoes do Notas Fiscais
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataNf($_cod, $_dtIni, $_dtFim) {
    $.ajax({
        url: '/CRM/search/getDataNf?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {

            if ($data.length <= 0) {
                $('#msgNf').html('<p class="text-center pd-y-30">Nenhum dado Encontrado</p>');
                $('.table-search-nf').css({
                    'display': 'none'
                })
            } else {
                $('.table-search-nf').css({ 'display': '' });
                $('#msgNf').html('');
                var $html = ''
                $.each($data, function(index, val) {
                    var $class = val.operacao.trim() == 'NOTA CANCELADA' || val.operacao.trim() == 'DEVOLUÇÃO MERCADORIA' ? 'text-danger tx-lg-medium' : '';
                    $html += '<tr class="' + $class + '">';
                    $html += '<td class="' + $class + '">' + val.cod_estabel + '</td>';
                    $html += '<td class="' + $class + '">' + val.serie + '</td>';
                    $html += '<td class="' + $class + '">' + val.nr_nota_fis + '</td>';
                    $html += '<td class="' + $class + '">' + formataData(val.dt_emis_nf) + '</td>';
                    $html += '<td class="' + $class + '">' + val.nr_pedcli + '</td>';
                    $html += '<td class="' + $class + '">' + val.it_codigo + '</td>';
                    $html += '<td class="' + $class + '" style="text-align: left !important;">' + val.desc_item + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.qt_pedido) + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.qt_atendida) + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.vl_ped_real) + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_sit_item + '</td>';
                    $html += '<td class="' + $class + '">' + val.nome_transp + '</td>';
                    $html += '</tr>';
                });
                $('.table-search-nf tbody').html($html);
            }

        },
        error: function($data) {
            console.log('------------- [error getNF] ------------');
            console.log($data);
        }
    })
}

/**
 * Get informacoes do Financeiro
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataFinanceiro($_cod, $_dtIni, $_dtFim) {
    $.ajax({
        url: '/CRM/search/getDataFinanceiro?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {
            if ($data.length <= 0) {
                $('#msgFinanceiro').html('<p class="text-center pd-y-30">Nenhum dado Encontrado</p>');
                $('.table-search-financeiro').css({
                    'display': 'none'
                })
            } else {
                $('.table-search-financeiro').css({ 'display': '' });
                $('#msgFinanceiro').html('');
                var $html = ''
                $.each($data, function(index, val) {

                    console.log(val);
                    var d = '0000-00-00';
                    var vencto = new Date(val.dat_vencto_tit_acr);
                    var $class = vencto.getTime() < Date.now() ? 'text-danger   tx-lg-medium' : '';


                    $html += '<tr class="' + $class + '">';
                    $html += '<td class="' + $class + '">' + val.cod_empresa + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_estab + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_espec_docto + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_tit_acr + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_parcela + '</td>';
                    $html += '<td class="' + $class + '">' + val.cod_ser_docto + '</td>';
                    $html += '<td class="' + $class + '">' + formataData(val.dat_vencto_tit_acr) + '</td>';
                    $html += '<td class="' + $class + '">' + formataValor(val.val_sdo_tit_acr) + '</td>';
                    $html += '</tr>';

                });
                $('.table-search-financeiro tbody').html($html);
            }

        },
        error: function($data) {
            console.log('------------- [error getNF] ------------');
            console.log($data);
        }
    })
}

/**
 * Get informacoes da Agenda
 * @author Felipe Corassari
 * @since 14/07
 */
function getDataContato($_cod, $_dtIni, $_dtFim) {
    $.ajax({
        url: '/CRM/search/getDataContato?cod_emitente=' + $_cod + '&dtIni=' + $_dtIni + '&dtFim=' + $_dtFim,
        method: 'GET',
        dataType: 'json',
        success: function($data) {

            if ($data.length <= 0) {
                $('#msgContato').html('<p class="text-center pd-y-30">Nenhum dado Encontrado</p>');
                $('.table-search-contato').css({
                    'display': 'none'
                })
            } else {
                $('.table-search-contato').css({ 'display': '' });
                $('#msgContato').html('');
                var $html = ''
                $.each($data, function(index, val) {
                    data = val.dt_inicio;
                    $html += '<tr>';
                    $html += '<td>' + val.assunto + '</td>';
                    $html += '<td>' + formataData(data.substr(0,10)) + '</td>';
                    $html += '<td>' + val.nome_cont_cliente + '</td>';
                    $html += '<td>' + val.nome_resp + '</td>';
                    $html += '<td>' + val.id_class_contato + '</td>';
                    $html += '<td>' + val.ind_contato + '</td>';
                    $html += '</tr>';

                });
                $('.table-search-contato tbody').html($html);
            }

        },
        error: function($data) {
            console.log('------------- [error getContato] ------------');
            console.log($data);
        }
    })
}

/**
 * Funcoes comuns para o programa
 * @param  data 
 * @returns 
 */
function formataData(data) {
    var dia = data.split("-")[2];
    var mes = data.split("-")[1];
    var ano = data.split("-")[0];

    return ("0" + dia).slice(-2) + '/' + ("0" + mes).slice(-2) + '/' + ano;
}

function date2base(data) {
    var dia = data.split("/")[0];
    var mes = data.split("/")[1];
    var ano = data.split("/")[2];

    return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
}

function formataValor(v) {
    var vConvertido = parseFloat(v)
        .toLocaleString("pt-BR", { style: 'decimal', currency: "BRL" });
    return vConvertido;
}