/** Button manager */

function activestp(){
    $('#stp').css('color', '#ED217C');
    document.getElementById('stp-ico').src = "assets/Btn-recordActive.png";
    $('#stp-ico').attr('src', 'assets/Btn-recordActive.png');
    $('#stp-control').prop('disabled', false);
}
function disablestp(){
    document.getElementById("stp").style.color = "#444444"; 
    document.getElementById('stp-ico').src = "assets/stpbtn.png";
    $('#stp-control').prop('disabled', true);
}

function activerec(){
    $('#rec').css('color', '#ED217C');
    $('#ico-rec').attr('src', 'assets/Btn-record.png');
    $('#rec-control').prop('disabled', false);
} 

function disablerec(){
    $('#rec').css('color', '#444444');
    $('#ico-rec').attr('src', 'assets/Btn-record.png');
    $('#rec-control').prop('disabled', true);
}

function activeSave(){
    $('#sve').css('color', '#ED217C'); 
    $('ico-sve').attr('src', 'assets/ico-save@2x.png');
    $('#save-control').prop('disabled', false);
}
function disabele_save(){
    $('#sve').css('color', '#444444'); 
    $('ico-sve').attr('src', 'assets/ico-save@2xdis.png');
    $('#save-control').prop('disabled', true);
}

/**
 * texte manioulation
 */
function copieText(champ){
    var content = document.getElementById(champ);
    content.select();
    document.execCommand('copy');
    alert("Copied!");
}

export {
    activerec,
    activestp,
    disablerec,
    disablestp,
    activeSave,
    disabele_save,
    copieText
}