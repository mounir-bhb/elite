<template>
    <div>
        <div class="container">
    <div class="video-container" id="video-container">
        <div class="playback-animation" id="playback-animation">
        <svg class="playback-icons">
          <use class="hidden" href="#play-icon"></use>
          <use href="#pause"></use>
        </svg>
      </div>
      <video controls class="video" ref="video" preload="metadata" 
      @play="updatePlayButton"
      @pause="updatePlayButton"
      @click="handleVideoClick"
        @loadedmetadata="initializeVideo"
        @timeupdate="handleTime"
      >
       
      <!--@timeupdate="handleTime"
      @volumechange="updateVolumeIcon"
      
      
      @mouseenter="showControls"
      @mouseleave="hideControls" -->
        <source :src="sourse" type="video/mp4">
      </video>
      <div class="video-controls" :class="{ hidden: !videoWorks }" 
        ref="videoControls"
        @mouseenter="showControls"
        @mouseleave="hideControls"
      >
        <div class="video-progress">
            <progress id="progress-bar" :value="progressBar.value" min="0" :max="progressBar.max"></progress>
            <input class="seek" id="seek" :value="seek.value" min="0" :max="seek.max" type="range" step="0.1">
            <!-- 
                <div class="seek-tooltip" id="seek-tooltip">00:00</div>
            -->
        </div>

        <div class="bottom-controls">
          <div class="left-controls">
            <button data-title="Play (k)" id="play">
              <svg class="playback-icons">
                <use href="#play-icon"></use>
                <use class="hidden" href="#pause"></use>
              </svg>
            </button>

            <div class="volume-controls">
              <button data-title="Mute (m)" class="volume-button" id="volume-button">
                <svg>
                  <use class="hidden" href="#volume-mute"></use>
                  <use class="hidden" href="#volume-low"></use>
                  <use href="#volume-high"></use>
                </svg>
              </button>

              <input class="volume" id="volume" value="1"
              data-mute="0.5" type="range" max="1" min="0" step="0.01">
            </div>

            <div class="time">
              <time id="time-elapsed">{{ time.min }}:{{ time.s }}</time>
              <span> / </span>
              <time id="duration">{{ duration.min }}:{{ duration.s }}</time>
            </div>
          </div>

          <div class="right-controls">
            <button data-title="PIP (p)" class="pip-button" id="pip-button">
              <svg>
                <use href="#pip"></use>
              </svg>
            </button>
            <button data-title="Full screen (f)" class="fullscreen-button" id="fullscreen-button">
              <svg>
                <use href="#fullscreen"></use>
                <use href="#fullscreen-exit" class="hidden"></use>
              </svg>
            </button>
          </div>
        </div>
    </div>
    </div>
        <svg style="display: none">
    <defs>
      <symbol id="pause" viewBox="0 0 24 24">
        <path d="M14.016 5.016h3.984v13.969h-3.984v-13.969zM6 18.984v-13.969h3.984v13.969h-3.984z"></path>
      </symbol>

      <symbol id="play-icon" viewBox="0 0 24 24">
        <path d="M8.016 5.016l10.969 6.984-10.969 6.984v-13.969z"></path>
      </symbol>

      <symbol id="volume-high" viewBox="0 0 24 24">
      <path d="M14.016 3.234q3.047 0.656 5.016 3.117t1.969 5.648-1.969 5.648-5.016 3.117v-2.063q2.203-0.656 3.586-2.484t1.383-4.219-1.383-4.219-3.586-2.484v-2.063zM16.5 12q0 2.813-2.484 4.031v-8.063q1.031 0.516 1.758 1.688t0.727 2.344zM3 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6z"></path>
      </symbol>

      <symbol id="volume-low" viewBox="0 0 24 24">
      <path d="M5.016 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6zM18.516 12q0 2.766-2.531 4.031v-8.063q1.031 0.516 1.781 1.711t0.75 2.32z"></path>
      </symbol>

      <symbol id="volume-mute" viewBox="0 0 24 24">
      <path d="M12 3.984v4.219l-2.109-2.109zM4.266 3l16.734 16.734-1.266 1.266-2.063-2.063q-1.547 1.313-3.656 1.828v-2.063q1.172-0.328 2.25-1.172l-4.266-4.266v6.75l-5.016-5.016h-3.984v-6h4.734l-4.734-4.734zM18.984 12q0-2.391-1.383-4.219t-3.586-2.484v-2.063q3.047 0.656 5.016 3.117t1.969 5.648q0 2.203-1.031 4.172l-1.5-1.547q0.516-1.266 0.516-2.625zM16.5 12q0 0.422-0.047 0.609l-2.438-2.438v-2.203q1.031 0.516 1.758 1.688t0.727 2.344z"></path>
      </symbol>

      <symbol id="fullscreen" viewBox="0 0 24 24">
      <path d="M14.016 5.016h4.969v4.969h-1.969v-3h-3v-1.969zM17.016 17.016v-3h1.969v4.969h-4.969v-1.969h3zM5.016 9.984v-4.969h4.969v1.969h-3v3h-1.969zM6.984 14.016v3h3v1.969h-4.969v-4.969h1.969z"></path>
      </symbol>

      <symbol id="fullscreen-exit" viewBox="0 0 24 24">
      <path d="M15.984 8.016h3v1.969h-4.969v-4.969h1.969v3zM14.016 18.984v-4.969h4.969v1.969h-3v3h-1.969zM8.016 8.016v-3h1.969v4.969h-4.969v-1.969h3zM5.016 15.984v-1.969h4.969v4.969h-1.969v-3h-3z"></path>
      </symbol>

      <symbol id="pip" viewBox="0 0 24 24">
      <path d="M21 19.031v-14.063h-18v14.063h18zM23.016 18.984q0 0.797-0.609 1.406t-1.406 0.609h-18q-0.797 0-1.406-0.609t-0.609-1.406v-14.016q0-0.797 0.609-1.383t1.406-0.586h18q0.797 0 1.406 0.586t0.609 1.383v14.016zM18.984 11.016v6h-7.969v-6h7.969z"></path>
      </symbol>
    </defs>
  </svg>
        <!-- Custom controls are defined here -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: ['sourse'],
    data() {
        return {
            videoWorks: false,
            video: null,
            videoControls: null,
            volume: null,
            duration: {
                s: null,
                min: null
            },
            time: {
                s: '00',
                min: '00'
            },
            seek: {
                value: 0,
                max: null
            },
            progressBar: {
                value: 0,
                max: null
            },
        };
    },
    mounted() {
        this.video = this.$refs.video;
        this.videoControls = this.$refs.videoControls;
        
  
        this.videoWorks = !!document.createElement('video').canPlayType;
  
        if (this.videoWorks) {
            this.video.controls = false;
            this.videoControls.classList.remove('hidden');
        }
        this.video.addEventListener('mousemove', this.updateSeekTooltip);
        this.video.addEventListener('input', this.skipAhead);
        this.videoControls.addEventListener('input', this.skipAhead);
        /* this.$refs.video.volume.addEventListener('input', this.updateVolume);
        this.$refs.video.volumeButton.addEventListener('click', this.toggleMute);
        this.$refs.video.fullscreenButton.addEventListener('click', this.toggleFullScreen);
        this.$refs.video.videoContainer.addEventListener('fullscreenchange', this.updateFullscreenButton);
        this.$refs.video.pipButton.addEventListener('click', this.togglePip); */

        document.addEventListener('DOMContentLoaded', () => {
            if (!('pictureInPictureEnabled' in document)) {
                this.$refs.pipButton.classList.add('hidden');
            }
        });
            document.addEventListener('keyup', this.keyboardShortcuts);
        },
        methods: {
            handleVideoClick() {
                this.togglePlay();
                this.animatePlayback();
            },
            handleTime(){
                this.updateTimeElapsed()
                this.updateProgress()
            },
            togglePlay() {
                const video = this.$refs.video;
                if (video.paused || video.ended) {
                    video.play();
                } else {
                    video.pause();
                }
            },
            updatePlayButton() {
                /* playbackIcons.forEach((icon) => icon.classList.toggle('hidden'));

                if (video.paused) {
                  playButton.setAttribute('data-title', 'Play (k)');
                } else {
                  playButton.setAttribute('data-title', 'Pause (k)');
                } */
            },
            formatTime(timeInSeconds) {
                const result = new Date(timeInSeconds * 1000).toISOString().substr(11, 8);

                return {
                  minutes: result.substr(3, 2),
                  seconds: result.substr(6, 2),
                };
            },
    initializeVideo() {
        /* const videoDuration = Math.round(this.$refs.video.duration);
        seek.setAttribute('max', videoDuration);
        progressBar.setAttribute('max', videoDuration);
        const time = formatTime(videoDuration);
        duration.innerText = `${time.minutes}:${time.seconds}`;
        duration.setAttribute('datetime', `${time.minutes}m ${time.seconds}s`) */
        const videoDuration = Math.round(this.$refs.video.duration);
        
        //this.duration= Math.round(this.$refs.video.duration);
        this.seek.max= videoDuration;
        this.progressBar.max= videoDuration;
        const time = this.formatTime(videoDuration);
        this.duration.min= time.minutes;
        this.duration.s= time.seconds
        /* const time = formatTime(this.duration);
        duration.innerText = `${time.minutes}:${time.seconds}`;
        duration.setAttribute('datetime', `${time.minutes}m ${time.seconds}s`) */
    },
    updateTimeElapsed() {
         const time = this.formatTime(Math.round(this.$refs.video.currentTime));
        /*timeElapsed.innerText = `${time.minutes}:${time.seconds}`;
        timeElapsed.setAttribute('datetime', `${time.minutes}m ${time.seconds}s`) */
        this.time.s = time.seconds;
        this.time.min= time.minutes
    },
    updateProgress() {
        this.seek.value = Math.floor(this.$refs.video.currentTime);
        this.progressBar.value = Math.floor(this.$refs.video.currentTime);
        
    },
    updateSeekTooltip(event) {
        /* const skipTo = Math.round((event.offsetX / event.target.clientWidth) * parseInt(event.target.getAttribute('max'), 10));
        seek.setAttribute('data-seek', skipTo)
        const t = this.formatTime(skipTo);
        seekTooltip.textContent = `${t.minutes}:${t.seconds}`;
        const rect = this.$refs.video.getBoundingClientRect();
        seekTooltip.style.left = `${event.pageX - rect.left}px`; */
    },
    skipAhead(event) {
        
        /* const skipTo = event.target.value;
        this.$refs.video.currentTime = skipTo;
        console.log( this.$refs.video.currentTime + '++++'+ skipTo );
        this.progressBar.value = skipTo;
        this.seek.value = skipTo; */
        this.$refs.video.currentTime= 123
        console.log( this.$refs.video.readyState+'++++++++'+this.$refs.video.currentTime );
    },
    updateVolume() {
        if (this.$refs.video.muted) {
        video.muted = false;
    }

  this.$refs.video.volume = volume.value;
    },
    updateVolumeIcon() {
        /* volumeIcons.forEach(icon => {
    icon.classList.add('hidden');
  });

  volumeButton.setAttribute('data-title', 'Mute (m)')

  if (this.$refs.video.muted || this.$refs.video.volume === 0) {
    volumeMute.classList.remove('hidden');
    volumeButton.setAttribute('data-title', 'Unmute (m)')
  } else if (this.$refs.video.volume > 0 && this.$refs.video.volume <= 0.5) {
    volumeLow.classList.remove('hidden');
  } else {
    volumeHigh.classList.remove('hidden');
  } */
    },
    toggleMute() {
        /* this.$refs.video.muted = !this.$refs.video.muted;

if (this.$refs.video.muted) {
  volume.setAttribute('data-volume', this.$refs.volume.value);
  volume.value = 0;
} else {
  volume.value = volume.dataset.volume;
} */
    },
    animatePlayback() {
        /* playbackAnimation.animate([
            {
                opacity: 1,
                transform: "scale(1)",
            },
            {
                opacity: 0,
                transform: "scale(1.3)",
            }], {
                duration: 500,
        }); */
    },
    toggleFullScreen() {
        /* if (document.fullscreenElement) {
    document.exitFullscreen();
  } else if (document.webkitFullscreenElement) {
    // Need this to support Safari
    document.webkitExitFullscreen();
  } else if (videoContainer.webkitRequestFullscreen) {
    // Need this to support Safari
    videoContainer.webkitRequestFullscreen();
  } else {
    videoContainer.requestFullscreen();
  } */
    },
    updateFullscreenButton() {
        /* fullscreenIcons.forEach(icon => icon.classList.toggle('hidden'));

if (document.fullscreenElement) {
  fullscreenButton.setAttribute('data-title', 'Exit full screen (f)')
} else {
    fullscreenButton.setAttribute('data-title', 'Full screen (f)')
  } */
    },
    async togglePip() {
       /*  try {
    if (this.$refs.video !== document.pictureInPictureElement) {
      pipButton.disabled = true;
      await this.$refs.video.requestPictureInPicture();
    } else {
      await document.exitPictureInPicture();
    }
  } catch (error) {
    console.error(error)
  } finally {
    pipButton.disabled = false;
  } */
    },
    hideControls() {
        /* if (this.$refs.video.paused) {
    return;
  }

  videoControls.classList.add('hide'); */
    },
    showControls() {
      // ... other code
      /* videoControls.classList.remove('hide'); */
    },
    keyboardShortcuts(event) {
        /* const { key } = event;
  switch(key) {
    case 'k':
      togglePlay();
      animatePlayback();
      if (this.$refs.video.paused) {
        showControls();
      } else {
        setTimeout(() => {
          hideControls();
        }, 2000);
      }
      break;
    case 'm':
      toggleMute();
      break;
    case 'f':
      toggleFullScreen();
      break;
    case 'p':
      togglePip();
      break;
  } */
    }

        }
    }
  </script>
  
  <style>
        :root {
  --youtube-red: #FE0900;
}

html {
  box-sizing: border-box;
  font-family: "YouTube Noto",Roboto,Arial,Helvetica,sans-serif;
  height: 100%;
}

*, *::before, *::after {
  box-sizing: inherit;
  margin: 0;
  padding: 0;
}

body {
  height: 100%;
}

.container {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.video-container {
  width: 800px;
  border-radius: 4px;
  margin: 0 auto;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

video {
  width: 100%;
  height: 100%;
  border-radius: 4px;
}

.video-controls {
  right: 0;
  left: 0;
  padding: 10px;
  position: absolute;
  bottom: 0;
  transition: all 0.2s ease;
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
}

.video-controls.hide {
  opacity: 0;
  pointer-events: none;
}

.video-progress {
  position: relative;
  height: 8.4px;
  margin-bottom: 10px;
}

progress {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border-radius: 2px;
  width: 100%;
  height: 8.4px;
  pointer-events: none;
  position: absolute;
  top: 0;
}

progress::-webkit-progress-bar {
  background-color: #474545;
  border-radius: 2px;
}

progress::-webkit-progress-value {
  background: var(--youtube-red);
  border-radius: 2px;
}

progress::-moz-progress-bar {
  border: 1px solid var(--youtube-red);
  background: var(--youtube-red);
}

.seek {
  position: absolute;
  top: 0;
  width: 100%;
  cursor: pointer;
  margin: 0;
}

.seek:hover+.seek-tooltip {
  display: block;
}

.seek-tooltip {
  display: none;
  position: absolute;
  top: -50px;
  margin-left: -20px;
  font-size: 12px;
  padding: 3px;
  content: attr(data-title);
  font-weight: bold;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.6);
}

.bottom-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.left-controls {
  display: flex;
  align-items: center;
  color: #fff;
}

.volume-controls {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.volume-controls input {
  width: 100px;
  opacity: 1;
  transition: all 0.4s ease;
}

.volume-controls:hover input, .volume-controls input:focus {
  width: 100px;
  opacity: 1;
}

button {
  cursor: pointer;
  position: relative;
  margin-right: 7px;
  font-size: 12px;
  padding: 3px;
  border: none;
  outline: none;
  background-color: transparent;
}

button * {
  pointer-events: none;
}

button::before {
  content: attr(data-title);
  position: absolute;
  display: none;
  right: 0;
  top: -50px;
  background-color: rgba(0, 0, 0, 0.6);
  color: #fff;
  font-weight: bold;
  padding: 4px 6px;
  word-break: keep-all;
  white-space: pre;
}

button:hover::before {
  display: inline-block;
}

.fullscreen-button {
  margin-right: 0;
}

.pip-button svg {
  width: 26px;
  height: 26px;
}

.playback-animation {
  pointer-events: none;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -40px;
  margin-top: -40px;
  width: 80px;
  height: 80px;
  border-radius: 80px;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
}

input[type=range] {
  -webkit-appearance: none;
  -moz-appearance: none;
  height: 8.4px;
  background: transparent;
  cursor: pointer;
}

input[type=range]:focus {
  outline: none;
}

input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  cursor: pointer;
  border-radius: 1.3px;
  -webkit-appearance: none;
  transition: all 0.4s ease;
}

input[type=range]::-webkit-slider-thumb {
  height: 16px;
  width: 16px;
  border-radius: 16px;
  background: var(--youtube-red);
  cursor: pointer;
  -webkit-appearance: none;
  margin-left: -1px;
}

input[type=range]:focus::-webkit-slider-runnable-track {
  background: transparent;
}

input[type=range].volume {
  height: 5px;
  background-color: #fff;
}

input[type=range].volume::-webkit-slider-runnable-track {
  background-color: transparent;
}

input[type=range].volume::-webkit-slider-thumb {
  margin-left: 0;
  height: 14px;
  width: 14px;
  background: #fff;
}

input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  border: 1px solid transparent;
  background: transparent;
  border-radius: 1.3px;
}

input[type=range]::-moz-range-thumb {
  height: 14px;
  width: 14px;
  border-radius: 50px;
  border: 1px solid var(--youtube-red);
  background: var(--youtube-red);
  cursor: pointer;
  margin-top: 5px;
}

input[type=range]:focus::-moz-range-track {
  outline: none;
}

input[type=range].volume::-moz-range-thumb {
  border: 1px solid #fff;
  background: #fff;
}

.hidden {
  display: none;
}

svg {
  width: 28px;
  height: 28px;
  fill: #fff;
  stroke: #fff;
  cursor: pointer;
}
  </style>
  