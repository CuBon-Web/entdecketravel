<template>
  <div>
      <h3 class="page-title">Thư viện ảnh</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Ảnh trong album</label>
                    <label style="float: right;cursor: pointer" title="Xóa album" v-if="key != 0" @click="removeObjPartner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <upload-image-multi
                      v-model="item.images"
                      :multiple="true"
                      :title="'album-' + key"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Tên album</label>
                    <vs-input
                      type="text"
                      v-model="item.name"
                      size="default"
                      placeholder="Tên album"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Link</label>
                    <vs-input
                      type="text"
                      v-model="item.link"
                      size="default"
                      placeholder="Link liên kết (bỏ trống nếu không có)"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <vs-select v-model="item.status">
                      <vs-select-item value="1" text="Hiện" />
                      <vs-select-item value="0" text="Ẩn" />
                    </vs-select>
                  </div>
                </div>
                <hr style="border: 0.5px solid #04040426; width: 100%;">
              </div>
              <vs-button color="primary" @click="saveAlbumAffters">Lưu</vs-button>
              <vs-button color="success" @click="addObjPartner">Thêm album</vs-button>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import UploadImageMulti from "../_common/upload_image_multi";
export default {
  name: "prize",
  components: {
    UploadImageMulti,
  },
  data() {
    return {
      objData: [
        {
          name: "",
          image: "",
          images: [""],
          status: 1,
          link: "",
        },
      ],
    };
  },
  methods: {
    ...mapActions(["saveAlbumAffter", "loadings", "listAlbumAffter"]),
    normalizeAlbumRow(row) {
      let images = [];
      if (Array.isArray(row.images)) {
        images = row.images.filter((p) => p !== null && p !== "");
      } else if (row.images && typeof row.images === "string") {
        try {
          const parsed = JSON.parse(row.images);
          if (Array.isArray(parsed)) {
            images = parsed.filter((p) => p !== null && p !== "");
          }
        } catch (e) {
          images = [];
        }
      }
      if (images.length === 0 && row.image) {
        images = [row.image];
      }
      if (images.length === 0) {
        images = [""];
      }
      const st = row.status;
      return {
        name: row.name || "",
        link: row.link || "",
        status: st === "" || st === undefined || st === null ? 1 : st,
        image: images[0] || "",
        images: images.slice(),
      };
    },
    payloadRow(item) {
      const imgs = (item.images || []).filter((p) => p !== null && p !== "");
      return {
        name: item.name,
        link: item.link,
        status: item.status,
        images: imgs,
        image: imgs[0] || "",
      };
    },
    saveAlbumAffters() {
      this.loadings(true);
      const data = this.objData.map((item) => this.payloadRow(item));
      this.saveAlbumAffter({ data })
        .then(() => {
          this.loadings(false);
          this.$success("Lưu album thành công");
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Lưu album thất bại");
        });
    },
    addObjPartner() {
      this.objData.push({
        name: "",
        image: "",
        images: [""],
        status: 1,
        link: "",
      });
    },
    removeObjPartner(i) {
      this.objData.splice(i, 1);
    },
    listBanners() {
      this.loadings(true);
      this.listAlbumAffter()
        .then((response) => {
          this.loadings(false);
          if (response.data && response.data.length > 0) {
            this.objData = response.data.map((row) => this.normalizeAlbumRow(row));
          } else {
            this.objData = [
              {
                name: "",
                image: "",
                images: [""],
                status: 1,
                link: "",
              },
            ];
          }
        })
        .catch(() => {
          this.loadings(false);
        });
    },
  },
  mounted() {
    this.listBanners();
  },
};
</script>
