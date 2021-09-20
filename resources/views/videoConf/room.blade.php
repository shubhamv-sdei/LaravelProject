<html>
<head>
	<script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
</head>
<body>
<div class="content">
   <div class="title m-b-md">
       Video Chat Rooms
   </div>

   <div id="media-div">
   </div>
</div>
</body>
</html>


<script>
    Twilio.Video.createLocalTracks({
       audio: true,
       video: { width: 400 }
    }).then(function(localTracks) {
       return Twilio.Video.connect('{{ $accessToken }}', {
           name: '{{ $roomName }}',
           tracks: localTracks,
           video: { width: 400 }
       });
    }).then(function(room) {
       console.log('Successfully joined a Room: ', room.name);

       room.participants.forEach(participantConnected);

       var previewContainer = document.getElementById(room.localParticipant.sid);
       if (!previewContainer || !previewContainer.querySelector('video')) {
           participantConnected(room.localParticipant,'local');
       }

       room.on('participantConnected', function(participant) {
           console.log("Joining: '"+   participant.identity   +"'");
           participantConnected(participant,'remort');
       });

       room.on('participantDisconnected', function(participant) {
            console.log("Disconnected: '"+   participant.identity   +"'");
            participantDisconnected(participant);
        });
    }).catch( function(err) {
        console.log('kjk',err);
    });
    // additional functions will be added after this point

    function participantConnected(participant,type) {
	   console.log('Participant "%s" connected', participant.identity);

	   const div = document.createElement('div');
	   div.id = participant.sid;
	   div.class = "video_";
	   div.setAttribute("style", "float: left; margin: 10px;");
	   div.innerHTML = "<div style='clear:both'>" +participant.identity+ "</div>";

	   participant.tracks.forEach(function(track) {
	       trackAdded(div, track)
	   });

	   participant.on('trackAdded', function(track) {
	       trackAdded(div, track)
	   });
	   participant.on('trackRemoved', trackRemoved);

	   document.getElementById('media-div').appendChild(div);
	}

	function participantDisconnected(participant) {
	   console.log('Participant "%s" disconnected', participant.identity);

	   participant.tracks.forEach(trackRemoved);
	   document.getElementById(participant.sid).remove();
	}

	function trackAdded(div, track) {
	   div.appendChild(track.attach());
	   var video = div.getElementsByTagName("video")[0];
	   if (video) {
	       video.setAttribute("style", "max-width:400px;");
	   }
	}

	function trackRemoved(track) {
	   track.detach().forEach( function(element) { element.remove() });
	}

	function makeMute(){
		Twilio.Device.activeConnection().mute(true);
	}

	function makeUnMute(){
		Twilio.Device.activeConnection().mute(false);
	}
</script>