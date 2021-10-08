<template>
    <frontend-layout :isloader="isloading" :title="$page.props.appname">
        <div class="container" >
              <div class="row justify-content-center my-5">
                <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                    <div class="cardgf p-3 text-white text-center mb-4">
                        <strong>Want a free Crypto Price Bot in your telegram group?</strong><br>
                        1. Submit your coin with the form below<br>
                        2. Join <a target="_blank" href="https://t.me/mycoint">https://t.me/mycoint</a><br>
                        3. Ask the admins there for more info!
                    </div>
                    <div class="cardxf p-3 text-white">
                        <h3 class="text-white">Submit new coin to CoinSniper</h3>
                        <p>Please fill out this form carefully to add a new coin to CoinSniper. After submission, your coin will be visible on the New Listings page. Get 500 votes to be officially listed on CoinSniper.</p>
                        <!-- start form -->
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <label>Logo Upload*</label>
                                <input type="file" ref="myFile" @change="updatePhotoPreview" accept="image/*" hidden>
                                <div class="photo mt-3" v-show="imgpreview">
                                    <img :src="imgpreview" class="img-fluid sfdsf"/>
                                </div>
                                <div class="photo mt-3" v-show="!imgpreview" @click="uploadImage" role="button">
                                    <img src="/images/placeholder.jpg" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                 <div class="form-group">
                                <jet-label for="name" value="Name*" />
                                <jet-input id="name" type="text" required v-model="form.name" placeholder="Bitcoin"/>
                                </div>
                                <div class="form-group">
                                <jet-label for="symbol" value="Symbol*" /><br>
                                <jet-input id="symbol" type="text" v-model="form.symbol" placeholder="BTC" required/>
                                </div>
                                  <div class="form-group required">
                                      <jet-label for="network" value="Network/Chain*" />
                                <select class="form-control" id="network" v-model="form.network_id">
                                    <option v-for="(item,index) in $page.props.network" :value="item.id" :key="index">
                                        {{ item.name+'('+item.sort_name+')' }}
                                    </option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                 <jet-label for="symbol" value="Project in presale phase?*" /><br>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" v-model="form.ispresale">
                                <label class="form-check-label" for="inlineRadio1">No</label>
                                </div>                            
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" v-model="form.ispresale">
                                <label class="form-check-label" for="inlineRadio2">Yes</label>
                                </div>
                            </div>
                            <div class="form-group">
                            <jet-label for="contract_address" :value="form.ispresale == 0 ? 'Contract Address*' : 'Contract Address (optional for presales)'"/>
                            <jet-input id="contract_address" type="text" v-model="form.contract_address" placeholder="0xB8c77482e45F1F44dE1745F52C74426C631bDD52"/>
                            </div>
                            <div class="form-group" v-show="form.ispresale == 1">
                            <jet-label for="presale_link" value="Presale link (optional)" />
                            <jet-input id="presale_link" type="text" v-model="form.presale_link" placeholder="https://dxsale.com/your-presale-link-here"/>
                            </div>
                             <div class="form-group">
                            <jet-label for="description" value="Description" />
                            <textarea id="description" class="form-control" v-model="form.description" placeholder="Describe your coin here. What is the goal, plans, why is this coin unique?" rows="3"/>                            
                            </div>
                            <div class="form-group">
                            <jet-label for="chart_link" value="Custom Chart link(optional)" />
                            <jet-input id="chart_link" type="text" v-model="form.chart_link" placeholder="https://dex.guru/token/0x...." />
                            <small><em>By default, Poocoin (BSC) and Dextools (ETH) is used. Enter custom chart link here if you want to use it.</em></small>
                            </div>
                            <div class="form-group">
                            <jet-label for="swap_link" value="Custom Swap link (optional)" />
                            <jet-input id="swap_link" type="text" v-model="form.swap_link" placeholder="https://apeswap.finance/..." />
                            <small><em>By default, PancakeSwap v2 (BSC) and UniSwap (ETH) is used. Enter custom swap link here if you want to use it, like Apeswap.</em></small>
                            </div>
                            <div class="form-group">
                            <jet-label for="website_link" value="Website link*"/>
                            <jet-input id="website_link" type="text" v-model="form.website_link" placeholder="https://mywebsite.net" required />
                            </div>
                            <div class="form-group">
                            <jet-label for="launch_at" value="Launch Date*" />
                            <jet-input id="launch_at" type="date" v-model="form.launch_at" required />
                            </div>            
                            <div class="form-group">
                            <jet-label for="telegram" value="Telegram link*" />
                            <jet-input id="telegram" type="text" v-model="form.telegram_link" placeholder="https://t.me/mycoin" required  />
                            </div>            <div class="form-group">
                            <jet-label for="twitter" value="Twitter link" />
                            <jet-input id="twitter" type="text" v-model="form.twitter_link" placeholder="https://twitter.com/mycoin" />
                            </div>            
                            <div class="form-group">
                            <jet-label for="discord" value="Discord link" />
                            <jet-input id="discord" type="text" v-model="form.discord_link" placeholder="https://discord.gg/mycoin"/>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="isaggree" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    I agree to the Terms and Conditions*
                                </label>
                                </div>
                            </div>
                            <vue-recaptcha v-if="showRecaptcha" class="mb-3" :siteKey="setting.google_captcha"
                            size="normal" 
                            theme="light"
                            :tabindex="0"
                            @verify="recaptchaVerified"
                            @expire="recaptchaExpired"
                            @fail="recaptchaFailed"
                            ref="vueRecaptcha">
                            </vue-recaptcha>
                            <validation-errors class="mb-2" :rusak="warnings"/>
                            <button class="btn btn-primary" type="button" :disabled="!isaggree || !isrecapt" @click="submit"><i class='bx bx-loader bx-spin mr-2' v-show="isloading"></i>SUBMIT COIN</button>
                        </div>
                        <!-- end form --> 
                    </div>
                </div>
              </div>
        </div>
    
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import ValidationErrors from '@/Jetstream/ValidationsErrorsCustom'
import vueRecaptcha from 'vue3-recaptcha2'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import ApiManager from '../API/ApiManager'
export default {
    props: ['user'],
    components: {
        FrontendLayout,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        ValidationErrors,
        vueRecaptcha 
    },
    data(){
        return{
            form:{
                name:'',
                symbol:'',
                network_id:1,
                ispresale:0,
                presale_link:'',
                contract_address:'',
                description:'',
                cart_link:'',
                swap_link:'',
                website_link:'',
                launch_at:'',
                telegram_link:'',
                twitter_link:'',
                logo:'',
                discord_link:'',
                user_id:  this.user.id
            },
            isaggree: false,
            isrecapt: false,
            imgpreview: null,
            isloading: false,
            showRecaptcha: true,
            warnings:[],
            setting:{},
        }
        },
        created(){
            this.setting = JSON.parse(localStorage.getItem('setting'))           
        },
    methods:{
        submit(){
            this.isloading = true
            if (this.$refs.myFile) {
                this.form.logo = this.$refs.myFile.files[0]
            }
            //console.log('datas '+JSON.stringify(this.form))
            let formData = new FormData();
            formData.append('name',this.form.name);            
            formData.append('symbol',this.form.symbol);
            formData.append('network_id',this.form.network_id);
            formData.append('logo',this.form.logo);
            formData.append('ispresale',this.form.ispresale);
            formData.append('presale_link',this.form.presale_link);
            formData.append('contract_address',this.form.contract_address);
            formData.append('description',this.form.description);
            formData.append('cart_link',this.form.cart_link);
            formData.append('swap_link',this.form.swap_link);
            formData.append('website_link',this.form.website_link);
            formData.append('launch_at',this.form.launch_at);
            formData.append('telegram_link',this.form.telegram_link);
            formData.append('twitter_link',this.form.twitter_link);
            formData.append('discord_link',this.form.discord_link);
            formData.append('user_id',this.form.user_id);
            //let that = this
             ApiManager.postSubmitCoin(formData).then((response) => {
                this.isloading = false
                 if(response.data.code == 0){
                    let coin = response.data.data;
                    //console.log('res '+ JSON.stringify(coin));
                     window.location.href = '/coin/'+coin.name+'-'+coin.id
                 }
            })
            .catch((error) => {
                console.log(JSON.stringify(error));
            });
            
        },
        uploadImage(){
            this.$refs.myFile.click();
        },
        updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.imgpreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.myFile.files[0]);
    },
    recaptchaVerified(response) {
         this.isrecapt = true
	},
	recaptchaExpired() {
	  this.$refs.vueRecaptcha.reset();
       this.isloading = false
      this.isrecapt = false
	},
	recaptchaFailed() {
         this.isloading = false
        this.isrecapt = false
	}
        }
}
</script>
<style scoped>
.cardxf{
   background-color: #111621;
   border-radius: 0.475rem;
   border: 0;
}
.cardgf{
   background-color: #0a9fc4;
   border-radius: 0.475rem;
   border: 0;
}
.sfdsf{
    height: 175px;
    width: 175px;
}

</style>