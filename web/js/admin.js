$(document).ready(function(){
/*
    $( "#bcbutton" ).click(function() {
        var t=$('.carousel-inner').find('.active').find('img').prop('src');
        $('#bannermodel-file_path').val(t.substring(t.lastIndexOf('/')+1,t.length));
        $('#quicksearchmodel-img').val(t.substring(t.lastIndexOf('/')+1,t.length));
    });
    $( "#bcbutton2" ).click(function() {
        var t=$('.carousel-inner').find('.active').find('img').prop('src');
        $('#quicksearchmodel-img_tile').val(t.substring(t.lastIndexOf('/')+1,t.length));
    });
     // showConsoleLog(onbmodif);

    var t= $("#w1");
    var s= '';
    var tt;
    var f= $('#bannermodel-file_path').val();
    if (f!=undefined) {
        showConsoleLog('f=' + f);
        for (var i = 0; i < 50; i++) {
            tt = t.find('.active').find('img').prop('src');
            s = tt.substring(tt.lastIndexOf('/') + 1, tt.length);
            if (s == f) break;
            t.carousel('next');
            showConsoleLog('s=' + s);
        }
        // !!!Проядок не менять - перекрутит
        t.on('slid.bs.carousel', function () {
            var t = $('.carousel-inner').find('.active').find('img').prop('src');
            $('#bannermodel-file_path').val(t.substring(t.lastIndexOf('/') + 1, t.length));
        });

    }
*/
});
var loadFile = function(event,idoutput) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(idoutput);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
