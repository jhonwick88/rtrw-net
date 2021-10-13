<template>
    <app-layout>
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-money"></i> Selling Report Oct 2021 <small id="loader" style="display: none;"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<!-- header table -->
<div class="row">
<div class="col-12">
</div>
</div>
<!-- end header table -->
<!-- start table -->
		  <div class="overflow box-bordered" style="max-height: 70vh">
			<table id="dataTable" class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="5">Selling Report oct2021<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">Rp 0</th>
				</tr>
				<tr>
				  <th>№</th>
					<th>Date</th>
					<th>Time</th>
					<th>Username</th>
					<th>Profile</th>
					<th>Comment</th>
					<th style="text-align:right;"> Price</th>
				</tr>
				</thead>
				<tbody>
							</tbody>
			</table>
		</div>
<!-- end table -->
    <!-- end content -->
</div>
</div>
</div>
</div>

    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'

export default {
    components: {
        AppLayout,
    },
    data(){
        return{

        }
    },
    created() {

    },
    methods: {

    }
}
</script>
