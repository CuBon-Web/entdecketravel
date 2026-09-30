<template>
    <div class="tour-editor">
      <div class="tour-steps">
        <button type="button" class="tour-step" :class="{ active: step === 1 }" @click="step = 1">1. Thông tin chính</button>
        <button type="button" class="tour-step" :class="{ active: step === 2 }" @click="step = 2">2. Lịch trình <span>{{ objData.ingredient.length }} ngày</span></button>
        <button type="button" class="tour-step" :class="{ active: step === 3 }" @click="openContent()">3. Nội dung & ảnh</button>
      </div>
      <div class="entry-checks">
        <span v-for="item in entryChecks" :key="item.label" :class="{ done: item.done }">{{ item.label }}</span>
      </div>

      <div class="row" v-show="step === 1">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="section-title">Định danh và giá</h4>
              <p class="section-hint">Nhập những thông tin quyết định tour trước. Nội dung dài và ảnh nằm ở bước 3.</p>
              <div class="form-group">
                <label>Tên tour</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên tour"
                  class="w-100"
                  v-model="objData.name"
                />
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label>Điểm đi</label>
                  <vs-input type="text" class="w-100" placeholder="Hà Nội" v-model="objData.thickness" />
                </div>
                <div class="form-group col-md-4">
                  <label>Điểm đến</label>
                  <vs-input type="text" class="w-100" placeholder="Ninh Bình, Hạ Long..." v-model="objData.origin" />
                </div>
                <div class="form-group col-md-4">
                  <label>Thời lượng</label>
                  <vs-input type="text" class="w-100" placeholder="VD: 2 ngày 1 đêm" v-model="objData.hang_muc" />
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả ngắn</label>
                <vs-textarea v-model="objData.description[0].content" />
                 <div class="dropLanguage" v-if="showLang.description == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <vs-textarea v-if="index != 0" v-model="objData.description[index].content" />
                    </div>
                </div>
              </div>
              <div class="row">
              <div class="form-group col-4">
                <label>Giá người lớn</label>
                <vs-input
                  type="number"
                  size="default"
                  icon="all_inclusive"
                  class="w-100"
                  v-model="objData.price[0].content"
                />
                 <div class="dropLanguage" v-if="showLang.price == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <vs-input
                          v-if="index != 0"
                            type="number"
                            size="default"
                            icon="all_inclusive"
                            class="w-100"
                            v-model="objData.price[index].content"
                          />
                    </div>
                </div>
              </div>
              <div class="form-group col-4">
                <label>Giá trẻ em</label>
                <vs-input
                  type="number"
                  size="default"
                  icon="all_inclusive"
                  class="w-100"
                  v-model="objData.price_chil[0].content"
                />
                 <div class="dropLanguage" v-if="showLang.price_chil == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <vs-input
                          v-if="index != 0"
                            type="number"
                            size="default"
                            icon="all_inclusive"
                            class="w-100"
                            v-model="objData.price_chil[index].content"
                          />
                    </div>
                </div>
              </div>
              <div class="form-group col-4" v-if="variantstatus == false">
                <label>Giá chưa khuyến mãi</label>
                <vs-input
                  type="number"
                  size="default"
                  icon="all_inclusive"
                  class="w-100"
                  v-model="objData.discount[0].content"
                />
                 <div class="dropLanguage" v-if="showLang.discount == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <vs-input
                          v-if="index != 0"
                            type="number"
                            size="default"
                            icon="all_inclusive"
                            class="w-100"
                            v-model="objData.discount[index].content"
                          />
                    </div>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Price includes</label>
                  <p class="section-hint">Mỗi dòng là một mục đã bao gồm trong giá.</p>
                  <vs-textarea v-model="priceIncludesText" />
                </div>
                <div class="form-group col-md-6">
                  <label>Price excludes</label>
                  <p class="section-hint">Mỗi dòng là một mục không bao gồm trong giá.</p>
                  <vs-textarea v-model="priceExcludesText" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="section-title">Phân loại</h4>
              <div class="form-group">
                <label>Trạng thái</label>
                <vs-select v-model="objData.status">
                  <vs-select-item value="1" text="Còn hàng" />
                  <vs-select-item value="0" text="Hết hàng" />
                </vs-select>
              </div>
              <div class="form-group">
                <label>Danh mục tour</label>
                <vs-select
                  class="selectExample"
                  v-model="objData.category"
                  placeholder="Danh mục"
                  @change="findCategoryType()"
                >
                <vs-select-item
                    value="0"
                    text="Không danh mục"
                  />
                  <vs-select-item
                    :value="item.id"
                    :text="JSON.parse(item.name)[0].content"
                    v-for="(item, index) in cate"
                    :key="'f' + index"
                  />
                </vs-select>
              </div>
              <div class="form-group">
                <label>Danh mục cấp 1</label>
                <vs-select
                  class="selectExample"
                  v-model="objData.type_cate"
                  placeholder="Loại"
                  :disabled=" type_cate.length == 0"
                  @change="findCategoryTypeTwo()"
                >
                  <vs-select-item
                    :value="item.id"
                    :text="JSON.parse(item.name)[0].content"
                    v-for="(item, index) in type_cate"
                    :key="'v' + index"
                  />
                </vs-select>
              </div>
              <div class="form-group">
                <label>Thẻ tags cho sản phẩm</label>
                <vs-select
                    multiple
                    class="selectExample"
                    v-model="objData.tags"
                    @change="syncTagCateFromSelectedTags"
                    placeholder="--Chọn--"
                    >
                    <div :key="index" v-for="item,index in tags">
                      <vs-select-group :title="item.name" v-if="item.tags">
                        <vs-select-item :key="index" :value="i.slug" :text="i.name" v-for="i,index in item.tags"/>
                      </vs-select-group>
                    </div>
                </vs-select>
              </div>
              <div class="form-group">
                <label>Tour nổi bật</label>
                <vs-select v-model="objData.discountStatus">
                  <vs-select-item value="1" text="Có" />
                  <vs-select-item value="0" text="Không" />
                </vs-select>
              </div>
              <div class="form-group">
                <label>Hiển thị trang chủ</label>
                <vs-select v-model="objData.home_status">
                  <vs-select-item value="1" text="Có" />
                  <vs-select-item value="0" text="Không" />
                </vs-select>
              </div>
            </div>
          </div> 
        </div>
      </div>
      <div class="row" v-show="step === 2">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="day-toolbar">
                <div>
                  <h4 class="section-title">Lịch trình theo ngày</h4>
                  <p class="section-hint">Mỗi khối là một ngày. Có thể đổi thứ tự hoặc nhân bản ngày giống nhau.</p>
                </div>
                <vs-button size="small" @click="addInput('ingredient')">Thêm ngày</vs-button>
              </div>
              <div class="day-card" v-for="(item, index) in objData.ingredient" :key="'day-' + index">
                <div class="day-head">
                  <strong>Ngày {{ index + 1 }}</strong>
                  <div class="day-actions">
                    <button type="button" @click="moveDay(index, -1)" :disabled="index === 0">Lên</button>
                    <button type="button" @click="moveDay(index, 1)" :disabled="index === objData.ingredient.length - 1">Xuống</button>
                    <button type="button" @click="duplicateDay(index)">Nhân bản</button>
                    <button type="button" class="danger" v-if="objData.ingredient.length > 1" @click="remoteAr(index, 'ingredient')">Xóa</button>
                  </div>
                </div>
                <vs-input
                  type="text"
                  class="w-100"
                  placeholder="Tiêu đề ngày, ví dụ: Hà Nội - Ninh Bình"
                  v-model="objData.ingredient[index].title[0].content"
                />
                <TinyMce
                  v-if="step === 2"
                  class="day-editor"
                  :height="320"
                  v-model="objData.ingredient[index].content[0].content"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row" v-show="step === 3">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="section-title">Ảnh và nội dung chi tiết</h4>
              <div class="form-group">
                <label>Ảnh tour</label>
                <ImageMulti v-if="contentMounted" v-model="objData.images" :title="'san-pham'"/>
              </div>
              <div class="form-group">
                <label>Nội dung</label>
                <TinyMce v-if="contentMounted" v-model="objData.content[0].content" />
                <div class="dropLanguage" v-if="showLang.content == true">
                  <div class="form-group" v-for="item,index in lang" :key="index">
                    <label v-if="index != 0">{{item.name}}</label>
                    <TinyMce v-if="index != 0 && contentMounted" v-model="objData.content[index].content" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="step-nav">
        <vs-button type="border" v-if="step > 1" @click="step = step - 1">Quay lại</vs-button>
        <vs-button v-if="step < 3" @click="goNext()">Tiếp tục</vs-button>
      </div>
      <div class="row fixxed">
        <div class="col-12">
          <div class="saveButton">
            <vs-button color="primary" @click="saveProducts">Lưu tour</vs-button>
          </div>
        </div>
      </div>
    </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ImageMulti from "../_common/upload_image_multi";
import "tinymce/icons/default/icons.min.js";
import InputTag from "vue-input-tag";
import InputColorPicker from "vue-native-color-picker";
export default {
  name: "product",
  data() {
    return {
      cate: [],
      step: 1,
      contentMounted: false,
      priceIncludesText: "",
      priceExcludesText: "",
      joke: {
        avatar: "delete-sign--v2.png",
      },
      type_cate: [],
      tags: [],
      checkBox1:{
        roleid:[]
      },
      linhtinh:[],
      
      type_two:[],
      showLang: {
        title: false,
        content: false,
        description: false,
        price: false,
        price_chil:false,
        discount:false
      },
      variant_value:[],
      variant:[],
      variant_item:{},
      variantstatus:false,
      lang: [],
      errors: [],
      cateservice:[],
      objData: {
        lang: "",
        variant:[],
        name: "",
        size: [
          {
            title: "",
            detail: ""
          },
        ],
        tags:[],
        tag_cate: 0,
        price: [
          {
            lang_code: "vi",
            content: 0,
          },
        ],
        price_chil:[
          {
            lang_code: "vi",
            content: 0,
          },
        ],
        discount: [
          {
            lang_code: "vi",
            content: 0,
          },
        ],
        preserve:[
        {
            date_name: "",
            detail_date: [
              {
                name: ""
              }
            ]
          },
        ],
        ingredient:[
          {
            title: [
              {
                lang_code: "vi",
                content: "",
              },
              {
                lang_code: "en-US",
                content: "",
              },
            ],
            image: "",
            content:[
              {
                lang_code: "vi",
                content: "",
              },
              {
                lang_code: "en-US",
                content: "",
              },
            ]
          },
        ],
        images: [],
        qty: "",
        description: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        content: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        category: 0,
        status: 1,
        discountStatus:0,
        type_cate: 0,
        type_two:0,
        species:[
          {
            detail: ""
        }
        ],
        origin: "",
        thickness: "",
        hang_muc: "",
        service_id:0,
        lungtung:[],
        status_variant: 0,
        home_status: 0
      },
    };
  },
  components: {
    TinyMce,
    ImageMulti,
    InputTag,
    "v-input-colorpicker": InputColorPicker
  },
  computed: {
    entryChecks() {
      const content = this.objData.content && this.objData.content[0] ? this.objData.content[0].content : "";
      const description = this.objData.description && this.objData.description[0] ? this.objData.description[0].content : "";
      const price = this.objData.price && this.objData.price[0] ? Number(this.objData.price[0].content) : 0;
      const images = Array.isArray(this.objData.images) ? this.objData.images.length : 0;
      return [
        { label: "Tên", done: !!(this.objData.name && String(this.objData.name).trim()) },
        { label: "Danh mục", done: Number(this.objData.category) !== 0 },
        { label: "Giá người lớn", done: price > 0 },
        { label: "Mô tả ngắn", done: !!String(description || "").trim() },
        { label: "Ảnh", done: images > 0 },
        { label: "Nội dung", done: !!String(content || "").trim() },
      ];
    },
  },
  watch: {
  },
  methods: {
    ...mapActions([
      "editId",
      "saveProduct",
      "listCate",
      "loadings",
      "listLanguage",
      "findTypeCate",
      "findTypeCateTwo",
      "listCateService",
      "listVariant",
      "listVariantValue",
      "findTags"
    ]),
    getValuebuildSkua(variant_value, variant){
      if(this.linhtinh.length == 0){
        this.linhtinh.push(this.getValuebuildSku(variant_value, variant));
      }else{
        this.linhtinh.forEach((element, key) => { 
          if(this.linhtinh.some(data => data.display_name === variant)){
            console.log(1);
            // console.log(variant_value, element.display_name)
            if(!element.option_values.some(data => data.label === variant_value) && this.linhtinh[key].display_name == variant){
              var obj = {};
              obj.label = variant_value;
              obj._id = 13
              this.linhtinh[key].option_values.push(obj);
            }else if(element.option_values.some(data => data.label === variant_value)){
              const idxObj = this.linhtinh[key].option_values.findIndex(obj => {
                return obj.label === variant_value;
              });
              this.linhtinh[key].option_values.splice(idxObj, 1);
            }
          }else{
            this.linhtinh.push(this.getValuebuildSku(variant_value, variant));
          }
        });
      }
      this.objData.variant = this.linhtinh;
      let sets = [[]];
      const id_obj = {};
      this.linhtinh.forEach(option => {
        const new_sets = [];
        option.option_values.forEach(({ label, _id }) => {
          new_sets.push(Array.from(sets, set => [...set, label]));
          id_obj[label] = { id: option._id, value_id: _id };
        });
        sets = new_sets.flatMap(set => set);
      });

      this.objData.lungtung =  sets.map(set => ({
        price: 0,
        qty:0, 
        version: set.join("-"),
        sku: "",
        option_values: set.map(label => ({ option_id: id_obj[label].value_id, id: id_obj[label].id }))
      }));

    },
    getValuebuildSku(variant_value, variant){
      var arr = [];
      var objOtion = {
        option_values:[]
      };
      objOtion.display_name = variant;
        var obj = {};
        obj._id = 12;
        obj.label = variant_value;
        objOtion.option_values.push(obj);
        
      return objOtion;
    },
    choiseVariant(event){
      
      this.objData.status_variant = 1;
      this.listVariantValue({id:event.id}).then(response => {
        if (this.variant_value.length == 0) {
          var obj = {};
          obj.name = event.name;
          obj.value = response.data;
          this.variant_value.push(obj);
        }else if(!this.variant_value.some(data => data.name === event.name)){
          var obj = {};
          obj.name = event.name;
          obj.value = response.data;
          this.variant_value.push(obj);
        }
      }).catch(error => {

      })
    },
    syncTagCateFromSelectedTags() {
      const selectedTags = Array.isArray(this.objData.tags) ? this.objData.tags : [];
      if (selectedTags.length === 0) {
        this.objData.tag_cate = 0;
        return;
      }

      const matchedTagCate = this.tags.find((tagCate) => {
        return Array.isArray(tagCate.tags) && tagCate.tags.some((tag) => selectedTags.includes(tag.slug));
      });

      this.objData.tag_cate = matchedTagCate ? Number(matchedTagCate.id) : 0;
    },
    openContent() {
      this.step = 3;
      this.contentMounted = true;
    },
    goNext() {
      if (this.step < 3) this.step += 1;
      if (this.step === 3) this.contentMounted = true;
    },
    moveDay(index, direction) {
      const target = index + direction;
      const list = this.objData.ingredient;
      if (!list || target < 0 || target >= list.length) return;
      const current = list[index];
      this.$set(list, index, list[target]);
      this.$set(list, target, current);
    },
    duplicateDay(index) {
      const copy = JSON.parse(JSON.stringify(this.objData.ingredient[index]));
      this.objData.ingredient.splice(index + 1, 0, copy);
    },
    linesToList(value) {
      return String(value || "")
        .split(/\r?\n/)
        .map((line) => line.trim())
        .filter((line) => line !== "");
    },
    listToLines(value) {
      if (!value) return "";
      let list = value;
      if (typeof value === "string") {
        try {
          list = JSON.parse(value);
        } catch (e) {
          return value;
        }
      }
      return Array.isArray(list) ? list.join("\n") : "";
    },
    syncPriceNotes() {
      this.objData.price_includes = this.linesToList(this.priceIncludesText);
      this.objData.price_excludes = this.linesToList(this.priceExcludesText);
    },
    saveProducts() {
      this.errors = [];
      this.syncTagCateFromSelectedTags();
      this.syncPriceNotes();
     if(this.objData.name == '') this.errors.push('Tên không được để trống');
      if(this.objData.content[0].content == '') this.errors.push('Nội dung không được để trống');
      if(this.objData.description[0].content == '') this.errors.push('Mô tả không được để trống');
      if(this.objData.images.length == 0) this.errors.push('Vui lòng chọn ảnh');
      if(this.objData.category == 0) this.errors.push('Chọn danh mục tour');
      if(this.objData.price == 0) this.errors.push('Nhập giá người lớn');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value);
        });
        return;
      } else {
        this.loadings(true);

        this.saveProduct(this.objData)
          .then((response) => {
            this.loadings(false);
            this.$router.push({ name: "listProduct" });
            this.$success("Thêm tour thành công");
            this.$route.push({ name: "listProduct" });
          })
          .catch((error) => {
            this.loadings(false);
            // this.$vs.notify({
            //   title: "Thất bại",
            //   text: "Thất bại",
            //   color: "danger",
            //   position: "top-right"
            // });
          });
      }
    },
    
    findCategoryType() {
      this.findTypeCate(this.objData.category).then((response) => {
        this.type_cate = response.data;
      });
     
    },
    listVariants(){
      this.listVariant().then(response => {
        this.variant = response.data
      }).catch(error => {

      })
    },
    findCategoryTypeTwo() {
      this.findTypeCateTwo(this.objData.type_cate).then((response) => {
        this.type_two = response.data;
      });
    },
    addDetailTask(key,index){
      var oj = {};
      if(key =='preserve'){
        oj.name = "";
        this.objData.preserve[index].detail_date.push(oj);
      }
    },
    remoteDetailTaskr(index,keytaskdetail) {
        this.objData.preserve[index].detail_date.splice(keytaskdetail, 1);
    },
    remoteAr(index,key) {
      if(key == 'size'){
        this.objData.size.splice(index, 1);
      }
      if(key == 'ingredient'){
        this.objData.ingredient.splice(index, 1);
      }
      if(key == 'preserve'){
        this.objData.preserve.splice(index, 1);
      }
        if(key == 'species'){
        this.objData.species.splice(index, 1);
      }
    },
    addInput(key) {
        var oj = {};
        if(key =='preserve'){
          oj.date_name = "";
          oj.detail_date = [
              {
                name: ""
              }
            ];
          this.objData.preserve.push(oj);
        }
        if(key =='ingredient'){
          oj.title =  [
              {
                lang_code: "vi",
                content: "",
              },
              {
                lang_code: "en-US",
                content: "",
              },
            ];
          oj.image = "";
          oj.content =  [
              {
                lang_code: "vi",
                content: "",
              },
              {
                lang_code: "en-US",
                content: "",
              },
            ];
          this.objData.ingredient.push(oj);
        }
        if(key =='species'){
          oj.detail = "";
          this.objData.species.push(oj);
        }
        if(key =='size'){
          oj.title = "";
          oj.detail = "";
          this.objData.size.push(oj);
        }
    },
    showSettingLangExist(value, name = "content") {
      if (value == "discount") {
        this.showLang.discount = !this.showLang.discount;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.discount[index] &&
            value.code != this.objData.discount[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = 0;
            this.objData.discount.push(oj);
          }
        });
      }
      if (value == "price_chil") {
        this.showLang.price_chil = !this.showLang.price_chil;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.price_chil[index] &&
            value.code != this.objData.price_chil[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = 0;
            this.objData.price_chil.push(oj);
          }
        });
      }
      if (value == "price") {
        this.showLang.price = !this.showLang.price;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.price[index] &&
            value.code != this.objData.price[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = 0;
            this.objData.price.push(oj);
          }
        });
      }
      if (value == "content") {
        this.showLang.content = !this.showLang.content;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.content[index] &&
            value.code != this.objData.content[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.content.push(oj);
          }
        });
      }
      if (value == "description") {
        this.showLang.description = !this.showLang.description;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.description[index] &&
            value.code != this.objData.description[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.description.push(oj);
          }
        });
      }
    },
    listLang() {
      this.listLanguage()
        .then((response) => {
          this.loadings(false);
          this.lang = response.data;
        })
        .catch((error) => {});
    },
  },
  mounted() {
    this.loadings(true);
    this.listCate().then((response) => {
      this.loadings(false);
      this.cate = response.data;
    });
    this.findTags().then((response) => {
        this.tags = response.data;
      });
     this.listCateService().then((response) => {
      this.loadings(false);
      this.cateservice = response.data;
    });
    this.listVariants();
    this.listLang();
  },
};
</script>
<style scoped>
.tour-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 12px;
}
.tour-step {
  border: 1px solid #d9dde7;
  background: #fff;
  color: #3d4465;
  border-radius: 8px;
  padding: 8px 14px;
  font-weight: 600;
  cursor: pointer;
}
.tour-step span {
  font-weight: 500;
  opacity: 0.7;
}
.tour-step.active {
  background: #7367f0;
  border-color: #7367f0;
  color: #fff;
}
.entry-checks {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 14px;
}
.entry-checks span {
  background: #fff4e5;
  color: #9a6700;
  border-radius: 999px;
  padding: 3px 10px;
  font-size: 12px;
}
.entry-checks span.done {
  background: #e7f8ef;
  color: #1b7f4e;
}
.section-title {
  margin-bottom: 4px;
  font-size: 16px;
}
.section-hint {
  color: #7b8198;
  font-size: 13px;
  margin-bottom: 14px;
}
.day-toolbar,
.day-head,
.step-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.day-toolbar {
  margin-bottom: 12px;
}
.day-card {
  border: 1px solid #e6e8f0;
  border-radius: 10px;
  padding: 14px;
  margin-bottom: 12px;
  background: #fafbff;
}
.day-head {
  margin-bottom: 10px;
}
.day-editor {
  display: block;
  margin-top: 10px;
}
.day-actions {
  display: flex;
  gap: 6px;
}
.day-actions button {
  border: 1px solid #d9dde7;
  background: #fff;
  border-radius: 6px;
  padding: 4px 8px;
  cursor: pointer;
}
.day-actions button:disabled {
  opacity: 0.4;
  cursor: default;
}
.day-actions button.danger {
  color: #d32f2f;
}
.step-nav {
  justify-content: flex-end;
  margin: 8px 0 70px;
}
.con-select .vs-select {
  width: 100%;
}
</style>