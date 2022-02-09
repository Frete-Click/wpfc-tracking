
var $jq = jQuery.noConflict()



$jq("#document").keydown(function(){

    try {
        $jq("#document").unmask();
    } catch (e) {}

    var tamanho = $jq("#document").val().length;

    if(tamanho < 11){
        $jq("#document").mask("999.999.999-99");
    } else {
        $jq("#document").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $jq(this).val();
    $jq(this).val('');
    $jq(this).val(currentValue);
});