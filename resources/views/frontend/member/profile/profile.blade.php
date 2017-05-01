@extends('layout.backend.admin.master.master')

@section('title', 'Personal Info')

@section('page-header', 'Personal Info')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="{!! route('admin-dashboard') !!}">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><a href="{!! route('admin-profile') !!}">Profile</a></li>
	  <li><span>Personal Info</span></li>
	</ol>
@endsection

@section('content')
	@include('backend.member.profile.partials.cover')

	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="active">
				<a><i class="fa fa-info"></i> Personal Information</a>
			</li>
			<li>
				<a href="{{ route('profile-change-password') }}"><i class="fa fa-edit"></i> Change Password</a>
			</li>
		</ul>
		<div class="tab-content">
<a class="btn btn-warning pull-right" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
<br>
<div class="clearfix">&nbsp;</div>
			<div class="table-responsive custom-tabinfo">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>NIS</td>
							<td>{{ user_info('member_id') }} <i class="fa fa-question-circle" rel="tooltip" title="Dapat Anda gunakan untuk mempromosikan halaman affiliate Anda (scoido.com/{{ user_info('member_id') }}) dan dapatkan komisi bulanan untuk setiap customer yang mendaftar"></i></td>
						</tr>
						<tr>
							<td>Name</td>
							<td>{{ user_info('full_name') }}</td>
						</tr>
						<tr>
							<td>Gender</td>
							<td>{{ user_info('gender') }}</td>
						</tr>
						<tr>
							<td>Place and date of Birth</td>
							<td>{{ user_info('place_of_birth').', '.$date_of_birth }}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{{ user_info('email') }}</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>{{ user_info('address') }}</td>
						</tr>
						<tr class="hidden">
							<td>Pin BBM</td>
							<td>{{ user_info('pin_bbm') }}</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>{{ user_info('phone') }}</td>
						</tr>
						<tr>
							<td>Country</td>
							<td>{{ user_info('country') }}</td>
						</tr>
						<tr>
							<td>Province</td>
							<td>{{ user_info('province') }}</td>
						</tr>
						<tr>
							<td>City / District</td>
							<td>{{ user_info('city') }}</td>
						</tr>
						<tr>
							<td>Sub District</td>
							<td>{{ user_info('district') }}</td>
						</tr>
						<tr>
							<td>Postal Code</td>
							<td>{{ user_info('postal_code') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

    @include('backend.member.profile.edit')

@endsection

@section('scripts')

  <script type="text/javascript">
  Date.prototype.yyyymmdd = function() {
	  var mm = this.getMonth() + 1; // getMonth() is zero-based
	  var dd = this.getDate();

	  return [this.getFullYear(), !mm[1] && '0', mm, !dd[1] && '0', dd].join(''); // padding
	};

	var date = new Date();

  $(".datepicker-birthday").datepicker({
  			format:"yyyy-mm-dd",
            endDate:date.yyyymmdd(),
});
  $(".datepicker-birthday").keydown(function() {
      return false;
    });
  $('.warning-after-save').hide();
  $('[name=funnels_name]').on('keyup',function(){
  	$('.warning-after-save').show();
  });
@if(user_info('gender') != '')
	$("input[name=gender][value={{user_info('gender')}}]").attr('checked', 'checked');
@endif
@if(user_info('information') != '')
	$("input[name=information][value={{user_info('information')}}]").attr('checked', 'checked');
@endif
	function ajaxdistrict(id){
	    var url= '{{ route('user-location-information-process') }}';
	    url=url+"/province";
	    url=url+"/"+id;

	    $.get(url, function(data, status){
        $("#district_id").html(data);
    	});
	}

	function ajaxsubdistrict(id){
	    var url= '{{ route('user-location-information-process') }}';
	    url=url+"/subdistrict";
	    url=url+"/"+id;
	    $.get(url, function(data, status){
        $("#sub_district_id").html(data);
    	});
	}

	function ajaxvillage(id){
	    var url= '{{ route('user-location-information-process') }}';
	    url=url+"/village";
	    url=url+"/"+id;
	    $.get(url, function(data, status){
        $("#village_id").html(data);
    	});
	}


	$('.jquery-form-edit-profile').ajaxForm({
	    success: function(response) {
	      	if(response.indexOf('success') >= 0){
				var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
				new PNotify({
				    title: "Success",
				    text: "Data Has Been Updated",
					type: 'success',
				    addclass: "stack-custom",
				    stack: myStack
				});
				setTimeout(function(){
				   window.location.reload(1);
				}, 0);
			}else{
				$('.errorsMessage').html(response);
			}

	    },
		beforeSend: function() {
		  $('.has-error').html('');
		},
		error: function(response){
		  if (response.status === 422) {
		      var data = response.responseJSON;
		      $.each(data,function(key,val){
		          $('.edit-profile-'+key).html(val);
		      });
			var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
				new PNotify({
				    title: "Failed",
				    text: "Validate Error, Check Your Data Again",
					type: 'danger',
				    addclass: "stack-custom",
				    stack: myStack
				});
            $("#editProfile").scrollTop(0);
		  } else {
		      $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
		  }
		}
	});
</script>
@endsection
