$(document).ready(function(){
    $('#estados').change(function(){
        $('#cidades').load('cidades.php?estado='+$('#estados').val() );
    });
});