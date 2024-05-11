
function showtext(){
    console.log('test');
  }
  
  function showtranslation(){
    $("#translation").show();
  }
  function showaudiobande(){
    $("#audio-bande").show();
  }
  function showAudioModal(){
  // alert("open modal");
  
  $("#audio-button").show();
  }
  
  
  function mergeToAudio(){
   document.querySelector('#mergetoaudio').disabled = true;
   var fname= $('input[name="textboxname"]').val();
   var audioname= $('input[name="audioname"]').val();
   var legende_f = $('input[name="new_legende"]').val();
   var id_stagiaire = $('input[name="id_stagiaire"]').val();
   var id_groupe = $('input[name="mygrps"]').val();
  alert(id_groupe);
  alert(id_stagiaire);
   var mot = $('input[name="content_langue_origine"]').val();
  console.log('legende:'+legende_f+',  mot:'+mot);
   console.log('fname: '+fname);
   console.log('audioname: '+audioname);
   $("#loader").show();
  
  var m = "kjglfgjlfjgnf";
    var manipulateVideo = $.ajax({
        type: 'POST',
        url: 'https://elprod.forma2plus.com/portail-stagiaire/merge.php',
        data:{
          id:m,
          fname:fname,
          audioname:audioname,
          legende_f:legende_f,
          mot:mot,
          id_stagiaire:id_stagiaire,
          id_groupe:id_groupe
        }
      }).done(function( res ) {
            $("#loader").hide();
        // $( "div #principal-video" ).html(
        //   `<video class='bg-secondary mt-4' width='420' height='345'controls='controls' style='background-color:grey;'><source src='https://elprod.forma2plus.com/elearning2020/groupes/GRP15921/output`+fname+` ' type='video/mp4'/>
        //    </video>`
        //   );
            alert("Audio merged succesfuly to video");
            // var newName = "output"+fname;
            // var endPoint = "https://elprod.forma2plus.com/disk2/elearning2021/trainee/video/mergeToAudios/"+fname+"/"+newName;
            // var manipulateVideo2 = $.ajax({
            //   type: 'GET',
            //   url: endPoint
            // }).done(function( msg ) {
            //   alert( "Audio merged to succesfully");
              location.reload(true);
            // });
      });
  
  }
  
  
  
  // Set video info
  // function setvideo(videoName,original_text,target_text,original_audio,audio_cible,legende_f,id,groupeid) {
  //       var base_path = "http://localhost/GRP"+groupeid+'/';
  //       var base_path = "https://elprod.forma2plus.com/elearning2020/groupes/GRP"+groupeid+'/'; //path_on_preprod
  //       var video_full_path = base_path+videoName;
  //       // document.getElementById('videomain').styele.width = 
  //       document.getElementById('videomain').style.width = '450px';
  //       document.getElementById('videomain').style.height = '350px';
  //       $( "div #main-video" ).html(
  //         `<video class='' id='videomain' controls='controls' style='background-color:grey;' ><source src=' `+video_full_path+` ' type='video/mp4'/>
  //          </video>`
  //         );
        
  
  
  //       $( "div #video-legende" ).html(
  //         `<p>`+legende_f+
  //         `</p>`
  //         );
  
  //       $( "div #original_text" ).html(
  //           `<p>`+original_text+
  //           `</p>`
  //         );
  //         $( "div #translation_text" ).html(
  //           `<p>`+original_text+
  //           `</p>`
  //         );
  
  //         $( "div #audio-player" ).html(
  //           `<audio controls>`+
  //           `<source src='`+base_path+original_audio+` ' type='audio/wav'>`+
  //                `Your browser does not support the audio element.`+
  //           `</audio>`
  //         );
  //         $('input[name="textboxname"]').val(videoName);
  //         $('input[name="legende_f"]').val(legende_f);
  //         $('input[name="content_langue_origine"]').val(original_text);
  //         $("#vid-name").val("test");
  //  }
  
  
  var myaudiopath = 'https://elprod.forma2plus.com/recording/uploads/';
  
  playBtn = document.getElementById("playBtn");
  stopBtn = document.getElementById("stopBtn");
  volumeBtn = document.getElementById("volumeBtn");
  grps = document.getElementById("mygrps").value;
  audioname = document.getElementById('audio-name').value;
  var defaultBaseAudioEl = "https://elprod.forma2plus.com/elearning2021/groupes/GRP"+grps+"/";
  
  // alert(grps);
  var wavesurfer = WaveSurfer.create({
      container: '#waveform',
      waveColor: '#808080',
      progressColor: 'black',
      barWidth: 1,
      height:30,
      responsive: true,
      hideScrollbar: true,
      barRadius: 1
  });
  var formatTime = function (time) {
      return [
          Math.floor((time % 3600) / 60), // minutes
          ('00' + Math.floor(time % 60)).slice(-2) // seconds
      ].join(':');
  };
  wavesurfer.on('ready', function () {
      $('.waveform__duration').text( formatTime(wavesurfer.getDuration()) );
  });
  // var waveduration = WaveSurfer.getDuration();
  // alert(waveduration);
  wavesurfer.load(defaultBaseAudioEl+audioname);
  
  playBtn.onclick = function(){
      wavesurfer.playPause();
      if(playBtn.src.match("play")){
          playBtn.src  = "./assets/pause.png";
          // playBtn.setAttribute("style", "width: 20px;height:20px;margin-top:4px");  
      }
      else{
          playBtn.src = "./assets/play.png";
          // playBtn.setAttribute("style", "width: 20px;height:20px;");
      }
  }
  
  stopBtn.onclick = function(){
      wavesurfer.stop();
      playBtn.src = "assets/images/icones/Btn-Play@2x.png"
  }
  
  volumeBtn.onclick = function(){
      wavesurfer.toggleMute();
      if(volumeBtn.src.match("volume")){
          volumeBtn.src  = "assets/mute.png";
      }
      else{
          volumeBtn.src = "assets/volume.png"
      }
  }
  
  // wave plauer script^^^
  
  
  
  // selection element
          obsc = document.getElementById('obsHandler');
          obsContent = document.getElementById('obscontent');
          transtext = document.getElementById('transtext');
          copyoriginal = document.getElementById('copyoriginal');
          svtxt = document.getElementById('svtxt');
          unsave = document.getElementById('unsave');
          saveButton = document.getElementById('save-control');
          mergeButton = document.getElementById('merge-control');
          stpButton = document.getElementById('stp-control');
          icorec = document.getElementById('ico-rec');
          reccontrol = document.getElementById('rec-control');
          clbtn = document.getElementById('cl-btn');
          editText = document.getElementById('edit-text');
          editTrans = document.getElementById('edit-trans');
          mylist = document.getElementById('mylist');
          videomain = document.getElementById('videomain');
          details = document.getElementById("details");
          reworkbtn = document.getElementById("rework-btn");
          mycontent = document.getElementById("mycontent");
  
  
          reworkbtn.onclick = function(){
          $("#details").hide();
          $("#mylist").hide();
          $("#arrow").hide();
          $("#recherche").hide();
          $("#listlabel").hide();
          $("#video-legende").hide();
          $("#myctr").show();
          $("#cl-btn").show();
          if (window.matchMedia('(max-width: 480px)').matches)
          {
          document.getElementById("myctr").style.width = '300px';
          document.getElementById('videomain').style.width = '300px'; 
          document.getElementById('videomain').style.height = '150px';
          document.getElementById('videomain').style.marginTop = '20px';
              // do functionality on screens smaller than 768px
          }else{
          document.getElementById("myctr").style.width = '1000px';
          document.getElementById('videomain').style.width = '1000px'; 
          document.getElementById('videomain').style.height = '500px';
          document.getElementById('videomain').style.marginTop = '50px';
          mycontent.style.backgroundColor = "black";
          document.getElementById('videomain').currentTime = 0;
          }
      }
  
      function cancelVideo(){
          $("#details").show();
          $("#mylist").show();
          $("#arrow").show();
          $("#recherche").show();
          $("#listlabel").show();
          $("#video-legende").show();
          $("#myctr").hide();
          $("#cl-btn").hide();
          disablestp();
          activerec();
          if (window.matchMedia('(max-width: 480px)').matches){
          videomain.style.width = '300px'; 
          videomain.style.height = '150px';
          videomain.style.marginTop = '0px';
          videomain.style.margin = 'auto';
          mycontent.style.backgroundColor = "transparent";
          document.getElementById("videomain").muted = false; 
          }else{
          videomain.style.width = '500px'; 
          videomain.style.height = '350px';
          videomain.style.marginTop = '0px';
          mycontent.style.backgroundColor = "transparent";
          document.getElementById("videomain").muted = false; 
          }
       
      }
      
      // button animation
      function activeSave(){
          document.getElementById("sve").style.color = "#ED217C"; 
          document.getElementById('ico-sve').src = "assets/ico-save@2x.png";
          mergeButton.disabled = false;
      }
      function disabele_save(){
          document.getElementById("sve").style.color = "#444444"; 
          document.getElementById('ico-sve').src = "assets/ico-save@2xdis.png";
          saveButton.disabled = true;
      }
  
      function active_merge(){
          document.getElementById("mrg").style.color = "#ED217C"; 
          document.getElementById('ico-mrg').src = "assets/ico-merge@2x.png";
          mergeButton.disabled = false;
      }
      function disable_merge(){
          document.getElementById("mrg").style.color = "#444444"; 
          document.getElementById('ico-mrg').src = "assets/ico-merge@2xdis.png";
          mergeButton.disabled = true;
      }
      function activestp(){
          document.getElementById("stp").style.color = "#ED217C"; 
          document.getElementById('stp-ico').src = "assets/Btn-recordActive.png";
          stpButton.disabled = false;
      }
      function disablestp(){
          document.getElementById("stp").style.color = "#444444"; 
          document.getElementById('stp-ico').src = "assets/stpbtn.png";
          stpButton.disabled = true;
      }
  
      function activerec(){
          document.getElementById("rec").style.color = "#ED217C"; 
          icorec.src = "assets/Btn-record.png";
          reccontrol.disabled = false;
      } 
      
      function disablerec(){
          document.getElementById("rec").style.color = "#444444"; 
          icorec.src = "assets/Btn-recorddis.png";
          reccontrol.disabled = true;
      }
  
  
      // Button event
      document.getElementById("videomain").onended = function(e) {
          //  alert('video ended');
           stpButton.click();
      }
      
  
  
  
      reccontrol.onclick = function(){
          captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
          disablerec();
          activestp();
      }
      stpButton.onclick = function(){
          mediaRecorder.stop();
          mediaRecorder.stream.stop();
          disablestp();
          activerec();
          activeSave();
          // 
          document.getElementById('videomain').pause();
          document.getElementById('videomain').currentTime = 0;
          
      }
      mergeButton.onclick = function(){
          disable_merge();
          mergeToAudio();
      }
      svtxt.onclick = function(){
          $("#myctr").hide();
          $('#save-form').hide();
          $("#loader").show();
          disabele_save();
          $.ajax({
                      url: 'https://elprod.forma2plus.com/recording/save.php',
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
                                      `<source src='https://elprod.forma2plus.com/recording/uploads/`+resp.file_name+` ' type='audio/wav'>`+
                                      `Your browser does not support the audio element.`+
                                  `</audio>`
                                  );
                          $('input[name="content_langue_origine"]').val(resp.text);
                          $('input[name="audioname"]').val(resp.file_name);
                          
                          
                          document.querySelector('#mergetoaudio').disabled = false;
  
                          $('#save-form').hide();
                          $("#myctr").show();
                          $("#loader").hide();
                          active_merge();
                          alert("your audio is ready to merge");
                      },
                      error: function(bla, msg){
                          console.log("Fail: " + msg);
                      }
               });
      }
      saveButton.onclick = function(){
          disabele_save();
          $('#save-form').show();
          // $("#myctr").hide();
          // this.disabled = true;
        
  
  
  
      }
  
      // input button event
      clbtn.onclick = function(){
      cancelVideo();
      }
      editTrans.onclick = function(){
          alert("expression Updated");
      }
      editText.onclick = function(){
          alert("expression Updated");
      }
      unsave.onclick = function(){
          $('#save-form').hide();
          $("#myctr").show();
      }
     function copieText(champ){
         var content = document.getElementById(champ);
         content.select();
         document.execCommand('copy');
         alert("Copied!");
     }
     copyoriginal.onclick = function(){
         copieText('orig_text');
     }
     transtext.onclick = function(){
      //    copieText('transtext');
     }
  
  
  
  
  //     navigator.clipboard.writeText(text).then(function() {
  //     console.log('Async: Copying to clipboard was successful!');
  //   }, function(err) {
  //     console.error('Async: Could not copy text: ', err);
  //   });
  
  
  
  
  
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
          
          // mediaRecorder.save();
          // $.ajax({
          //     url: 'save.php',
          //     type: 'POST',
          //     data: formData,
          //     processData: false,
          //     contentType: false,
          //     success: function(msg){
          //       console.log("Success: " + msg);
          //     },
          //     error: function(bla, msg){
          //       console.log("Fail: " + msg);
          //     }
          // });
  
  
              $.ajax({
                      url: 'https://elprod.forma2plus.com/recording/save.php',
                      type: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function(msg){
                          console.log("Success: "+msg);
                          $( "#audios-container" ).empty();
                          $( "div #audio-recorded" ).html(
                                  `<audio controls>`+
                                  `<source src='https://elprod.forma2plus.com/recording/uploads/`+msg+` ' type='audio/wav'>`+
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
  
  
          // alert('Drop WebM file on Chrome or Firefox. Both can play entire file. VLC player or other players may not work.');
      };
      var mediaRecorder;
  
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
          // audiosContainer.appendChild(audio);
          // audiosContainer.appendChild(document.createElement('hr'));
  
          mediaRecorder = new MediaStreamRecorder(stream);
          mediaRecorder.stream = stream;
  
          var recorderType = document.getElementById('audio-recorderType').value;
  
         
          mediaRecorder.mimeType = 'audio/wav';
  
          // don't force any mimeType; use above "recorderType" instead.
          // mediaRecorder.mimeType = 'audio/webm'; // audio/ogg or audio/wav or audio/webm
  
          mediaRecorder.audioChannels = 1;
          mediaRecorder.ondataavailable = function(blob) {
              var urlblob =  URL.createObjectURL(blob);
  
              var aud = $("<audio>", {id:"audcontrol", controls: "controls", class:"ml-4"});
              var sourc = $("<source>", {src: urlblob , type: "audio/mp3" });
  
              //audiosContainer.appendChild(a);
              //audiosContainer.appendChild(document.createElement('hr'));
              $( "#audios-container" ).append(aud);
              $( "#audcontrol" ).append(sourc);
  
  
  
              //custom
              // $( "#stop-recording" ).trigger( "click" );
              stpButton.click();
  
              formData = new FormData();    
              formData.append('fileUpload', blob);
  
  
          //     var a = document.createElement('a');
          //     a.target = '_blank';
          //     a.innerHTML = 'Open Recorded Audio No. ' + (index++) + ' (Size: ' + bytesToSize(blob.size) + ') Time Length: ' + getTimeLength(timeInterval);
  
          //     a.href = URL.createObjectURL(blob);
  
          //     audiosContainer.appendChild(audio);
          //     $(audiosContainer).children()
          //     audiosContainer.appendChild(document.createElement('hr'));
          //     var formData = new FormData();    
          //    formData.append('fileUpload', blob);
          //     $.ajax({
          //          url: 'https://preprod.forma2plus.com/recording/save.php',
          //          type: 'POST',
          //          data: formData,
          //          processData: false,
          //          contentType: false,
          //          success: function(msg){
          //               console.log("Success: "+msg);
          //               $( "div #audio-recorded" ).html(
          //                     `<audio controls>`+
          //                     `<source src='https://preprod.forma2plus.com/recording/uploads/`+msg+` ' type='audio/wav'>`+
          //                         `Your browser does not support the audio element.`+
          //                     `</audio>`
          //                     );
          //               $('input[name="audioname"]').val(msg);
          //               alert("your audio is ready to merge");
          //          },
          //          error: function(bla, msg){
          //               console.log("Fail: " + msg);
          //          }
          //     });
  
  
  
          };
  
          var timeInterval = document.querySelector('#time-interval').value;
          if (timeInterval) timeInterval = parseInt(timeInterval);
          else timeInterval = 50000 * 1000;
  
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
          var manipulateVideo = $.ajax({
          type: 'POST',
          url: 'https://elprod.forma2plus.com/portail-stagiaire/merge.php',
          data:{
              id:m,
              fname:fname,
              id_stagiaire:id_stagiaire
          }
          }).done(function( res ) {
              $("#loader").hide();
          
          });
      }
    
  
  
      function editorigin(){
          
      }
      function edittrans(){
          
      }
  
  
      
  CKEDITOR.replace( 'obscontent',
  {extraPlugins : 'colorbutton',
  width: "98%",height: "200px"
});
  
  obsc.onclick = function(){
          
          var id = document.getElementById('selectedid').value;
          var obs = CKEDITOR.instances.obscontent.getData(); 
          console.log(obs);
          var validateObs = $.ajax({
          type: 'POST',
          url: 'https://elprod.forma2plus.com/portail-stagiaire/observation.php',
          data:{
              id:id,
              obs:obs
          }
          }).done(function(res) {
              alert(res);
          
          });
      }
  
    function setaudio(id, link) {
        var els = document.getElementsByClassName("transcript");
        Array.prototype.forEach.call(els, function(el) {
            // Do stuff here
            el.style.display = 'none';
        });
        // document.getElementById("transcript_" + id).style.display = 'block';
        // document.getElementById("transcript_" + id + "_stat").style.display = 'block'; stat_html
        console.log("++++++++++++");
        console.log("transcript_" + id);
        console.log("transcript_" + id + "_stat");
        // document.getElementById("iframevideo").src = link; 


        var link_stat = "";
        var link_html = "";
        if (link.includes('.txt')) {
            document.getElementById("transcript_div").src = link; 
            document.getElementById("stat_html").src = link.replace(".txt", "2.html"); 
            document.getElementById("stat_button").href = link.replace(".txt", "2.xlsx");
        }
        else if (link.includes('.srt')){
            document.getElementById("transcript_div").src = link; 
            document.getElementById("stat_html").src = link.replace(".srt", ".html");
            document.getElementById("stat_button").href = link.replace(".srt", ".xlsx");
        }
        // document.getElementById("transcript_div").src = link; 
        // document.getElementById("stat_html").src = link; 

        
    
    }
      function setvideo(videoName,original_text,target_text,original_audio,audio_cible,legende_f,id,groupeid,obs,date) {
                  var base_path = "https://elprod.forma2plus.com/elearning2021/groupes/GRP"+groupeid+'/'; //path_on_preprod
                  var video_full_path = base_path+videoName;
                  if (window.matchMedia('(max-width: 480px)').matches)
                  {
                  // document.getElementById("myctr").style.width = '300px';
                  document.getElementById('videomain').style.width = '103%';
                  document.getElementById('videomain').style.height = 'auto';
                  document.getElementById('videomain').style.marginTop = '20px';
                      // do functionality on screens smaller than 768px
                  }else{
                  document.getElementById('videomain').style.width = '97%';
                  document.getElementById('videomain').style.height = 'auto';
                  }
  
                  
                  document.getElementById('videomain').style.width = '103%';
                  document.getElementById('videomain').style.height = 'auto';
                  location.href = '#videomain';
  
                  videomain.src = video_full_path;
                  $( "div #video-legende" ).html(
                    // `<p>`+legende_f+
                    // `</p>`
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
                      CKEDITOR.instances.obscontent.setData(obs);
                      document.getElementById('orig_text').value = original_text;
                      document.getElementById('transtext').value = target_text;
                      document.getElementById('selectedid').value = id;
                      // document.getElementById('obscontent').value = obs;
                      // document.getElementById('audio-name').value = original_audio;
                      wavesurfer.load(defaultBaseAudioEl+original_audio);
                      $("div #audio-player").html(
                      `<audio controls>`+
                      `<source src='`+base_path+original_audio+` ' type='audio/wav'>`+
                          `Your browser does not support the audio element.`+
                      `</audio>`
                      );
                      $('input[name="legende_f"]').val(legende_f);
                      $('input[name="content_langue_origine"]').val(original_text);
                      $("#vid-name").val(videoName);
  }
  

  