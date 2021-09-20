@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
    <div class="p-3 p-md-4">
        <div class="wrapper">
            <div class="wrapper-title">
                <span>Search Result</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-xl-2 container1">
                        @if(Session::has('msg'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              {{ Session::get('msg') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive rounded1 shadow1">
                                    <table class="table table-rounded" id="triallist">
                                        <thead class="thead-blue">
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Study Title</th>
                                                <th>Conditions</th>
                                                <th>Interventions</th>
                                                <th>Locations</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count=0; ?>
                                            @foreach ($response as $res)

                                            <?php $count++; ?>
                                            @if($search_type == '1')
                                              <tr>
                                                <td>{{$res->Rank}}</td>
                                                <td>{{$res->OverallStatus[0]}}</td>
                                                <td><a href="/dashboard/findclinicaltrial/details?nctid={{$res->NCTId[0]}}&country={{$country}}&state={{$state}}&con={{$con}}&id3={{$city}}&no={{$res->Rank}}">{{$res->BriefTitle[0]}}</a>
                                                </td>
                                                <td>
                                                  <?php for($i=0;$i<sizeof($res->Condition);$i++)
                                                    {
                                                      echo $res->Condition[$i]."<br>";
                                                    }
                                                      ?>
                                                </td>
                                                <td>
                                                  <?php for($i=0;$i<sizeof($res->InterventionName);$i++)
                                                    {
                                                      echo $res->InterventionName[$i]."<br>";
                                                    }
                                                      ?>
                                                </td>
                                                <td>
                                                  {{isset($res->LocationCity[0])?$res->LocationCity[0]:''}} {{isset($res->LocationCountry[0])?','.$res->LocationCountry[0]:''}}
                                                </td>
                                                <td>
                                                     <form method="POST" action="{{route('Dashboard.saveTrial')}}">
                                                        @csrf
                                                        <input type="hidden" name="trail_info" value="{{json_encode($res)}}">
                                                        <input type="hidden" name="trail_type" value="{{$search_type}}">
                                                        <button type="submit" class="btn btn-secondary btn-sm py-2" style="color:white;">Save Trial</button>
                                                    </form>
                                                </td>
                                              </tr>
                                               @else
                                                  <tr>
                                                    <td>{{$count}}</td>
                                                    <td>{{($res['status'] == '1' ? 'Active' : 'Deactive')}}</td>
                                                    <td><a href="{{url('/dashboard/findInternalStudyDetails/details/')}}/{{$res['id']}}">{{$res['trial']}}</a></td>
                                                    <td>{{$res['summary']}}</td>
                                                    <td>{{App\User::find($res['principal_inv'])->getFullNameAttribute()}}</td>
                                                    <td>{{$res['address']}} {{$res['city']}} {{$res['state']}}</td>
                                                    <td><form method="POST" action="{{route('Dashboard.saveTrial')}}">
                                                        @csrf
                                                        <input type="hidden" name="trail_info" value="{{json_encode($res)}}">
                                                        <input type="hidden" name="trail_type" value="{{$search_type}}">
                                                        <button type="submit" class="btn btn-secondary btn-sm py-2" style="color:white;">Save Trial</button>
                                                    </form></td>
                                                  </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- <div class="text-center mb-5">
                                    	<button type="button" class="btn btn-orange px-5">Show More</button>
                                    </div> -->
                                </div>
                    		</div>
                    	</div>
                    </div>
	            </div>
           </div>
        </div>
    </div>
    </main>

<!-- </div> -->
@endsection

@section('script')
<script>
$(document).ready( function () {
  $('#triallist').DataTable();
});
</script>
@endsection