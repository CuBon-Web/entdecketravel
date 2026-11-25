<template>
  <div>
    <div class="form-group">
      <label>SEO title</label>
      <vs-input
        class="w-100"
        v-model="titleValue"
        placeholder="Tiêu đề trên Google. Sửa ô này không đổi đường link."
      />
      <small :style="{ color: titleLength > 60 ? '#c0392b' : '#6b7280' }">{{ titleLength }}/60. Google cắt tiêu đề dài hơn 60 ký tự.</small>
    </div>
    <div class="form-group">
      <label>Meta description</label>
      <vs-textarea v-model="descriptionValue" placeholder="Mô tả ngắn trên Google." />
      <small :style="{ color: descriptionLength > 160 ? '#c0392b' : '#6b7280' }">{{ descriptionLength }}/160. Google cắt mô tả dài hơn 160 ký tự.</small>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: { default: "" },
    description: { default: "" },
  },
  computed: {
    titleValue: {
      get() {
        return this.title || "";
      },
      set(value) {
        this.$emit("update:title", value);
      },
    },
    descriptionValue: {
      get() {
        return this.description || "";
      },
      set(value) {
        this.$emit("update:description", value);
      },
    },
    titleLength() {
      return this.titleValue.length;
    },
    descriptionLength() {
      return this.descriptionValue.length;
    },
  },
};
</script>
