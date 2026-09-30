<template>
  <div>
    <div v-if="multiple" class="upload-grid">
      <div
        v-for="(item, index) in uploadList"
        :key="item.uid"
        class="upload-card"
        :class="{ dragging: dragIndex === index }"
        draggable="true"
        @dragstart="onDragStart(index, $event)"
        @dragover.prevent
        @drop.prevent="onDrop(index)"
      >
        <img class="upload-card__image" :src="item.url" @click="handlePreview(item)" />
        <div class="upload-card__actions">
          <i class="el-icon-zoom-in" @click="handlePreview(item)"></i>
          <i class="el-icon-refresh-right" @click="openReplaceInput(index)"></i>
          <i class="el-icon-delete" @click="handleRemove(index)"></i>
        </div>
      </div>

      <el-upload
        action="'/upload'"
        name="img"
        class="upload-add-card"
        :show-file-list="false"
        :auto-upload="true"
        :multiple="true"
        accept="image/*"
        :http-request="handleAddRequest"
      >
        <i class="el-icon-plus"></i>
      </el-upload>
    </div>

    <el-dialog :visible.sync="dialogVisible">
      <img width="100%" :src="dialogImageUrl" alt />
    </el-dialog>

    <input
      ref="replaceInput"
      type="file"
      accept="image/*"
      class="hidden-input"
      @change="onReplaceSelected"
    />
  </div>
</template>
<script>
import imageCompression from "browser-image-compression";

export default {
  name: "uploader",
  props: {
    targetUrl: {
      type: String,
      default: "api/upload-image"
    },
    multiple: {
      type: Boolean,
      default: true
    },
    value: {
      default: () => []
    },
    title: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      dialogImageUrl: "",
      uploadList: [],
      dialogVisible: false,
      dragIndex: null,
      replaceIndex: null
    };
  },
  watch: {
    value: {
      immediate: true,
      handler(val) {
        this.uploadList = this.normalizeToUploadList(val);
      }
    }
  },
  methods: {
    getslugname(text) {
      var slug = "";
      var titleLower = (text || "").toLowerCase();
      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, "e");
      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, "a");
      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, "o");
      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, "u");
      slug = slug.replace(/đ/gi, "d");
      slug = slug.replace(/\s*$/g, "");
      slug = slug.replace(/\s+/g, "-");
      return slug;
    },
    normalizeToUploadList(val) {
      if (!val) {
        return [];
      }
      const source = Array.isArray(val) ? val : [val];
      return source
        .filter(item => item)
        .map((item, index) => {
          if (typeof item === "string") {
            return {
              url: item,
              uid: `img-${Date.now()}-${index}`
            };
          }
          return {
            ...item,
            uid: item.uid || `img-${Date.now()}-${index}`
          };
        });
    },
    emitValue() {
      this.$emit(
        "input",
        this.uploadList.map(item => item.url)
      );
    },
    handlePreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
    },
    handleRemove(index) {
      this.uploadList.splice(index, 1);
      this.emitValue();
    },
    onDragStart(index, event) {
      this.dragIndex = index;
      event.dataTransfer.effectAllowed = "move";
    },
    onDrop(dropIndex) {
      if (this.dragIndex === null || this.dragIndex === dropIndex) {
        this.dragIndex = null;
        return;
      }
      const dragged = this.uploadList.splice(this.dragIndex, 1)[0];
      this.uploadList.splice(dropIndex, 0, dragged);
      this.dragIndex = null;
      this.emitValue();
    },
    openReplaceInput(index) {
      this.replaceIndex = index;
      if (this.$refs.replaceInput) {
        this.$refs.replaceInput.value = "";
        this.$refs.replaceInput.click();
      }
    },
    async onReplaceSelected(event) {
      const file = event.target.files && event.target.files[0];
      if (!file || this.replaceIndex === null) {
        return;
      }
      const replacedIndex = this.replaceIndex;
      this.replaceIndex = null;
      try {
        const uploadedUrl = await this.uploadFile(file);
        this.$set(this.uploadList, replacedIndex, {
          ...this.uploadList[replacedIndex],
          url: uploadedUrl
        });
        this.emitValue();
      } catch (error) {
        this.$notify.error({
          message: error.message || "Upload failed"
        });
      }
    },
    async handleAddRequest(req) {
      try {
        const uploadedUrl = await this.uploadFile(req.file);
        this.uploadList.push({
          url: uploadedUrl,
          uid: `img-${Date.now()}-${this.uploadList.length}`
        });
        this.emitValue();
      } catch (error) {
        this.$notify.error({
          message: error.message || "Upload failed"
        });
      }
    },
    uploadFile(file) {
      const options = {
        maxSizeMB: 1,
        maxWidthOrHeight: 1920,
        useWebWorker: true,
        maxIteration: 10
      };
      return imageCompression(file, options).then(compressedFile => {
        return new Promise((resolve, reject) => {
          const xhr = new XMLHttpRequest();
          const formData = new FormData();
          xhr.withCredentials = false;
          xhr.open("POST", __ENV__.link + this.targetUrl);
          xhr.onload = () => {
            if (xhr.status !== 200) {
              reject(new Error("HTTP Error: " + xhr.status));
              return;
            }
            try {
              const json = JSON.parse(xhr.responseText);
              resolve(json.path.replace(__ENV__.link, "/"));
            } catch (error) {
              reject(new Error("Invalid upload response"));
            }
          };
          xhr.onerror = () => reject(new Error("Network error"));
          formData.append("img", compressedFile, file.name);
          formData.append("title_post", this.getslugname(this.title));
          xhr.send(formData);
        });
      });
    }
  }
};
</script>
<style scoped>
.upload-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.upload-card,
.upload-add-card {
  width: 148px;
  height: 148px;
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  position: relative;
  overflow: hidden;
}

.upload-card {
  cursor: move;
}

.upload-card.dragging {
  opacity: 0.6;
}

.upload-card__image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.upload-card__actions {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  color: #fff;
  background: rgba(0, 0, 0, 0.45);
  opacity: 0;
  transition: opacity 0.2s ease;
}

.upload-card:hover .upload-card__actions {
  opacity: 1;
}

.upload-card__actions i {
  cursor: pointer;
  font-size: 16px;
}

.upload-add-card ::v-deep .el-upload {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hidden-input {
  display: none;
}
</style>