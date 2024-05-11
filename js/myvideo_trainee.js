import WaveformPlayer from "./WaveformPlayer.js";

import setVideoStats from "./Mystats.js";

import { 
    setAudio,
    setVideo,
    mergeVideo,
    mergeToAudio,
    cancelVideo
} from "./Multimedia.js";

import { 
    activerec,
    activestp,
    disablerec,
    disablestp,
    activeSave,
    disabele_save,
    copieText
} from "./MyvideoFunctions.js";

/** Mystats: calculate the linguistic statistic */
window.setVideoStats = setVideoStats;

/** Multimedia */
window.setVideo = setVideo;
window.setAudio = setAudio;
window.mergeVideo = mergeVideo;
window.cancelVideo = cancelVideo;
window.mergeToAudio = mergeToAudio;

/** MyvideoFunctions */
window.activerec = activerec;
window.disablerec = disablerec;
window.activestp = activestp;
window.disablestp = disablestp;
window.activeSave = activeSave;
window.disabele_save = disabele_save;
window.copieText = copieText;

/** path audio */
var grps = document.getElementById("mygrps").value;
var audioname = document.getElementById('audio-name').value;
var defaultBaseAudioEl = window.location.origin+"/elearning2021/groupes/GRP"+grps+"/";
var formData;

/**initialize wavesurfer */
const player = new WaveformPlayer('waveform', defaultBaseAudioEl+audioname);
window.player = player;
player.initialize();

/** Init stats view */
window.global_hapaxesList = `<div></div>`;
window.global_vbList = `<div></div>`;
window.global_adjList = `<div></div>`;
window.global_actList = `<div></div>`;
window.global_passList = `<div></div>`;
window.global_pastList = `<div></div>`;
window.global_presentList= `<div></div>`;
window.global_modalList = `<div></div>`;
window.global_inglList = `<div></div>`;
window.global_preteritList = `<div></div>`;

 /** INITIALIZE CKEDITOR */
 CKEDITOR.replace( 'obscontent',
 {extraPlugins : 'colorbutton',
 width: "98%",height: "200px"
 });
 CKEDITOR.config.readOnly = true;

/** Popover  init*/
var popoverTriggerList = [].slice.call(document.querySelectorAll('.popover-test'));
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl);
});

/** ON CLICK EVENT */
$("#id-verbs").on('click', function() {
    $('#stat-cont').empty();
    $('#stat-cont').append(
        $("<div>").append(
            global_vbList
        )
    );
    $('#typestats').text('Verbs lists');
    $('#listmodal').modal('show');
    // alert('verbs');
});
$("#id-adj").on('click', function() {
    $('#stat-cont').empty();
    $('#stat-cont').append(
        $("<div>").append(
            global_adjList
        )
    );
    $('#typestats').text('Adjectives lists');
    $('#listmodal').modal('show');
    // alert('verbs');
});
$("#id-hapax").on('click', function() {
    $('#stat-cont').empty();
    $('#stat-cont').append(
        $("<div>").append(
            global_hapaxesList
        )
    );
    $('#typestats').text('Hapaxes lists');
    $('#listmodal').modal('show');
    // alert('verbs');
});
$("#id-act").on('click', function() {
    $('#stat-cont').empty();
    $('#stat-cont').append(
        $("<div>").append(
            global_actList
        )
    );
    $('#typestats').text('Active voices lists');
    $('#listmodal').modal('show');
    // alert('verbs');
});
$("#id-pass").on('click', function() {
    $('#stat-cont').empty();
    $('#stat-cont').append(
        $("<div>").append(
            global_passList
        )
    );
    $('#typestats').text('Passive voices lists');
    $('#listmodal').modal('show');
    // alert('verbs');
});

$('#playBtn').on('click', function() {
    player.play();
    var playBtn = $(this);
    if (playBtn.attr('src').match("play")) {
      playBtn.attr('src', "./assets/pause.png");
    } else {
      playBtn.attr('src', "./assets/play.png");
    }
});
  
$('#stopBtn').on('click', function() {
player.play();
$('#playBtn').attr('src', 'assets/images/icones/Btn-Play@2x.png');
});

$('#copyoriginal').on('click', function() {
    copieText('orig_text');
});
  
$('#copytranslate').on('click', function() {
    copieText('transtext');
});
  
$('#volumeBtn').on('click', function() {
    // wavesurfer.toggleMute();
    var volumeBtn = $(this);
    if (volumeBtn.attr('src').match("volume")) {
      volumeBtn.attr('src', "assets/mute.png");
    } else {
      volumeBtn.attr('src', "assets/volume.png");
    }
  });
  
$('#rework-btn').on('click', function(){
    $("#transcription").hide();
    $("#basic-stats").hide();
    $(".line-bold").hide();
    $(".rework-container").hide();
    $(".spectre-container").hide();
    $(".obst").hide();
    $(".search").hide();
    $("#mylist").hide();
    $("#listlabel").hide();
    $("#video-legende").hide();
    $("#myctr").show();
    $("#cl-btn").show();
    disablestp();
    disabele_save();
    activerec();
    if (window.matchMedia('(max-width: 480px)').matches)
    {
        $('#myctr').css({
            'width': '100%',
            'marginLeft': '10px'
        });
        $('#videomain').css({
            'width': '97%',
            'height': '300px',
            'marginTop': '50px'
        });
        $('#mycontent').css('backgroundColor', 'black');
        $('#videomain').get(0).currentTime = 0;
        // do functionality on screens smaller than 768px
    }else{
        $('#myctr').css({
            'width': '100%',
            'marginLeft': '10px'
        });
        $('#videomain').css({
            'width': '97%',
            'height': '300px',
            'marginTop': '50px'
        });
        $('#mycontent').css('backgroundColor', 'black');
        $('#videomain').get(0).currentTime = 0;
    }
});

$('#rec-control').on('click', function(){
    captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
    disablerec();
    activestp();
});
       
$('#stp-control').on('click', function(){
    mediaRecorder.stop();
    mediaRecorder.stream.stop();
    disablestp();
    activerec();
    disabele_save();
    $('#save-form').show();
    // activeSave();
    document.getElementById('videomain').pause();
    document.getElementById('videomain').currentTime = 0;
});

$('#svtxt').on('click', function(){
    var baseUrlApi = window.location.origin;
    $("#myctr").hide();
    $('#save-form').hide();
    $("#loader").show();
    disabele_save();
    $.ajax({
        url: baseUrlApi+'/recording/save.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(msg){
            const resp = JSON.parse(msg);
            console.log("Success: "+resp.file_name);
            $( "#audios-container" ).empty();
            $( "div #audio-recorded" ).html(
                    `<audio controls>`+
                        `<source src='`+baseUrlApi+`/recording/uploads/`+resp.file_name+` ' type='audio/wav'>`+
                        `Your browser does not support the audio element.`+
                    `</audio>`
                    );
            $('input[name="content_langue_origine"]').val(resp.text);
            $('input[name="audioname"]').val(resp.file_name);
            document.querySelector('#mergetoaudio').disabled = false;
            $('#save-form').hide();
            $("#myctr").show();
            $("#loader").hide();
            mergeToAudio();
        },
        error: function(bla, msg){
            console.log("Fail: " + msg);
        }
    });
});

$('#save-control').on('click', function(){
    disabele_save();
    $('#save-form').show();
});

$('#cl-btn').on('click', function(){
    cancelVideo();
})

$('#edit-trans').on('click', function(){
    var baseUrlApi = window.location.origin;
    var id = $('#selectedid').val();
    var obs = $('#orig_text').val();
    $.ajax({
        type: 'POST',
        url: baseUrlApi+'/portail-stagiaire/edittrans.php',
        data:{
            id:id,
            trad:obs
        }
        }).done(function(res) {
            alert(res);
        });
});

$('#edit-text').on('click', function(){
    var baseUrlApi = window.location.origin;
    var id = $('#selectedid').val();
    var obs = $('#orig_text').val();
    $.ajax({
        type: 'POST',
        url: baseUrlApi+'/portail-stagiaire/editspeech.php',
        data:{
            id:id,
            trad:obs
        }
        }).done(function(res) {
            alert(res);
        });
})

$('#unsave').on('click', function(){
    $('#save-form').hide();
    $("#myctr").show();
});

$('#obsHandler').on('click', function() {
    var baseUrlApi = window.location.origin;
    var id = $('#selectedid').val();
    var obs = CKEDITOR.instances.obscontent.getData();
    $.ajax({
      type: 'POST',
      url: baseUrlApi + '/portail-stagiaire/observation.php',
      data: {
        id: id,
        obs: obs
      }
    }).done(function(res) {
      alert(res);
    });
  });
  
document.getElementById("videomain").onended = function(e) {
    $('#stp-control').trigger('click');
    activeSave();
    activerec();
    disablestp();
}


  
/** Record audio using MEDIA RECORDER */
    function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
        navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
    }


    var mediaConstraints = {
        audio: true
    };


    document.querySelector('#start-recording').onclick = function() {
        this.disabled = true;
        document.querySelector('#save-recording').disabled = true;
        captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
    };


    document.querySelector('#stop-recording').onclick = function() {
        this.disabled = true;
        mediaRecorder.stop();
        mediaRecorder.stream.stop();

        document.querySelector('#pause-recording').disabled = true;
        document.querySelector('#start-recording').disabled = false;
        document.querySelector('#save-recording').disabled = false;
    };


    document.querySelector('#pause-recording').onclick = function() {
        this.disabled = true;
        mediaRecorder.pause();
        document.querySelector('#resume-recording').disabled = false;
    };


    document.querySelector('#resume-recording').onclick = function() {
        this.disabled = true;
        mediaRecorder.resume();

        document.querySelector('#pause-recording').disabled = false;
    };


    document.querySelector('#save-recording').onclick = function() {
        this.disabled = true;
        var baseUrlApi = window.location.origin;
            $.ajax({
                url: baseUrlApi+'/recording/save.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(msg){
                    console.log("Success: "+msg);
                    $( "#audios-container" ).empty();
                    $( "div #audio-recorded" ).html(
                            `<audio controls>`+
                            `<source src='`+baseUrlApi+`/recording/uploads/`+msg+` ' type='audio/wav'>`+
                                `Your browser does not support the audio element.`+
                            `</audio>`
                            );
                    $('input[name="content_langue_origine"]').val(msg);
                    alert("your audio is ready to merge");
                    
                    document.querySelector('#mergetoaudio').disabled = false;
                },
                error: function(bla, msg){
                    console.log("Fail: " + msg);
                }
        });
    };
    var mediaRecorder;


  /**
   * muter le video
   * declencher l'enregistrement du stream
   * @param {*} stream 
   */
    function onMediaSuccess(stream) {
        var audio = document.createElement('audio');
        document.getElementById('videomain').play();
        document.getElementById("videomain").muted = true; 
        audio = mergeProps(audio, {
            controls: true,
            muted: true
        });
        audio.srcObject = stream;
        audio.play();
        $( "#audios-container" ).empty();
        mediaRecorder = new MediaStreamRecorder(stream);
        mediaRecorder.stream = stream;
        var recorderType = document.getElementById('audio-recorderType').value;
        mediaRecorder.mimeType = 'audio/wav';
        mediaRecorder.audioChannels = 1;
        mediaRecorder.ondataavailable = function(blob) {
            var urlblob =  URL.createObjectURL(blob);
            var aud = $("<audio>", {id:"audcontrol", controls: "controls", class:"ml-4"});
            var sourc = $("<source>", {src: urlblob , type: "audio/mp3" });
            $( "#audios-container" ).append(aud);
            $( "#audcontrol" ).append(sourc);
            $('#stp-control').trigger('click');
            formData = new FormData();    
            formData.append('fileUpload', blob);
        };
        var timeInterval = document.querySelector('#time-interval').value;
        if (timeInterval) timeInterval = parseInt(timeInterval);
        else timeInterval = 5000 * 1000;
        // get blob after specific time interval
        mediaRecorder.start(timeInterval);
        document.querySelector('#stop-recording').disabled = false;
        document.querySelector('#pause-recording').disabled = false;
        document.querySelector('#save-recording').disabled = false;
    }

    function onMediaError(e) {
        console.error('media error', e);
    }

    var audiosContainer = document.getElementById('audios-container');
    var index = 1;

    // below function via: http://goo.gl/B3ae8c
    function bytesToSize(bytes) {
        var k = 1000;
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes === 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)), 10);
        return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
    }

    // below function via: http://goo.gl/6QNDcI
    function getTimeLength(milliseconds) {
        var data = new Date(milliseconds);
        return data.getUTCHours() + " hours, " + data.getUTCMinutes() + " minutes and " + data.getUTCSeconds() + " second(s)";
    }

    window.onbeforeunload = function() {
        document.querySelector('#start-recording').disabled = false;
    };
    function observation(){
        var baseUrlApi = window.location.origin;
        var manipulateVideo = $.ajax({
        type: 'POST',
        url: baseUrlApi+'/portail-stagiaire/merge.php',
        data:{
            id:m,
            fname:fname,
            id_stagiaire:id_stagiaire
        }
        }).done(function( res ) {
            $("#loader").hide();
        
        });
    }