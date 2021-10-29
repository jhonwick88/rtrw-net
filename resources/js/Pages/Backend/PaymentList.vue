<template>
<app-layout :title="$page.props.appname" :isloader="isloading">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user"></i> {{ $page.props.appname }}&nbsp;&nbsp;
        <small id="loader" v-if="isloading"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<!-- header table -->
<div class="row">
<div class="col-12 mr-b-10">
    		<div style="padding-bottom: 5px; padding-top: 5px;">
                 <input type="text" class="form-control" v-model="query" placeholder="Pencarian..." style="float:left; margin-top: 6px; max-width: 150px;">
                 <button name="help" class="btn bg-primary" onclick="location.href='#help';" title="Help"><i class="fa fa-question"></i> Info</button>
		</div>
        <!-- filter -->
        <div class="input-group mr-b-10">
            <div class="input-group-2 col-box-4">
			<select style="padding:5px;" class="group-item group-item-md" title="Month" v-model="filter.month" @change="switchMonth($event)">
        			<option :value="index" v-for="(item,index) in $page.props.filters.months" :key="index">{{ item }}</option>
            </select>
			</div>
			<div class="input-group-2 col-box-3">
			<select style="padding:5px;" class="group-item group-item-md" title="Year" v-model="filter.year" @change="switchYear($event)">
        			<option :value="index" v-for="(item,index) in $page.props.filters.years" :key="index">{{ item }}</option>
            </select>
			</div>
        </div>
        <!-- end filter -->
</div>
<!-- pagination -->
<div class="col-12 align-middle text-center" v-if="filterData.last_page > 1">
    <div class="pagination">
        <template v-for="(item, i) in filterData.links" :key="i">
            <a href="javascript:" aria-label="Previous" v-if="i == 0">
        <span aria-hidden="true">&laquo;</span>
      </a>
       <a class="page-link" href="javascript:" aria-label="Next" v-else-if="i == filterData.links.length - 1">
        <span aria-hidden="true">&raquo;</span>
      </a>
            <a :class="{'active': filterData.current_page == item.label}" href="javascript:" @click="getPage(item.label)" v-else>{{item.label}}</a>
        </template>
</div>
</div>
<!-- end pagination -->
</div>
<!-- end header table -->
<!-- start table -->
		  <div class="overflow mr-t-10 box-bordered" style="max-height: 75vh">
			<table class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="6">{{ $page.props.title }} {{ $page.props.filters.months[filter.month]+' '+filter.year }}<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">{{ getTotal() }}</th>
				</tr>
				<tr>
				  <th class="text-center">№</th>
					<th class="pointer" title="Click to sort" @click="sort('name')"><i class="fa fa-sort"></i> Nama</th>
					<th class="pointer" title="Click to sort" @click="sort('network_type')"><i class="fa fa-sort"></i> Tipe</th>
					<th class="pointer" title="Click to sort" @click="sort('total_payment')"><i class="fa fa-sort"></i> Total</th>
                    <th>Tgl Bayar</th>
                    <th>Kolektor</th>
                    <th>Status</th>
					<!-- <th class="pointer" title="Click to sort" @click="sort('updated_at')"><i class="fa fa-sort"></i> Update tgl</th> -->
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in filterData.data" :key="index">
      <th class="align-middle text-center">
          <!-- <i class="fa fa-minus-square text-danger pointer" @click="remove(index)"></i> &nbsp;&nbsp; -->
          <!-- <i class="fa fa-minus-square text-danger pointer" @click="remove(index)"></i> &nbsp;&nbsp; -->
          {{ filterData.from+index }}
      </th>
      <td><a :title="`Open ${item.name}`" :href="route('be.admin.customers.member',item.id)"><i class="fa fa-edit"></i> {{ item.name }} </a></td>
      <td>{{ item.network_type }}</td>
      <td style="text-align:right;"> {{ item.payment.length > 0 ? getStatus(item.payment[0]).total_payment : item.total_payment }}</td>
      <td>{{ item.payment.length > 0 ? getStatus(item.payment[0]).pay_date : '' }}</td>
      <td>{{ item.payment.length > 0 ? item.payment[0].collector: '' }}</td>
      <td class="text-center">{{ item.payment.length > 0 ? getStatus(item.payment[0]).status : 'UNPAID' }}</td>
      <!-- <td>{{ item.payment.length > 0 ? item.payment[0].updated_at : item.updated_at }}</td> -->
   <td>
       <div v-if="item.payment.length > 0">
            <a class="btn bg-primary" href="javascript:" @click="makePay(index)" v-if="getStatus(item.payment[0]).unpaid == 2">Bayar</a>
       </div>
       <div v-else>
           <a class="btn bg-primary" href="javascript:" @click="makePay(index)">Bayar</a>
       </div>
</td>
    </tr>
				</tbody>
			</table>
		</div>
<!-- end table -->
    <!-- end content -->
     <jet-confirmation-modal id="help">
      <template #title>
        Info
      </template>
      <template #content>
          <b>Penting</b><br>
        -
      </template>

      <template #footer>

        <button>
          Mengerti
        </button>
      </template>
    </jet-confirmation-modal>
    <!-- edit modal -->
     <jet-confirmation-modal id="edit">
     <template #title>
        Form Pembayaran Pelanggan {{paymentItem.name}}
      </template>
      <template #content>
       <table class="table">
  <tbody>
  <tr>
     <td class="align-middle">Nama</td><td>
       <select class="form-control" v-model="paymentItem.customer_id" disabled>
           <option v-for="(customer,index) in filterData.data" :key="index" :value="customer.id">{{ customer.name}}</option>
       </select>
    </td>
  </tr>
  <tr>
     <td class="align-middle">Bulan</td><td>
       <select class="form-control" v-model="paymentItem.month" disabled>
           <option v-for="(item,index) in $page.props.filters.months" :key="index" :value="index">{{ item }}</option>
       </select>
    </td>
  </tr>
  <tr>
     <td class="align-middle">Tahun</td><td>
       <select class="form-control" v-model="paymentItem.year" disabled>
           <option v-for="(item,index) in $page.props.filters.years" :key="index" :value="index">{{ item }}</option>
       </select>
    </td>
  </tr>
    <tr>
    <td class="align-middle">Total Bayar</td><td><input class="form-control" type="number" v-model="paymentItem.total" disabled></td>
  </tr>
    <tr>
    <td class="align-middle">Status</td><td>
       <select class="form-control" v-model="paymentItem.status" disabled>
           <option v-for="(status,index) in payStatus" :key="index" :value="status.id" >{{ status.name}}</option>
       </select>
    </td>
  </tr>
  <tr>
     <td class="align-middle">Metoda Pembayaran</td><td>
       <select class="form-control" v-model="paymentItem.payment_method_id">
           <option v-for="(method,index) in $page.props.methods" :key="index" :value="method.id">{{ method.name }}</option>
       </select>
    </td>
  </tr>

  </tbody>
       </table>
      </template>

      <template #footer>
        <button class="btn bg-danger" @click="payItem">
          Bayar
        </button>
      </template>
    </jet-confirmation-modal>
    <!-- end edit modal -->
</div>
</div>
</div>
</div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
import JetConfirmationModal from '@/Jetstream/InfoModalNet'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        JetConfirmationModal
    },
    data(){
        return{
            filterData: {
                data: [],
            },
            currentSortDir: "asc",
            currentSortCol: "name",
            isloading: false,
            query:'',
            itemToChange: null,
            filter:{
                month: this.$page.props.default.month,
                year: this.$page.props.default.year,
                all:1,
                q: ''
            },
            paymentItem:{
                name: '',
                customer_id: null,
                month: this.$page.props.default.month,
                year: this.$page.props.default.year,
                total: 0,
                status: 2,
                payment_method_id: null
            },
            payStatus:[{id:1,name:'PAID'},{id:2,name:'UNPAID'}],
            action:{
                title:'',
                message:'',
                option:''
            },
        }
    },
    created() {
        this.getFilterData(this.filter)
    },
    watch: {
        query: function(newVal) {
            this.filter.q = newVal.length > 2 ? newVal : ''
            this.getFilterData(this.filter)
        }
    },
    methods: {
        sort(col){
             if (this.currentSortCol === col) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      } else {
        this.currentSortCol = col;
      }
      this.filterData.data.sort(this.sortBy(col,this.currentSortDir));
    },
    switchMonth(event){
        this.filter.month = event.target.value
        this.getFilterData(this.filter)
    },
    switchYear(event){
        this.filter.year = event.target.value
        this.getFilterData(this.filter)
    },
    getTotal(){
        let total = 0
        if(this.filterData.data.length > 0){
        this.filterData.data.forEach((item)=>{
            total += item.total_payment
        });
        }
        return 'Rp.  '+total.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1\.")
    },
        getFilterData(filter){
            this.isloading = true
            ApiManager.getPayments(filter)
                .then((response) => {
                    this.isloading = false
                    this.filterData = response.data.data
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getPage(filter){
             if(!filter.includes('&'))
              this.getFilterData(filter)
        },
        makePay(index){ // make new pay data to paid
            let item = this.filterData.data[index]
            this.itemToChange = index
            this.paymentItem = {
                name: item.name,
                customer_id: item.id,
                month: this.filter.month,
                year: this.filter.year,
                total: item.total_payment,
                status: 1,
                payment_method_id: null
            }
            location.href='#edit'
        },
        getStatus(payment){
            return {
                status: payment.status == 1 ? 'PAID' : 'UNPAID',
                total_payment: payment.status == 1 ? payment.total : 0,
                pay_date: payment.status == 1 ? payment.pay_date: '',
                unpaid: payment.status == 2 ? 2 : 1
            }
        },

        payItem(){
           // console.log(JSON.stringify(this.paymentItem))
            this.$swal.fire({
                title: 'Bayar Tagihan Pelanggan '+ this.paymentItem.name,
                text: 'Anda setuju untuk membayar tagihan internet dan aksi ini tidak dapat dikembalikan, kamu yakin?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: `Batal`,
            }).then((result) => {
                this.isloading = true
                ApiManager.postAddPayment(this.paymentItem).then((response)=>{
                    this.isloading = false
                    if(response.data.code ==0){
                        this.filterData.data[this.itemToChange].payment.push(response.data.data)
                        this.$swal.fire('Pembayaran Sukses!', '', 'success')
                        window.location.href="#"
                    }else{
                        this.showToast(response.data.message)
                    }
                }).catch((error)=>{
                    console.log(error)
                    this.isloading = false
                })
            })

        }

    }
}
</script>
