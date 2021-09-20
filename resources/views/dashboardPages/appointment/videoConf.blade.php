@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')	
<style>
	.video-call{
		display: flex;
    height: 100%;
    width: 100%;
    position: relative;
        position: relative;
    flex-direction: column;
    padding-bottom: 50px;
	}
	.video-call video{
		display: block;
	}
	.media-controller{
		    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
	}
	#media-div{
		    width: 100%;
    height: 100%;
    position: relative;;
	}
	.video-remote{
		position: relative;
    margin: 0;
    height: 100%;
    width: 100%;
	}
	.video_local {
    position: absolute;
    right: 10px;
    bottom: 70px;
    width: 200px;
    z-index: 2;
}
.video_local .video{
	min-width: 125px !important;
	max-width: 100% !important;
}
</style>
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					<span>Prescreening Counsult</span>
				</div>
				<div class="card">
					<div class="card-body p-lg-5">
						<div class="row">
							<div class="col-md-8">
							   

								<div class="video-call" id="media-wrap">
									<div id="media-controller" class="media-controller"></div>
									<!-- <div class="video-body">
										<img src="{{url('assets/images/chat.png')}}">
										<div class="chat-thumb">
											<img src="{{url('assets/images/chat-thumb.png')}}">
										</div>
									</div> -->
									<!-- <div id="media-div">
							    	</div>
									<div class="video-controls">
										<button type="button" class="btn btn-danger"><i class="material-icons-outlined">mic_none</i></button>
										<button type="button" class="btn btn-success"><i class="material-icons-outlined">call</i></button>
										<button type="button" class="btn btn-primary"><i class="material-icons-outlined">videocam</i></button>
										<button type="button" class="btn btn-danger"><i class="material-icons-outlined">call_end</i></button>
									</div> -->
								</div>
							</div>
							<div class="col-md-4">
								<div class="card">
										<div class="card-body">
											<div class="media align-items-center">
												<div class="media-thumb xl rounded-circle border mr-3">
													<a href="{{url('/dashboard/patient/view')}}/{{$patient->id}}" target="__blank">
													@if($patient->image != "")
													<img src="{{Auth::user()->image}}">
													@else
													<img src="{{url('assets/avatar.jpg')}}">
													@endif
													</a>
												</div>
												<div class="media-body">
													<p class="mb-0 fw-500 lead">
														<a href="{{url('/dashboard/patient/view')}}/{{$patient->id}}" target="__blank">
														{{ucfirst($patient->firstname)}} {{ucfirst($patient->lastname)}}
														</a>
													</p>
													<div>{{date_format(date_create($patient->dob),"d M, Y")}} ({{date("Y") - date_format(date_create($patient->dob),"Y") }} Yr)</div>
													<div>{{((isset($patient->sex) && $patient->sex == '1') ? 'Male' : 'Female')}}, {{$patient->contact}}</div>
												</div>

												@if(Session::has('msg'))
												    <div class="alert alert-warning alert-dismissible fade show" role="alert">
												      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												        <span aria-hidden="true">&times;</span>
												      </button>
												      {{ Session::get('msg') }}
												    </div>
												@endif
											</div>
										</div>
									</div>
								@if(Auth::user()->role != "2")
								<form action="" method="POST">
									@csrf
									<div id="accordion" class="accordion">
				                        <div class="accordion-block">
				                        	<button type="button" class="btn" data-toggle="collapse" data-target="#five" aria-expanded="false" style="background-color: #FBCDF9;">Additional Notes</button>
					                        <div id="five" class="collapse" data-parent="#accordion">
					                        	<div class="accordion-content">
				                                	<p class="mb-0"><b>Today Notes</b></p>
					                            </div>
					                            <textarea class="form-control" rows="5" id="today_notes"></textarea>
					                        </div>
					                    </div>
					                </div>
					                <div class="mt-3 text-right">
										<button type="button" class="btn btn-orange btn-wide" id="update_Notes_Block">Update</button>
									</div>
								</form>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
@section('script')
<script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
<script>
	var Room;
    Twilio.Video.createLocalTracks({
       audio: true,
       video: { width: 300 }
    }).then(function(localTracks) {
       return Twilio.Video.connect('{{ $accessToken }}', {
           name: '{{ $roomName }}',
           tracks: localTracks,
           video: { width: 300 }
       });
    }).then(function(room) {
       console.log('Successfully joined a Room: ', room.name);
       Room = room; // Assign Room Object
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
	   div.className = 'video_'+type;

	   div.setAttribute("style", "");
	   div.innerHTML = "<div style='clear:both;display:none'>" +participant.identity+ "</div>";

	   participant.tracks.forEach(function(track) {
	       trackAdded(div, track)
	   });

	   participant.on('trackAdded', function(track) {
	       trackAdded(div, track)
	   });
	   participant.on('trackRemoved', trackRemoved);

	   document.getElementById('media-wrap').appendChild(div);
	    var html_contr = '<div class="video-controls">';
		html_contr += '	<button type="button" class="btn btn-primary call_mute_unmute"><i class="material-icons-outlined">mic_none</i></button>';
		//html_contr += '	<button type="button" class="btn btn-success"><i class="material-icons-outlined">call</i></button>';
		html_contr += '	<button type="button" class="btn btn-primary mute-videoChat"><i class="material-icons-outlined">videocam</i></button>';
		html_contr += '	<button type="button" class="btn btn-danger call_end"><i class="material-icons-outlined">call_end</i></button>';
		html_contr += '</div>';
		if(!$('#media-wrap #media-controller .video-controls').length){
			$('#media-wrap #media-controller').html(html_contr);
		}
		// document.getElementById('media-div').appendChild(html_contr);
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
	       video.setAttribute("style", "width:100%;");
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

	$(document).ready(function(){
		$(document).on('click','.call_end',function(){
			window.location = '{{route("Dashboard.AppointmentList")}}';
		});

		$(document).on('click','.call_mute_unmute',function(){

			// if (Room.localParticipant.media.isMuted === false) {        
		 //        // $scope.isMuted = true;        
		 //        Room.localParticipant.media.mute();
		 //    } else {
		 //        // $scope.isMuted = false;
		 //        Room.localParticipant.media.unmute();
		 //    }

		    if($(this).hasClass('mute')){
				$(this).removeClass('mute');
				//
				$(this).removeClass('btn-danger');
				$(this).addClass('btn-primary');

				// Room.localParticipant.tracks.forEach(function(track) {
	 		// 	  track.enable(); 
	 		//     });
			}else{
				$(this).addClass('mute');
				//
				$(this).removeClass('btn-primary');
				$(this).addClass('btn-danger');

				// Room.localParticipant.tracks.forEach(function(track) {
	 		// 	  track.disable(); 
	 		//     });
			}
		})

		// Hide-Show Video
		$(document).on('click','.mute-videoChat', function(){
			if($(this).hasClass('muteVC')){
				$(this).removeClass('muteVC');
				//
				$(this).removeClass('btn-danger');
				$(this).addClass('btn-primary');
				Room.localParticipant.tracks.forEach(function(track) {
	 			  track.enable(); 
	 		    });
			}else{
				$(this).addClass('muteVC');
				//
				$(this).removeClass('btn-primary');
				$(this).addClass('btn-danger');
				Room.localParticipant.tracks.forEach(function(track) {
	 			  track.disable(); 
	 		    });
			}
		});

		$(document).on('click','#update_Notes_Block',function(){
			var notes = $('#today_notes').val();
			$.ajax({
	          url:"{{ route('Dashboard.Patient.addNoteViaCall') }}",
	          method:"GET",
	          data:{title:"discussion_{{ $roomName }}",notes:notes,patient_id:'{{$patient->id}}'},
	          success:function(data){
	           	// swal("Un-Assigned!", "Un-Assigned Investigator Successfully.", "success"); 
	           	swal({
		            title: "Updated!",
		            text: "Notes has been updated Successfully.",
		            type: "success"
		        }, function() {
		            console.log('success');
		        });
	          }
	        });
		});
	})
</script>
@endsection




<!-- Room.localParticipant.tracks.forEach(function(track) {
 track.enable(); 
}); -->

<!-- Room.localParticipant.audioTrackPublications.forEach((publication) => { 
    publication.track.disable(); 
}); -->