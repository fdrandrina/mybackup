function setAudio(videoname, txt) {
    alert('set audio');
    // const newAudioFile = './audio/audio2.mp3';
    // player.loadAudio(newAudioFile);
    // $('#content-title').text('this is my new video'); 
}


/**
 * changer l'information du video
 * @param {string} videoname 
 * @param {string} txt 
 */
function setVideo(videoName,original_text,target_text,original_audio,audio_cible,legende_f,id,groupeid,obs,date,videoduration, idexp) {
  var baseUrlApi = window.location.origin;
  var base_path = baseUrlApi+"/elearning2021/groupes/GRP"+groupeid+'/'; //path_to_prod
  var video_full_path = base_path+videoName;
  // this.setTextStats(original_text,videoduration,idexp);
  $("#duration1").text(videoduration);
  if (window.matchMedia('(max-width: 480px)').matches)
  {
    $('#videomain').css({
      'width': '103%',
      'height': 'auto',
      'marginTop': '20px'
      });
  }else{
    $('#videomain').css({
      'height': '280px',
      'width': '97%'
      });
  }
  location.href = '#videomain';
  videomain.src = video_full_path;
  $('#duration').text = 'test';
  $( "div #video-legende" ).html(
      `<div>
        <p class="legende">`+legende_f+`</p>
      </div>
      <div class="row date-container">
        <!-- <img src="assets/ico-calendar@2x.png" width="16px" height="16px"> -->
        <svg 
            width="16px" 
            height="16px"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path 
                fill="#003D82" 
                d="M160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32zM0 192H448V464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192zM64 304C64 312.8 71.16 320 80 320H112C120.8 320 128 312.8 128 304V272C128 263.2 120.8 256 112 256H80C71.16 256 64 263.2 64 272V304zM192 304C192 312.8 199.2 320 208 320H240C248.8 320 256 312.8 256 304V272C256 263.2 248.8 256 240 256H208C199.2 256 192 263.2 192 272V304zM336 256C327.2 256 320 263.2 320 272V304C320 312.8 327.2 320 336 320H368C376.8 320 384 312.8 384 304V272C384 263.2 376.8 256 368 256H336zM64 432C64 440.8 71.16 448 80 448H112C120.8 448 128 440.8 128 432V400C128 391.2 120.8 384 112 384H80C71.16 384 64 391.2 64 400V432zM208 384C199.2 384 192 391.2 192 400V432C192 440.8 199.2 448 208 448H240C248.8 448 256 440.8 256 432V400C256 391.2 248.8 384 240 384H208zM320 432C320 440.8 327.2 448 336 448H368C376.8 448 384 440.8 384 432V400C384 391.2 376.8 384 368 384H336C327.2 384 320 391.2 320 400V432z"
            />
      </svg>
        <p class="video-date"> `+date+`</p>
      </div>`
    );
  $('#orig_text').val(original_text);
  $('#transtext').val(target_text);
  $('#selectedid').val(id);
  $('input[name="legende_f"]').val(legende_f);
  $('input[name="content_langue_origine"]').val(original_text);
  $("#vid-name").val(videoName);
  CKEDITOR.instances.obscontent.setData(obs);
  player.loadAudio(base_path+original_audio);
  setVideoStats(original_text,videoduration,idexp);
}

function mergeToAudio(){
  document.querySelector('#mergetoaudio').disabled = true;
  var fname= $('input[name="textboxname"]').val();
  var audioname= $('input[name="audioname"]').val();
  var legende_f = $('input[name="new_legende"]').val();
  var id_stagiaire = $('input[name="id_stagiaire"]').val();
  var id_groupe = $('input[name="mygrps"]').val();
  var pickedValueLang = document.getElementById("mylang").value;
  var mot = $('input[name="content_langue_origine"]').val();
  console.log('legende:'+legende_f+',  mot:'+mot);
  console.log('fname: '+fname);
  console.log('audioname: '+audioname);
  $("#loader").show();
  var baseUrlApi = window.location.origin;
  var m = "kjglfgjlfjgnf";
  $.ajax({
    type: 'POST',
    url: baseUrlApi+'/portail-stagiaire/merge.php',
    data:{
      id:m,
      fname:fname,
      audioname:audioname,
      legende_f:legende_f,
      mot:mot,
      id_stagiaire:id_stagiaire,
      id_groupe:id_groupe,
      infolangue:pickedValueLang
    }
    }).done(function( res ) {
      $("#loader").hide();
      alert("Audio merged succesfuly to video");
      location.reload(true);
    });
}

function mergeVideo(videoname, txt) {
  alert('merge');

}

function cancelVideo(){
  $("#transcription").show();
  $("#basic-stats").show();
  $(".line-bold").show();
  $(".rework-container").show();
  $(".spectre-container").show();
  $(".obst").show();
  $(".search").show();
  $("#mylist").show();
  $("#listlabel").show();
  $("#video-legende").show();
  $("#myctr").hide();
  $("#cl-btn").hide();
  disablestp();
  activerec();
  disabele_save();
  if (window.matchMedia('(max-width: 480px)').matches){
    $('#videomain').css({
      'width': '300px',
      'height': '150px',
      'marginTop': '0px',
      'margin': 'auto'
    });   
    $('#mycontent').css({
      'backgroundColor': '#fff',
    });   
    document.getElementById("videomain").muted = false; 
  }else{
    $('#videomain').css({
      'width': '97%',
      'height': '280px',
      'marginTop': '0px'
    });
    $('#mycontent').css('backgroundColor', '#fff');
    document.getElementById("videomain").muted = false; 
  }
}

export {
  setAudio,
  setVideo,
  mergeVideo,
  cancelVideo,
  mergeToAudio
};



