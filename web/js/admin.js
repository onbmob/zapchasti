$(document).ready(function(){


});

var LoadPriceFromFile = function(event) {
    //window.localStorage.setItem("basket", 1);
    /*setTimeout(function () {
        show_error_window('Загрузка товаров из Excel','green','15000');
    }, 100);*/
    $('#form_price').submit();
};

var loadFile = function(event,idoutput) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(idoutput);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

function initKartikMenu(){

    var kartik_stat_page = $('#categorysearchmodel-page_id');
    //kartik_stat_page.select2();

    kartik_stat_page.change(function(){
       /* var par = kartik_stat_page.find('option:selected').text().split('#');
        var parent = 0;
        if(par[1] !== undefined) parent = par[1];
        $('#categorysearchmodel-parent').val(parent);
        $('#categorysearchmodel-name').val(par[0]);*/

        var par = kartik_stat_page.find('option:selected').text();
        $('#categorysearchmodel-name').val(par);

    });

}

