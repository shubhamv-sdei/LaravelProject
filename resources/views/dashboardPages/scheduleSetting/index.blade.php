@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
	<style>
		i.form-icon {
		    display: none;
		}
	</style>
	<div class="content-wrapper">
		<div class="p-3 p-md-4">
			<div class="wrapper">
				<div class="wrapper-title">
					@if(Session::has('msg'))
					    <div class="alert alert-warning alert-dismissible fade show" role="alert">
					      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					        <span aria-hidden="true">&times;</span>
					      </button>
					      {{ Session::get('msg') }}
					    </div>
					@endif
					<span>Schedule Setting</span>
				</div>
				<div class="card">
					<div class="card-body">
					<form action="{{route('Dashboard.addSchedule')}}" method="POST">
						@csrf
						<div class="table-responsive">
	                        <table class="table table-bordered table-rounded">
	                            <thead class="thead-blue text-center">
	                                <tr>
	                                    <th>Day</th>
	                                    <th>Starts at</th>
	                                    <th>Ends at</th>
	                                    <th></th>
	                                </tr>
	                            </thead>
	                            <tbody class="align-middle th-blue">
	                            	@foreach($data['Monday'] as $key=>$value)
	                            	@if($key == 0)
		                                <tr class="Monday Monday_1">
		                                	<input type="hidden" name="Monday_1_id" value="{{$value['id']}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Monday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Monday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Monday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="addRow('Monday')">
		                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach

	                                @foreach($data['Monday'] as $key=>$value)
	                            	@if($key != 0)
		                                <tr class="Monday Monday_{{$key+1}}">
		                                	<input type="hidden" name="Monday_{{$key+1}}_id" value="{{$value['id']}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Monday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Monday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Monday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Monday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach

	                                @foreach($data['Tuesday'] as $key=>$value)
	                            	@if($key == 0)
	                                <tr class="Tuesday Tuesday_1">
	                                	<input type="hidden" name="Tuesday_1_id" value="{{$value['id']}}">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Tuesday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Tuesday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Tuesday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Tuesday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Tuesday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Tuesday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Tuesday Tuesday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Tuesday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Tuesday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Tuesday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Tuesday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach

	                                @foreach($data['Wednesday'] as $key=>$value)
	                            	@if($key == 0)
	                            	<input type="hidden" name="Wednesday_1_id" value="{{$value['id']}}">
	                                <tr class="Wednesday Wednesday_1">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Wednesday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Wednesday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Wednesday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Wednesday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Wednesday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Wednesday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Wednesday Wednesday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Wednesday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Wednesday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Wednesday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Wednesday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach


	                                @foreach($data['Thursday'] as $key=>$value)
	                            	@if($key == 0)
	                            	<input type="hidden" name="Thursday_1_id" value="{{$value['id']}}">
	                                <tr class="Thursday Thursday_1">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Thursday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Thursday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Thursday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Thursday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Thursday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Thursday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Thursday Thursday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Thursday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Thursday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Thursday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Thursday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach


	                                @foreach($data['Friday'] as $key=>$value)
	                            	@if($key == 0)
	                            	<input type="hidden" name="Friday_1_id" value="{{$value['id']}}">
	                                <tr class="Friday Friday_1">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Friday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Friday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Friday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Friday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Friday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Friday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Friday Friday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Friday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Friday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Friday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Friday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach


	                                @foreach($data['Saturday'] as $key=>$value)
	                            	@if($key == 0)
	                            	<input type="hidden" name="Saturday_1_id" value="{{$value['id']}}">
	                                <tr class="Saturday Saturday_1">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Saturday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Saturday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Saturday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Saturday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Saturday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Saturday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Saturday Saturday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Saturday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Saturday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Saturday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Saturday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach


	                                @foreach($data['Sunday'] as $key=>$value)
	                            	@if($key == 0)
	                            	<input type="hidden" name="Sunday_{{$key+1}}_id" value="{{$value['id']}}">
	                                <tr class="Sunday Sunday_1">
	                                    <th>
	                                    	<div class="custom-checkbox">
	                                            <div class="checkbox">
	                                                <label class="mb-0">
	                                                    <input type="checkbox" class="form-check-input" name="day">
	                                                    <i class="form-icon"></i>Sunday
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </th>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="date" class="form-control" name="Sunday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
                            				</div>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group input-group-inner">
	                                        	<input type="time" class="form-control" name="Sunday_date[]" value="{{$value['time']}}" placeholder="17:00">
                            				</div>
	                                    </td>
	                                    <td class="action text-center">
	                                    	<button type="button" class="btn" onclick="addRow('Sunday')">
	                                    		<i class="material-icons-outlined text-primary">add_circle_outline</i>
	                                    	</button>
	                                    </td>
	                                </tr>
	                                @endif
	                                @endforeach

	                                @foreach($data['Sunday'] as $key=>$value)
	                            	@if($key != 0)
	                            		<input type="hidden" name="Sunday_{{$key+1}}_id" value="{{$value['id']}}">
		                                <tr class="Sunday Sunday_{{$key+1}}">
		                                    <th>
		                                    	<div class="custom-checkbox">
		                                            <div class="checkbox">
		                                                <label class="mb-0">
		                                                    <input type="checkbox" class="form-check-input" name="day">
		                                                    <i class="form-icon"></i>Sunday
		                                                </label>
		                                            </div>
		                                        </div>
		                                    </th>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="date" class="form-control" name="Sunday_date[]" value="{{$value['date']}}" placeholder="24hrs formate">
	                            				</div>
		                                    </td>
		                                    <td>
		                                    	<div class="input-group input-group-inner">
		                                        	<input type="time" class="form-control" name="Sunday_time[]" value="{{$value['time']}}" placeholder="17:00">
	                            				</div>
		                                    </td>
		                                    <td class="action text-center">
		                                    	<button type="button" class="btn" onclick="removeRow('Sunday',{{$key+1}})">
		                                    		<i class="material-icons-outlined text-danger">remove_circle_outline</i>
		                                    	</button>
		                                    </td>
		                                </tr>
		                            @endif
	                                @endforeach

	                            </tbody>
	                        </table>
	                    </div>
	                    <div class="text-center">
	                    	<button type="submit" class="btn btn-orange btn-wide">Save</button>
	                    </div>
	                </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('script')
<script>
	function addRow(block){
		var blockDiv = $('.'+block).length + 1;
		console.log(blockDiv);
		console.log(block);
		var html = '';
		html += '<tr class="'+block+' '+block+'_'+blockDiv+'">';
        html += '<th>';
        html += '<div class="custom-checkbox">';
        html += '<div class="checkbox">';
        html += '<label class="mb-0">';
        html += '<input type="checkbox" class="form-check-input" name="day">';
		html += '<i class="form-icon"></i>'+block+'';
        html += '</label>';
        html += '</div>';
        html += '</div>';
        html += '</th>';
        html += '<td>';
        html += '<div class="input-group input-group-inner">';
        html += '<input type="date" class="form-control" name="'+block+'_date[]" placeholder="24hrs formate">';
        // html += '<div class="input-group-append">';
        // html += '<button type="button" class="input-group-text">';
        // html += '<i class="material-icons-outlined">schedule</i>';
        // html += '</button>';
        // html += '</div>';
		html += '</div>';
        html += '</td>';
        html += '<td>';
        html += '<div class="input-group input-group-inner">';
        html += '<input type="time" class="form-control" name="'+block+'_time[]" placeholder="17:00">';
        // html += '<div class="input-group-append">';
        // html += '<button type="button" class="input-group-text">';
        // html += '<i class="material-icons-outlined">schedule</i>';
        // html += '</button>';
        // html += '</div>';
		html += '</div>';
        html += '</td>';
        html += '<td class="action text-center">';
        html += '<button type="button" class="btn" onclick="removeRow(`'+block+'`,'+blockDiv+')">';
        html += '<i class="material-icons-outlined text-danger">remove_circle_outline</i>';
        html += '</button>';
        html += '</td>';
        html += '</tr>';
        // $('.'+block+':nth-child('+(blockDiv+1)+')').after(html);
        $('.'+block+'_'+(blockDiv-1)+'').after(html);
	}

	function removeRow(block,blockDiv){
		// $('.'+block+':nth-child('+(blockDiv+1)+')').remove();
		$('.'+block+'_'+(blockDiv)+'').remove();
	}
</script>
@endsection