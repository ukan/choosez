<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info-squad">
			<div class="panel-body custom-pb">
				<h4 class="tbl-title"> Customer Information</h4>
				<hr>
        <table class="table table-striped tblspace">
            <thead>
                <tr>
                    <th>Active</th>
                    <th>Suspended</th>    
                    <th>Banned</th> 
                    <th>Terminated</th>
                </tr>
            </thead>                
            <tbody style="width:100%">
                <tr>
                    <td style="width:25%">{{ $total_squad_active }}</td>
                    <td style="width:25%">{{ $total_squad_suspend }}</td>
                    <td style="width:25%">{{ $total_squad_banned }}</td>
                    <td style="width:25%">{{ $total_squad_terminated }}</td>
                </tr>
            </tbody>
        </table>  
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-info-squad">
			<div class="panel-body custom-pb">
                <h4> 1st Info</h4>
                <table class="table table-striped tblspace">        
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:50%">Pro</td>
                            <td style="width:50%">{{ $total_pro_on_g1 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Master</td>
                            <td style="width:50%">{{ $total_master_on_g1 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Guru</td>
                            <td style="width:50%">{{ $total_guru_on_g1 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Total</b></td>
                            <td style="width:50%">{{ $total_g1 }}</td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-info-squad">
			<div class="panel-body custom-pb">
                <h4> 2nd Info</h4>
                <table class="table table-striped tblspace">        
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:50%">Pro</td>
                            <td style="width:50%">{{ $total_pro_on_g2 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Master</td>
                            <td style="width:50%">{{ $total_master_on_g2 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Guru</td>
                            <td style="width:50%">{{ $total_guru_on_g2 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Total</b></td>
                            <td style="width:50%">{{ $total_g2 }}</td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-info-squad">
			<div class="panel-body custom-pb">
                <h4> 3rd Gen Info</h4>
                <table class="table table-striped tblspace">        
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:50%">Pro</td>
                            <td style="width:50%">{{ $total_pro_on_g3 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Master</td>
                            <td style="width:50%">{{ $total_master_on_g3 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Guru</td>
                            <td style="width:50%">{{ $total_guru_on_g3 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Total</b></td>
                            <td style="width:50%">{{ $total_g3 }}</td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-info-squad">
			<div class="panel-body custom-pb">
				<h4> 4th Gen Info</h4>
                <table class="table table-striped tblspace">        
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:50%">Pro</td>
                            <td style="width:50%">{{ $total_pro_on_g4 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Master</td>
                            <td style="width:50%">{{ $total_master_on_g4 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%">Guru</td>
                            <td style="width:50%">{{ $total_guru_on_g4 }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Total</b></td>
                            <td style="width:50%">{{ $total_g4 }}</td>
                        </tr>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('frontend.member.partnership.partials.legend')        
    </div>
</div>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><center>1st Generation</center></th>
            <th><center>2nd Generation</center></th>
            <th><center>3rd Generation</center></th>
            <th><center>4th Generation</center></th>
        </tr>
    </thead>
    <tbody>
		{!! $getRecordTableGeneration !!}
    </tbody>
</table>


{!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

<script>
    $(document).ready(function() {
        
    });
   var table = $('#example').DataTable({
    "bSort" : false
   });
</script>