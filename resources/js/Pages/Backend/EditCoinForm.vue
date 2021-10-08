<template>
    <jet-dialog-modal id="updateCoinModal">
      <template #title>
        Edit Coin
      </template>

      <template #content>
          <div v-if="coinItem != null">
<!-- start input -->
<div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <label>Logo Upload*</label>
                                <input type="file" ref="myFile" @change="updatePhotoPreview" accept="image/*" hidden>
                                <div class="photo mt-3" v-show="imgpreview" @click="uploadImage" role="button">
                                    <img :src="imgpreview" class="img-fluid sfdsf"/>
                                </div>
                                <div class="photo mt-3" v-show="!imgpreview" @click="uploadImage" role="button">
                                    <img :src="coinItem.logo" class="img-fluid"/>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                 <div class="form-group">
                                <jet-label for="name" value="Name*" />
                                <jet-input id="name" type="text" required v-model="coinItem.name" placeholder="Bitcoin"/>
                                </div>
                                <div class="form-group">
                                <jet-label for="symbol" value="Symbol*" /><br>
                                <jet-input id="symbol" type="text" v-model="coinItem.symbol" placeholder="BTC" required/>
                                </div>
                                  <div class="form-group required">
                                      <jet-label for="network" value="Network/Chain*" />
                                <select class="form-control" id="network" v-model="coinItem.network_id">
                                    <option v-for="(item,index) in $page.props.network" :value="item.id" :key="index">
                                        {{ item.name+'('+item.sort_name+')' }}
                                    </option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                                <jet-label for="marketcap" value="Marketcap"/>
                                <jet-input id="marketcap" type="number" v-model="coinItem.marketcap" placeholder="ex. 703.075" />
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                                <jet-label for="price_usd" value="Price USD"/>
                                <jet-input id="price_usd" type="number" v-model="coinItem.price_usd" placeholder="ex. 0.0007805533376800" />
                            </div>
                            </div>
                            <div class="col">
                                                            <div class="form-group">
                                <jet-label for="price_bnb" value="Price BNB"/>
                                <jet-input id="price_bnb" type="number" v-model="coinItem.price_bnb" placeholder="ex. 0.000002299370" />
                            </div>
                            </div>
                        </div>
                                <div class="form-group">
                                 <jet-label for="symbol" value="Project in presale phase?*" /><br>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" v-model="coinItem.ispresale">
                                <label class="form-check-label" for="inlineRadio1">No</label>
                                </div>                            
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" v-model="coinItem.ispresale">
                                <label class="form-check-label" for="inlineRadio2">Yes</label>
                                </div>
                            </div>
                            <div class="form-group">
                            <jet-label for="contract_address" :value="coinItem.ispresale == 0 ? 'Contract Address*' : 'Contract Address (optional for presales)'"/>
                            <jet-input id="contract_address" type="text" v-model="coinItem.contract_address" placeholder="0xB8c77482e45F1F44dE1745F52C74426C631bDD52"/>
                            </div>
                             <div class="form-group">
                            <jet-label for="ispromoted" value="Promoted ?" />
                                     <select class="form-control" id="ispromoted" v-model="coinItem.ispromoted">
                                        <option :value="1">Yes</option>
                                        <option :value="0">No</option>
                                    </select>
                            </div>
                            <div class="form-group" v-show="coinItem.ispresale == 1">
                            <jet-label for="presale_link" value="Presale link (optional)" />
                            <jet-input id="presale_link" type="text" v-model="coinItem.presale_link" placeholder="https://dxsale.com/your-presale-link-here"/>
                            </div>
                            <div class="form-group">
                            <jet-label for="description" value="Description" />
                            <textarea id="description" class="form-control" v-model="coinItem.description" placeholder="Describe your coin here. What is the goal, plans, why is this coin unique?" rows="3"/>                            
                            </div>
                            <div class="form-group">
                            <jet-label for="chart_link" value="Custom Chart link(optional)" />
                            <jet-input id="chart_link" type="text" v-model="coinItem.chart_link" placeholder="https://dex.guru/token/0x...." />
                            <small><em>By default, Poocoin (BSC) and Dextools (ETH) is used. Enter custom chart link here if you want to use it.</em></small>
                            </div>
                            <div class="form-group">
                            <jet-label for="swap_link" value="Custom Swap link (optional)" />
                            <jet-input id="swap_link" type="text" v-model="coinItem.swap_link" placeholder="https://apeswap.finance/..." />
                            <small><em>By default, PancakeSwap v2 (BSC) and UniSwap (ETH) is used. Enter custom swap link here if you want to use it, like Apeswap.</em></small>
                            </div>
                            <div class="form-group">
                            <jet-label for="website_link" value="Website link*"/>
                            <jet-input id="website_link" type="text" v-model="coinItem.website_link" placeholder="https://mywebsite.net" required />
                            </div>
                            <div class="form-group">
                            <jet-label for="launch_at" value="Launch Date*" />
                            <jet-input id="launch_at" type="date" v-model="coinItem.launch_at" required />
                            </div>            
                            <div class="form-group">
                            <jet-label for="telegram" value="Telegram link*" />
                            <jet-input id="telegram" type="text" v-model="coinItem.telegram_link" placeholder="https://t.me/mycoin" required  />
                            </div>            <div class="form-group">
                            <jet-label for="twitter" value="Twitter link" />
                            <jet-input id="twitter" type="text" v-model="coinItem.twitter_link" placeholder="https://twitter.com/mycoin" />
                            </div>            
                            <div class="form-group">
                            <jet-label for="discord" value="Discord link" />
                            <jet-input id="discord" type="text" v-model="coinItem.discord_link" placeholder="https://discord.gg/mycoin"/>
                            </div>
<!-- end input -->
          </div>
          
      </template>

      <template #footer>
        <jet-secondary-button data-dismiss="modal">
          Cancel
        </jet-secondary-button>

        <jet-button class="ml-2" @click="updateCoin">
          Save
        </jet-button>
      </template>
    </jet-dialog-modal>
</template>
<script>
import JetDialogModal from '@/Jetstream/DialogModal'
//import JetFormSection from '@/Jetstream/FormSection'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import ApiManager from '../API/ApiManager'
export default {
    emits: ['coinUpdated'],
    props: {
        coinItem: Object,
        network: Array,
    },
    components: {
        JetDialogModal,
        JetSecondaryButton,
        JetButton,
        JetInput,
JetCheckbox,
JetLabel,
    },
    data(){
        return{
            bootstrap: null,
            imgpreview: null,
            isloading: false,
        }
    },
    // watch:{
    //     coinItem(val){
    //         if (val != null){
    //             console.log('val not null')
    //             this.showUpdateModal()
    //         }else{
    //             console.log('val is null')
    //         }
    //     }
    // },
    methods:{
        updateCoin(){
            if (this.$refs.myFile) {
                this.coinItem.logo = this.$refs.myFile.files[0]
            }
            this.isloading = true
            ApiManager.updateCoin(this.coinItem).then((result) => {
                this.isloading = false
                this.$emit('coinUpdated',result)
                 this.bootstrap.modal('toggle')
                //console.log('result... ' + JSON.stringify(result.data.data))
            }).catch((err) => {
                this.isloading = false
                console.log(err)
            });
        },
        showUpdateModal(){
            this.bootstrap = $('#updateCoinModal')
            this.bootstrap.modal('toggle')
            //console.log('show modals')
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
        // nulledCoin(){
        //      this.$emit('clickCancel',null)
        // }
    }

}
</script>
