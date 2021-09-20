<div class="content">
   <div class="title m-b-md">
       Video Chat Rooms
   </div>

   {!! Form::open(['url' => 'room/create']) !!}
       {!! Form::label('roomName', 'Create or Join a Video Chat Room') !!}
       {!! Form::text('roomName','test_room') !!}
       {!! Form::submit('Go') !!}
   {!! Form::close() !!}

   @if($rooms)
   @foreach ($rooms as $room)
       <a href="{{ url('/room/join/'.$room) }}">{{ $room }}</a>
   @endforeach
   @endif
</div>