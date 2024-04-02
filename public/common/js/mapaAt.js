const url = new URL(window.location.href);
const pathname = url.hostname;

$(document).ready(function() {
    rolaMapa(0);
});

function rolaMapa(params) {
    // Esta funcão serve para quando o dispositivo for mobile, ao clicar chamar o mapa a o browser rola até o mapa.
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad|android)/);

    if (agentID) {
        ("#tabela_busca").css("height", "70px");
        $("#area_pesquisa_personalizada").css("height", "50px");
        $("#tabela").css("overflow", "hidden");
        $("#mapa").css("height", "680px");

        if (params == 1) {
            $('html, body').animate({
                scrollTop: $('#mapa').offset().top
            }, 1000);
        }
    }
}

$(document).keypress(function(e) {
    // Identificamos quando a tecla Enter é pressionada
    if (e.wich == 13 || e.keyCode == 13) {
        $("#busca").trigger("click");
        busca();
    }
})

function busca(){
    $("#busca").click(function() {  
        $("#tabela_at").addClass("load");
        var tipo_pesquisa = $("input[name='tipo_pesquisa']:checked").val();
        
    // Fazemos a requisição
        $.ajax({
        type: "POST",
        url:"/Assistencia/mapaat/buscaAts",
        data: {
            pesquisa: $("#pesquisa").val(),
            tipo_pesquisa: tipo_pesquisa,
            token: $("#token").val()
        },
        dataType: "json",
        success: function(json) {
            $("#tabela_at").html(json[0]);
            $("#tabela_at").removeClass("load");

            callMap($("#pesquisa").val(), json[1]);
            $("#selected").val("");

            $.ajax({
                type: "GET",
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=Pato+Branco,PR&key=AIzaSyBPJbRpiqO4LAPuPV-UOzbHAYKKf-HQSCg",
                dataType: "json",
                success: function(json) {
                }
            });

            $(".destaca").click(function() {
                $("#selected").val(this.id);
                callMap(this.id, json[1]);
            });
        }
    });
});
}

function callMap(id, lista) {
    $.ajax({
        type: "POST",
        url: "/Assistencia/mapaat/mapa",
        data: {
            id: id,
            id_ats: lista,
            token: $("#token").val()
        },
        dataType: "json",
        success: function(json) {
            initialize(json);
        }
    });
}

// Google Maps
var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];
var localizacao = [];
var markerPonto;
var contador = 0;
var l = 0;
var contentString;

/*Método que inicia configurações iniciados do mapa*/
function initialize(params) {
    var tipo_pesquisa = $("input[name='tipo_pesquisa']:checked").val();
    var latlng = new google.maps.LatLng();
    var zoom = (params[2] == 1) ? 17 : 12;
    var latlng = new google.maps.LatLng(params[0][0], params[0][1]);

    if ((params[1].length > 100) && params[2] == 0) {
        latlng = new google.maps.LatLng(-14.235004, -51.92528);
    }

    if(params[2] == 0 && params[0][0] == 0 && params[0][1] == 0){
        if((params[1].length > 100)){
            zoom = 5;
        }else{
            zoom = 6;
        }
    }else{
        if(tipo_pesquisa == 1){
            zoom = 6;
        }else{
            zoom = 12;
        }
        
    }

    var options = {
        zoom: zoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);

    /*Novo parte - adiciona ponteiro geolocalizador(de acordo com as coordenadas informadas em 'latlng'*/
    var geocoder = new google.maps.Geocoder();

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    map.setCenter(map);
    marker.setPosition(latlng);

    if (($("#pesquisa").val() != "") && (tipo_pesquisa == "0") && params[2] == 0) {
        geocodeAddress(geocoder, map);
    }

    for (var i = 0; i < params[1].length; i++) {
        ShowResults({
            'razao_social': params[1][i][0],
            'latitude': params[1][i][1],
            'longitude': params[1][i][2],
            'label_balao': params[1][i][3],
            'id': params[1][i][4],
        });
    }
}

function sleep(ms) {
return new Promise(resolve => setTimeout(resolve, ms));
}

function geocodeAddress(geocoder, resultsMap) {
    var address = $("#pesquisa").val();
    geocoder.geocode({
        'address': address+",Brazil"
    }, function(results, status) {
       sleep(1000);
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });

        } else {
            alert('Cidade não existente!');
        }
    });
}

// Função para retornar os valores
function ShowResults(value) {
    contentString = value['label_balao'];
    localizacao.push({
        nome: value['razao_social'],
        latlng: new google.maps.LatLng(value['latitude'], value['longitude'])
    });

    if ((value['id'] == $("#selected").val())) {
        var markerPonto = new google.maps.Marker({
            position: localizacao[l].latlng,
            icon: {
                url: '/public/common/img/indicador_maps.png',
                scaledSize: new google.maps.Size(50, 50)
            },
            map: map,
            title: localizacao[l].nome
        });
    } else {
        var markerPonto = new google.maps.Marker({
            position: localizacao[l].latlng,
            map: map,
            icon: {
                url: '/public/common/img/indicador_maps2.png',
                scaledSize: new google.maps.Size(50, 50)
            },
            title: localizacao[l].nome
        });
    }

    (function(contentString) {
        google.maps.event.addListener(markerPonto, 'click', function() {
            infowindow.setContent('<div style="line-height: 1.35;">' + contentString + '</div>');
            infowindow.open(map, markerPonto);
        });
    })(contentString);
    ++l;
}