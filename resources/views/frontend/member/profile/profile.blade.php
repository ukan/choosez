@extends('layout.backend.admin.master.master')

@section('title', 'Personal Info')

@section('page-header', 'Personal Info')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="{!! route('member-profile') !!}">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><a href="{!! route('member-profile') !!}">Profile</a></li>
	  <li><span>Personal Info</span></li>
	</ol>
@endsection

@section('content')
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="active">
				<a><i class="fa fa-info"></i> Personal Information</a>
			</li>
			<li>
				<a href="{{ route('member-profile-change-password') }}"><i class="fa fa-edit"></i> Change Password</a>
			</li>
		</ul>
		<div class="tab-content">
			<a class="btn btn-warning pull-right" data-toggle="modal" data-target="#editProfile">Edit Profile</a>
			<br>
			    <img src="{{ user_info('avatar_path') }}" style="display: block; margin: auto;  width: 150px; height: 150px"alt="{{ user_info('full_name') }}" class="img-circle" data-lock-picture="{{ user_info('avatar_path') }}" />
			<div class="clearfix">&nbsp;</div>
			<div class="table-responsive custom-tabinfo">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>Nama Lengkap</td>
							<td>{{ user_info('full_name') }}</td>
						</tr>
						<tr>
							<td>Nama Panggilan</td>
							<td>{{ user_info('nick_name') }}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{{ user_info('email') }}</td>
						</tr>
						<tr>
							<td>Tempat Tanggal Lahir</td>
							<td>{{ user_info('place_of_birth').', '.eform_date($date_of_birth) }}</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>{{ user_info('gender') }}</td>
						</tr>
						<tr>
							<td>Asrama</td>
							<td>{{ user_info('hostel') }}</td>
						</tr>
						<tr>
							<td>Kamar</td>
							<td>{{ user_info('room') }}</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>{{ user_info('address') }}</td>
						</tr>
						<tr>
							<td>Provinsi</td>
							<td>{{ user_info('province') }}</td>
						</tr>
						<tr>
							<td>Kabupaten/Kota</td>
							<td>{{ user_info('city_or_district') }}</td>
						</tr>
						<tr>
							<td>Kecamatan</td>
							<td>{{ user_info('sub_district') }}</td>
						</tr>
						<tr>
							<td>Desa</td>
							<td>{{ user_info('village') }}</td>
						</tr>
						<tr>
							<td>RT</td>
							<td>{{ user_info('rt') }}</td>
						</tr>
						<tr>
							<td>RW</td>
							<td>{{ user_info('rw') }}</td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td>{{ user_info('postal_code') }}</td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td>{{ user_info('phone') }}</td>
						</tr>
						<tr>
							<td>SD/MI</td>
							<td>{{ user_info('sd') }}</td>
						</tr>
						<tr>
							<td>SMP/MTs</td>
							<td>{{ user_info('sltp') }}</td>
						</tr>
						<tr>
							<td>SMA/MA/SMK</td>
							<td>{{ user_info('slta') }}</td>
						</tr>
						<tr>
							<td>Pondok Pesantren</td>
							<td>{{ user_info('mbs') }}</td>
						</tr>
						<tr>
							<td>Univ/Institut</td>
							<td>{{ user_info('university') }}</td>
						</tr>
						<tr>
							<td>Jenjang Pendidikan</td>
							<td>{{ user_info('jenjang') }}</td>
						</tr>
						<tr>
							<td>Fakultas</td>
							<td>{{ user_info('faculty') }}</td>
						</tr>
						<tr>
							<td>Jurusan</td>
							<td>{{ user_info('major') }}</td>
						</tr>
						<tr>
							<td>Semester</td>
							<td>{{ user_info('semester') }}</td>
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td>{{ user_info('father_name') }}</td>
						</tr>
						<tr>
							<td>Umur</td>
							<td>{{ user_info('father_age') }}</td>
						</tr>
						<tr>
							<td>Pendidikan Terakhir</td>
							<td>{{ user_info('f_last_study') }}</td>
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>{{ user_info('f_current_job') }}</td>
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td>{{ user_info('mother_name') }}</td>
						</tr>
						<tr>
							<td>Umur</td>
							<td>{{ user_info('mother_age') }}</td>
						</tr>
						<tr>
							<td>Pendidikan Terakhir</td>
							<td>{{ user_info('m_last_study') }}</td>
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>{{ user_info('m_current_job') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

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
