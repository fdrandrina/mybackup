class WaveformPlayer {
    constructor(elementId, audioFile) {
      this.elementId = elementId;
      this.audioFile = audioFile;
      this.wavesurfer = null;
    }
  
    /**
     * Formater le temps en minutes et secondes
     * @param {*} time 
     * @returns 
     */
    formatTime(time) {
      return [
        Math.floor((time % 3600) / 60), // minutes
        ('00' + Math.floor(time % 60)).slice(-2) // secondes
      ].join(':');
    }
  
    /**
     * Initialiser wavesurfer
     */
    initialize() {
      this.wavesurfer = WaveSurfer.create({
        container: `#${this.elementId}`,
        waveColor: '#808080',
        progressColor: 'black',
        barWidth: 1,
        height: 30,
        width: 300,
        responsive: true,
        hideScrollbar: true,
        barRadius: 1
      });
      this.wavesurfer.load(this.audioFile);// Charger le fichier audio
      this.wavesurfer.on('ready', () => {
        $('.waveform__duration').text(this.formatTime(this.wavesurfer.getDuration()));
      });
    }
  
    /**
     * Changer l'URL audio, puis initialiser wavesurfer
     * @param {chemin du fichier audio} audioFile 
     */
    loadAudio(audioFile) {
      if (this.wavesurfer) {
        this.wavesurfer.destroy(); // Détruire l'instance WaveSurfer existante
      }
      this.wavesurfer = WaveSurfer.create({ // Créer une nouvelle instance WaveSurfer
        container: `#${this.elementId}`,
        waveColor: '#808080',
        progressColor: 'black',
        barWidth: 1,
        height: 30,
        width: 300,
        responsive: true,
        hideScrollbar: true,
        barRadius: 1
      });
      this.wavesurfer.load(audioFile); // Charger le nouveau fichier audio
      this.wavesurfer.on('ready', () => {
        $('.waveform__duration').text(this.formatTime(this.wavesurfer.getDuration()));
      });
    }
  
    /**
     * Lire l'audio avec wavesurfer
     */
    play() {
      if (this.wavesurfer) {
        this.wavesurfer.playPause();
      }
    }
  
    /**
     * Mettre en pause la lecture audio
     */
    pause() {
      if (this.wavesurfer) {
        this.wavesurfer.pause();
      }
    }
  }
  
  export default WaveformPlayer;
  