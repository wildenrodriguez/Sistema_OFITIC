
$(document).ready(function(){
    $(".info").on("click",function(){
        limpia();
        pone(this);
    });

        
    });
    function pone(p){
        var linea = $(p).closest('tr');
        $("#nro").val(linea.find("td:eq(0)").text());
        $("#sol").val(linea.find("td:eq(1)").text());
        $("#motivo2").val(linea.find("td:eq(4)").text());
    }
    function limpia(){
        $("#nro").val("");
        $("#motivo2").val("");
        $("#sol").val("");
    }