<template>
  <div>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            
            <div class="form-group">
              <label>Tên dịch vụ</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Tên bài viết"
                class="w-100"
                v-model="objData.name[0].content"
              />
              <el-button size="small" @click="showSettingLangExist('name')">Đa ngôn ngữ</el-button>
                 <div class="dropLanguage" v-if="showLang.name == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <vs-input  class="w-100" font-size="40px" v-if="index != 0" v-model="objData.name[index].content" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <TinyMce
                  v-model="objData.content[0].content"
                />
                <el-button size="small" @click="showSettingLangExist('content')">Đa ngôn ngữ</el-button>
                 <div class="dropLanguage" v-if="showLang.content == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <TinyMce v-if="index != 0" v-model="objData.content[index].content" />
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Mô tả ngắn</label>
                <TinyMce
                  v-model="objData.description[0].content"
                />
                <el-button size="small" @click="showSettingLangExist('description')">Đa ngôn ngữ</el-button>
                 <div class="dropLanguage" v-if="showLang.description == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <TinyMce v-if="index != 0" v-model="objData.description[index].content" />
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload
                  v-model="objData.image"
                  type="avatar"
                  :title="'service-'"
                ></image-upload>
              </div>
              <div class="form-group">
                <label>Giá</label>
                <vs-input
                  type="number"
                  size="default"
                  icon="all_inclusive"
                  class="w-100"
                  v-model="objData.price[0].content"
                />
                <el-button size="small" @click="showSettingLangExist('price')">Đa ngôn ngữ</el-button>
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
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Trạng thái</label>
              <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Hiện" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
            <div class="form-group">
              <label>Hiển thị trang chủ</label>
              <vs-select v-model="objData.home_status">
                <vs-select-item value="1" text="Hiện" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <vs-select
                  class="selectExample"
                  v-model="objData.cate_id"
                  placeholder="Danh mục"
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
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="addServices">Thêm mới</vs-button>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
export default {
  name: "product",
  data() {
    return {
      errors: [],
      cate: [],
      lang: [],
      showLang: {
        name: false,
        content: false,
        description: false,
        price:false
      },
      objData: {
        name: [
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
        description: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        status: 1,
        home_status:0,
        image: "",
        price:[
          {
            lang_code: "vi",
            content: 0,
          },
        ],
        cate_id: 0
      },
    };
  },
  components: {
    TinyMce,
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions([ 
      "addService",
      "loadings",
      "listLanguage",
      "listCateService"
    ]),
    listLang() {
      this.listLanguage()
        .then((response) => {
          this.loadings(false);
          this.lang = response.data;
        })
        .catch((error) => {});
    },
    showSettingLangExist(value, name = "content") {
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
      if (value == "name") {
        this.showLang.name = !this.showLang.name;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.name[index] &&
            value.code != this.objData.name[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.name.push(oj);
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
    addServices() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên không được để trống');
      if(this.objData.content[0].content == '') this.errors.push('Nội dung không được để trống');
      if(this.objData.description[0].content == '') this.errors.push('Mô tả không được để trống');
      if(this.objData.cate_id == 0) this.errors.push('Chọn danh mục');
      if (this.objData.image == "") this.errors.push("Vui lòng chọn ảnh");
      if(this.objData.price[0].content == 0) this.errors.push('Nhập giá dịch vụ ');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value);
        });
        return;
      } else {
        this.loadings(true);
        this.addService(this.objData)
          .then((response) => {
            this.loadings(false);
            this.$router.push({ name: "listService" });
            this.$success("Thêm banner thành công");
          })
          .catch((error) => {
            this.loadings(false);
            this.$error("Thêm banner thất bại");
          });
      }
    }
  },
  mounted() {
     this.listCateService().then((response) => {
      this.loadings(false);
      this.cate = response.data;
    });
    this.listLang();
  },
};
</script>