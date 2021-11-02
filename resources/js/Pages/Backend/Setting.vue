<template>
    <app-layout :title="$page.props.appname" :isloader="isloading">
        <!-- start content -->
          <div class="row justify-content-center my-5">
    <!-- <div class="col-md-12">
      <div class="card shadow"> -->
          <!-- content here -->
           <!-- start setting -->
                <div class="row">
                <div class="col-6" v-for="(settingmain,index) in settings" :key="index">
                        <div class="card pd-10" style="position: relative">
                                <div class="mr-b-10 pd-b-10 spa">
                                <div><strong>{{settingmain.name}}</strong> &nbsp;<small><i>{{settingmain.description}}</i></small></div>
                                </div>
                                <div class="row mr-b-8" v-for="(child,x) in settingmain.setting" :key="x">
                                <div class="col-4">
                                        <label :for="child.key">{{child.label}}</label>
                                </div>
                                <div class="col-8 mt-2" v-if="child.type == 'text'">
                                        <input type="text" class="form-control" @focusout="saveSetting(child)" :placeholder="child.description" :id="child.key" v-model="child.value">
                                        <span><small>{{child.description}}</small></span>
                                </div>
                                <div class="col-8 mt-2" v-if="child.type == 'color'">
                                    <div class="d-flex">
                                        <input type="text" class="form-control" @focusin="showcolor(child)" :placeholder="child.description" :id="child.key" v-model="child.value">
                                        <span class="badge badge-pill badge-primary p-2 ml-2 border border-primary" :style="`display: block;width:100px;background-color:${child.value}`"></span>
                                    </div>
                                </div>
                                <div class="col-8 mt-2 text-center" v-if="child.type == 'image'">
                                   <input type="file" :ref="`myFile${x}`" @change="updatePhotoPreview(x,child)" accept="image/*" hidden>
                                    <div class="photo mr-t-3 pointer radius-5" v-show="imgpreview" @click="uploadImage(x)" role="button" style="max-width:20%">
                                        <img height="100" :src="imgpreview" class="img-fluid sfdsf"/>
                                    </div>
                                    <div class="photo mr-t-3 pointer radius-5" v-show="!imgpreview" @click="uploadImage(x)" role="button" style="max-width:20%">
                                        <img height="100" :src="child.value" class="img-fluid"/>
                                    </div>
                                </div>
                                <div class="col-8 mt-2" v-if="child.type == 'textarea'">
                                        <textarea class="form-control" @focusout="saveSetting(child)" :placeholder="child.description" :id="child.key" v-model="child.value" rows="2"></textarea>
                                        <span><small>{{child.description}}</small></span>
                                </div>

                                </div>
                        </div>
                </div>
                </div>
                <!-- end setting -->
                <!-- picker -->
      <jet-dialog-modal id="colorModal">
         <template #title v-if="childColor!=null">
          {{ `Edit [${childColor.label}] Color` }}
      </template>
      <template #content>
          <div class="d-flex justify-content-center">
<ColorPicker
 v-if="childColor!=null"
  :color="childColor.value"
  default-format="hex"
  :id="`color-picker`"
  @color-change="onDragColor"
>
<template #hue-range-input-label>
    <span class="sr-only">Hue</span>
  </template>

  <template #alpha-range-input-label>
    <span class="sr-only">Alpha</span>
  </template>

  <template #copy-button>
    <span class="sr-only">Copy color</span>

    <svg
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      width="15"
      height="15"
      viewBox="0 0 15 15"
    >
      <path
        d="M5 0v2H1v13h12v-3h-1v2H2V5h10v3h1V2H9V0zm1 1h2v2h3v1H3V3h3z"
        fill="currentColor"
      />

      <path
        d="M10 7v2h5v2h-5v2l-3-3zM3 6h5v1H3zm0 2h3v1H3zm0 2h3v1H3zm0 2h5v1H3z"
        fill="currentColor"
      />
    </svg>
  </template>

  <template #format-switch-button>
    <span class="sr-only">Switch format</span>

    <svg
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      width="16"
      height="15"
      viewBox="0 0 16 15"
    >
      <path
        d="M8 15l5-5-1-1-4 2-4-2-1 1zm4-9l1-1-5-5-5 5 1 1 4-2z"
        fill="currentColor"
      />
    </svg>
  </template>
</ColorPicker>
                <!-- picker -->
          </div>
      </template>
      <template #footer>
        <jet-button data-dismiss="modal">
          Cancel
        </jet-button>
        <jet-button class="ml-2" @click="updateColor">
          Update
        </jet-button>
      </template>
    </jet-dialog-modal>

          <!-- end content here -->
      <!-- </div>
    </div> -->
          </div>
          <!-- end content -->
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import ColorPickerInput from '@/Jetstream/ColorPickerInput'
import { ColorPicker } from 'vue-accessible-color-picker'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetButton from '@/Jetstream/Button'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        ColorPicker,
        ColorPickerInput,
        JetDialogModal,
        JetButton,

        // 'chrome-picker': Chrome,
       // 'popu-color-picker': colorPicker
    },
    data(){
        return{
            settings:[],
            isloading:false,
            imgpreview: null,
             isloader: false,
              bootstrap: null,
              childColor: null,


        }
    },
    created() {
        this.getSettings()
    },
    methods: {
        getSettings(){
            this.isloading = true
            ApiManager.getSettings().then((response)=>{
                this.isloading = false
                this.settings = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        updateColor(){
          console.log('save color ')
            this.bootstrap = $('#colorModal')
            this.bootstrap.modal('toggle')
          this.saveSetting(this.childColor)
        },
        saveSetting(setting){
            this.isloading = true
            ApiManager.saveSetting(setting).then((response)=>{
                this.isloading = false
                this.showToast('Setting saved')
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        onDragColor (eventData) {
          this.childColor.value = eventData.cssColor
     // this.colorx = eventData.cssColor
     // child.value = eventData.cssColor
     // console.log('this coorlor '+eventData.cssColor)
      console.log('this colors  '+JSON.stringify(this.childColor))
      //this.saveSetting(child)
    },
    showcolor(child){
       console.log('showcolor')
       this.childColor = child
        this.bootstrap = $('#colorModal')
            this.bootstrap.modal('toggle')
    },
                        uploadImage(index){
            this.$refs[`myFile${index}`].click();
        },
                updatePhotoPreview(index,child) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.imgpreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs[`myFile${index}`].files[0]);
       let formData = new FormData();
       formData.append('_method', 'PUT');
        formData.append('image',this.$refs[`myFile${index}`].files[0]);
         this.isloader = true
            ApiManager.saveImageSetting(child.id,formData).then((response) => {
                this.isloader = false
                 if(response.data.code == 0){

                     this.showToast('Ads Image Updated')
                 }
            })
            .catch((error) => {
                console.log(JSON.stringify(error));
            });
    },
    }
}
</script>
<style scoped>
.sr-only {
  position: absolute;
  overflow: hidden;
  clip: rect(0 0 0 0);
  width: 1px;
  height: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
  white-space: nowrap;
}
</style>
