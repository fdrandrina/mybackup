 <!-- application/views/trainee/video/ckeditor_4.19.0_basic_trainee/ckeditor/ckeditor.js";?> ></script> -->
    <script src="https://elprod.forma2plus.com/elearning2021/assets/js/myvideo/ckeditor_4.19.0_basic_trainee/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.WebRTC-Experiment.com/MediaStreamRecorder.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="<?php echo base_url()?>assets/js/myvideo/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/wavesurfer.js@beta/dist/wavesurfer.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/styles/trainee/videostyle.css'?>">
    <style>
        html {
    background: #eee;
    
}
.spaced{
    margin-left: 10px;
}
.stats{
    color:red
}
    </style>
    <?php 
    // $external_FOLDER_groupe = 'https://preprod.forma2plus.com/disk2/elearning2021_test/elearning2021/groupes/GRP';
    $external_FOLDER_groupe = base_url().'/groupes/GRP';
    ?>
    <div class="content-wrapper content-body-elearning margin-rigth">
        <br><br><br>
        <div class="content row" >
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                    <br>
                    <div class="row" id="arrow">
                            <div class="">
                                <div class="col-sm-12">
                                    <h4 class="titre-your-module title-pdg">
                                        <a href="<?php echo base_url(); ?>dashboard">
                                        <img src="assets/icons-f2+/menu_transverse/ico-home.png" alt="User elearning" class="user-image img-home">&nbsp;<span class="home-title">Home</span>&nbsp;<img src="assets/icons-f2+/historique_de_cours/ico-arrowright.png" alt="User elearning" class="user-image img-home icons-rigth">
                                        </a>
                                        <a href="<?php echo current_url(); ?>" class="home-page active">My video </a>
                                        <a href="https://open.my.app">Open Myoedb for Android/</a>
                                        <a href="wmyoedb://">Open Myoedb for iOS</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div >
                            <div class="messageconfirmation"></div>
                            <div class="row mt-2 box" id="mycontent">
                                <div class="col-sm-9">
                                        <div>
                                                <div>
                                                        <?php foreach ($videoFirstResult as $key => $value){ ?>
                                                                <div id="principal-video" class="col-sm-12">
                                                                    <div class="col" id="main-video">
                                                                            <video class="main-video" id="videomain" controls="controls" style="background-color:grey;">
                                                                                <source src="<?php echo $external_FOLDER_groupe.$groupeid.'/'.$value->f_name; ?>" type="video/mp4"/>
                                                                            </video>
                                                                    </div>
                                                                    <div id="cl-btn" hidden>
                                                                            <img src="assets/close.png" width="25px" height="25px">
                                                                    </div>
                                                                        <!-- <br><br><br> -->
                                                                </div>  
                                                                <div id="myctr" hidden>
                                                                    <div class="myctr-btn col-sm-12">
                                                                        <div>
                                                                            <select name="picker" id="mylang" onchange="getSlectedvalue()"> 
                                                                                <option value="en-US">English</option>
                                                                                <option value="fr-FR">French</option>
                                                                            </select>
                                                                        </div>
                                                                        <div id="mytime">00:00</div>
                                                                        <button class="row" id="rec-control">
                                                                            <img src="assets/Btn-record.png" id="ico-rec" width="25px" height="25px">
                                                                            <div id="rec">Record</div>
                                                                        </button>
                                                                        <button class="row" id="stp-control">
                                                                            <img src="assets/stpbtn.png" id="stp-ico" width="25px" height="25px">
                                                                            <div class="disabled-label" id="stp">Stop</div>
                                                                        </button>
                                                                        <button class="row" id="save-control">
                                                                            <img src="assets/ico-save@2xdis.png" id="ico-sve" width="25px" height="25px">
                                                                            <div class="disabled-label" id="sve">Save</div>
                                                                        </button>
                                                                        <button class="row" id="merge-control">
                                                                            <img src="assets/ico-merge@2xdis.png" id="ico-mrg" width="25px" height="25px">
                                                                            <div class="disabled-label" id="mrg">Merge</div>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div id="save-form" hidden>
                                                                    <div>
                                                                        <div class="row" >
                                                                            <div class="name-record">
                                                                                Name of your <br> recording
                                                                            </div>
                                                                            <input  type="text" class="saveTerm" name="new_legende"></input>
                                                                            <button id="svtxt">
                                                                                <div class="savetxt">Save</div>
                                                                            </button>
                                                                            <button id="unsave">
                                                                                <div class="canceltxt">Cancel</div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="loader" hidden></div>
                                                                    <div class="col-sm-12 row" id="video-legende">
                                                                            <div>
                                                                                <p class="legende"><?php echo $value->legende_f ; ?></p>
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
                                                                                <p class="video-date"><?php echo $value->date_creat ; ?></p>
                                                                            </div>
                                                                    </div>
                                                        <?php } ?>
                                                    <div class="col-sm-12"  id="line-bar1">
                                                        <div  class="line-bold col-sm-12"/>
                                                    </div>
                                                </div> 
                                                <div class=" row col-sm-12" id="transcription">
                                                    <div class="col-sm-6 mbtest col-xs-12">
                                                        <div class="col-sm-12 details" id="txtdetails">
                                                            <div class="row container-title-speech">
                                                                <div id="txt_ttl">
                                                                    <p  class="title_text">My speech</p>
                                                                </div>
                                                                <div id="title-button-action">
                                                                    <button class="editButton" id="copyoriginal">
                                                                        <!-- <img src="assets/images/icones/ico-copy@2x.png" width="18px" height="18px"> -->
                                                                        <!-- <i class="fa-solid fa-pen-to-square"></i> -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                            <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                            <path 
                                                                                fill="#FFFFFF" 
                                                                                d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"/>
                                                                        </svg>
                                                                    </button>
                                                                    <button class="editButton" id="edit-text">
                                                                        <!-- <img src="assets/images/icones/ico-edit-normal@2x.png" width="18px" height="18px"> -->
                                                                        <svg 
                                                                            xmlns="http://www.w3.org/2000/svg" 
                                                                            viewBox="0 0 512 512">! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.
                                                                            <path 
                                                                                fill="#FFFFFF"
                                                                                d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/>
                                                                        </svg>   
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="search">
                                                                    <textarea 
                                                                        type="text" 
                                                                        class="editTerm" 
                                                                        placeholder="Your speech..." 
                                                                        id="orig_text" rows="5" > 
                                                                            <?php echo $value->content_langue_origine; ?> 
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="col-sm-12 details">
                                                            <div class="row container-title-speech">
                                                                <div id="txt_ttl">
                                                                    <p  class="title_text">My translation</p>
                                                                </div>
                                                                <div id="title-button-action">
                                                                    <div class="col-sm-12">
                                                                        <div class="search">
                                                                            <button class="editButton" id="copytranslate">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                    <path 
                                                                                        fill="#FFFFFF" 
                                                                                        d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"/>
                                                                                </svg>
                                                                            </button>
                                                                            <button class="editButton" id="edit-trans">
                                                                            <svg 
                                                                                xmlns="http://www.w3.org/2000/svg" 
                                                                                viewBox="0 0 512 512">! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.
                                                                                <path 
                                                                                    fill="#FFFFFF"
                                                                                    d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/>
                                                                            </svg>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="search">
                                                                    <textarea  
                                                                    type="text" 
                                                                    class="editTerm"
                                                                    placeholder="Speech translation..." 
                                                                    rows="5"
                                                                    id="transtext">
                                                                        <?php echo $value->content_langue_cible; ?> 
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div  class="line-bold col-sm-12"></div>
                                                    <div class="row rework-container" >
                                                        <p class="legende2">Original audio</p>
                                                        <div class="rework row" id="rework-btn">
                                                                <!-- <img src="assets/images/icones/ico-micro@2x.png" width="10px" height="15px"> -->
                                                                <svg 
                                                                    width="10px"
                                                                    height="15px"
                                                                    fill="#FFFFFF"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 384 512">
                                                                    <!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                    <path d="M192 352c53.03 0 96-42.97 96-96v-160c0-53.03-42.97-96-96-96s-96 42.97-96 96v160C96 309 138.1 352 192 352zM344 192C330.7 192 320 202.7 320 215.1V256c0 73.33-61.97 132.4-136.3 127.7c-66.08-4.169-119.7-66.59-119.7-132.8L64 215.1C64 202.7 53.25 192 40 192S16 202.7 16 215.1v32.15c0 89.66 63.97 169.6 152 181.7V464H128c-18.19 0-32.84 15.18-31.96 33.57C96.43 505.8 103.8 512 112 512h160c8.222 0 15.57-6.216 15.96-14.43C288.8 479.2 274.2 464 256 464h-40v-33.77C301.7 418.5 368 344.9 368 256V215.1C368 202.7 357.3 192 344 192z"/>
                                                                </svg>
                                                                <p class="reworl-label">Rework audio</p>
                                                        </div>
                                                    </div>
                                                    <div class="row col-sm-12 spectre-container">
                                                            <!-- <img src="assets/images/icones/Btn-Play@2x.png" width="20px" height="20px"  id="playBtn" title="Play / Pause"> -->
                                                        <img src="./assets/play.png" width="20px" height="20px" alt="play" id="playBtn" title="Play / Pause">
                                                        <div class="music-player">
                                                            <div class="info">
                                                                <div id="waveform"></div>
                                                                <div class="control-bar">
                                                                    <img src="./assets/stop.png" alt="stop" id="stopBtn" title="Stop" hidden>
                                                                    <img src="./assets/volume.png" alt="volume" id="volumeBtn" title="Mute / Unmute" hidden>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="waveform__duration"></div>
                                                    </div>
                                                    <div  class="line-bold col-sm-12"></div>


                                                    <div class="col-sm-12 " >
                                        <div class="row">
                                                <div><p> </p></div>
                                                
                                                <div class="row spaced">
                                                <p class="spaced"> Duration: </p>
                                                   <div class="stats" id="duration1">
                                                     <?php 
                                                                $duration_au1 = str_replace("\n"," ",$value->duree_audio);
                                                                echo $duration_au1; ?>
                                                    </div>
                                                </div>
                                                <div class="spaced row">
                                                    <p class="spaced"> Words: </p>
                                                    <div class="stats" id="id_words">00</div>
                                                </div>
                                                <div class="row spaced">
                                                   <p class="spaced"> hapaxes: </p>
                                                   <div class="stats" id="id_hapax">00</div>
                                                </div>
                                                <div class="spaced row">
                                                    <p class="spaced"> debits: </p>
                                                    <div class="stats" id="id-debits">00 words/sec</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div><p> </p></div>
                                                
                                                <div class="row spaced">
                                                <p class="spaced"> verbs: </p>
                                                   <div class="stats" id="id-verbs">00</div>
                                                </div>
                                                <div class="spaced row">
                                                    <p class="spaced"> adjectifs: </p>
                                                    <div class="stats" id="id-adj">00</div>
                                                </div>
                                                <div class="spaced row">
                                                    <button type="button">Cliquez ici2</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div><p> </p></div>
                                                
                                                <div class="row spaced">
                                                <p class="spaced"> Active voice: </p>
                                                   <div class="stats" id="id-act">00</div>
                                                </div>
                                                <div class="spaced row">
                                                    <p class="spaced"> Passive voice: </p>
                                                    <div class="stats" id="id-pass">00</div>
                                                </div>
                                            </div>
                                         <div>
                                         </div>
                                            <div id="glossaire">
                                            <center>
                                                <h1>Glossaire</h1>
                                            </center> 
                                            <center>
                                                <div id = "data-container" class="row">
                                                </div>
                                            </center> 
                                            <center>
                                                <h1>Conjugaison</h1>
                                            </center> 
                                            <div id = "conjugaison-container" class="row">
                                            </div>  
                                            <center>
                                                <h1>Phrase</h1>
                                            </center> 
                                                <div id = "sent-container" class="row">
                                                </div>
                                                <div id = "concord-container" class="row">
                                                </div>  
                                            </div> 
                                        </div>
                                                    <p class="legende obst" >Observation</p>
                                                    <div class="col-sm-12" >
                                                        <div class="search">
                                                            <textarea type="text" class="" placeholder="Observation..." id="obscontent"><?php echo $value->file_obs ?? null; ?></textarea>
                                                            <div class="editButton" hidden>
                                                            </div>
                                                            <button class="saveObs"  id="obsHandler" hidden>
                                                                <img src="assets/images/icones/save.png" width="20px" height="20px" class="img-save">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                 </div>
                                 <div hidden>
                                    <div>                                                                                     <label for="time-interval">Time Interval (milliseconds):</label>
                                        <input type="text" id="time-interval" value="1000000000">ms
                                        <br>
                                        <br> recorderType:
                                        <select id="audio-recorderType" style="font-size:22px;vertical-align: middle;margin-right: 5px;">
                                            <option>[Best Available Recorder]</option>
                                            <option>MediaRecorder API</option>
                                            <option>WebAudio API (WAV)</option>
                                            <option>WebAudio API (PCM)</option>
                                        </select>
                                        <input id="left-channel" type="checkbox" checked style="width:auto;">
                                        <label for="left-channel">Record Mono Audio if WebAudio API is selected (above)</label>
                                    </div>
                                        <!-- mimetype -->
                                    <h4>Audio bande</h4>
                                    <div class="col-sm-12 ml-4">
                                        <div><i class="fa fa-file-audio-o col-sm-12"> Audio original bande: </i></div>
                                        <div class="col-sm-12 tool-layout" id="audio-player"> 
                                            <audio controls>
                                                <source src="<?php echo base_url().'groupes/GRP'.$groupeid.'/'.$value->audio_langue_origine; ?>" type="audio/wav">
                                                    Your browser does not support the audio element.
                                            </audio> 
                                        </div>
                                        <!-- Audio -->
                                        <div><i class="fa fa-file-audio-o col-sm-12"> Other versions: </i></div>
                                        <div class="col-sm-12 tool-layout" id="audio-recorded">
                                        </div>
                                        <div id="audios-container" class="col-sm-12 tool-layout"></div>
                                        <div>
                                            <input type="text" value="<?php echo $value->id_stagiaire ;?>" id="idstag" name="id_stagiaire">
                                            </input>
                                            <input type="text" value="<?php echo $value->content_langue_origine ;?>" id="content_langue_origine" name="content_langue_origine">
                                            </input>
                                            <input type="text" value="<?php echo $value->legende_f ;?>" id="legende_f" name="legende_f">
                                            </input>
                                            <!-- <input type="text" value="<?php echo $value->id_stagiaire ;?>" id="idstag" name="id_stagiaire"> -->
                                            </input>
                                            <input type="text" value="<?php echo $value->f_name ;?>" id="vid-name" name="textboxname">
                                            </input>
                                            <input type="text" value="<?php echo $value->audio_langue_origine; ?>" id="audio-name" name="audioname">
                                            </input>
                                            <input type="text" value="<?php echo $value->id_exp ;?>" id="selectedid" name="selectedid">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="row" id="but-audio">
                                                <button class="tool-layout" id="start-recording"><i class="fa fa-microphone col-sm-12"> Start</i></button>
                                                <button class="tool-layout" id="stop-recording" disabled><i class="fa fa-stop-circle">Stop</i></button>
                                                <button id="save-recording" class="tool-layout" disabled><i class="fa fa-save">Save</i></button>
                                                <button class="tool-layout" id="mergetoaudio" disabled onClick="mergeToAudio(
                                                                                                                            '<?php echo $value->f_name ; ?>',
                                                                                                                            '<?php echo $value->f_name ; ?>',
                                                                                                                            '<?php echo $value->f_name ; ?>')"><i class="fa fa-tv">Merge</i></button>
                                                <button id="pause-recording" disabled hidden>Pause</button>
                                                <button id="resume-recording" disabled hidden>Resume</button>
                                    </div>
                                            <div class="col-sm-12 row">
                                                <div hidden>
                                                    <i class="fa fa-file-audio-o col-sm-12"> New audio</i>
                                                </div>
                                                <div hidden class="col-sm-4" >  
                                                        <audio controls>
                                                            <source src="<?php echo base_url(); ?>myvideo/11528_1614155628.wav" type="audio/wav">
                                                                Your browser does not support the audio element.
                                                        </audio> 
                                                </div>
                                            </div>
                                    </div>  
                                </div>
                                        <div class="col-sm-3 col-xs-12" id="listlabel">
                                            <p>
                                                My video Liste
                                            </p>  
                                            <input type="text" value="<?php echo $groupeid ;?>" id="mygrps" name="mygrps" hidden >
                                            </input>
                                            <div class="pb-2 mb-4 pl-4" id="mylist">
                                                <?php foreach ($videoResult as $key => $value){ ?>
                                                
                                                        <div class="col mr-4 expression-container video-layout">
                                                            <video class = "myvid" width="70px" height="20px" 
                                                            >
                                                                    <source src="<?php echo $external_FOLDER_groupe.$groupeid.'/'.$value->f_name; ?>" type="video/webm"/>
                                                            </video>
                                                            <button class="play-list-btn"
                                                                onClick="setvideo(
                                                                                    '<?php echo $value->f_name; ?>',
                                                                                    '<?php 
                                                                                    $orgtext = str_replace("\n"," ",$value->content_langue_origine);
                                                                                    echo addslashes($orgtext);  ?>',
                                                                                    '<?php 
                                                                                    $cibletext = str_replace("\n"," ",$value->content_langue_cible);
                                                                                    echo addslashes($cibletext); ?>',
                                                                                    '<?php echo $value->audio_langue_origine; ?>',
                                                                                    '<?php echo $value->audio_langue_cible; ?>',
                                                                                    '<?php 
                                                                                    $legendtext = str_replace("\n"," ",$value->legende_f);
                                                                                    echo $legendtext; ?>',
                                                                                    '<?php echo $value->id_exp; ?>',
                                                                                    '<?php echo $groupeid; ?>',
                                                                                    `<?php
                                                                                    $obtext = str_replace("\n"," ",$value->file_obs);
                                                                                    echo htmlspecialchars($obtext); ?>`,
                                                                                    `<?php
                                                                                    $date = str_replace("\n"," ",$value->date_creat);
                                                                                    echo htmlspecialchars($date); ?>`,
                                                                                      `<?php 
                                                                                    $duration_av = str_replace("\n"," ",$value->duree_audio);
                                                                                    echo $duration_av; ?>`

                                                                                    )"
                                                                >
                                                                    <img src="assets/btn-play-list@2x.png" width="24px" height="24px">
                                                                </button>
                                                            <div class="row mt-2 mb-2">
                                                                <div id="list_legend">
                                                                <?php 
                                                                $legendtext = str_replace("\n"," ",$value->legende_f);
                                                                echo $legendtext; ?>
                                                                </div>
                                                                <div class="time-list">
                                                                <?php 
                                                                $duration_au = str_replace("\n"," ",$value->duree_audio);
                                                                echo $duration_au; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                <?php } ?>
                                            </div>
                                        </div>
                                </div> 
                            </div>
                    </div>
            </div>
        </div>
    </div>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://cdn.webrtc-experiment.com/commits.js" async></script>
<script src="https://cdn.webrtc-experiment.com/common.js" async=""></script>
<script src="<?php echo base_url()?>assets/js/myvideo/myvideo_trainee.js"></script>

