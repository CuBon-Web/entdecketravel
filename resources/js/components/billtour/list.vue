<template>
  <div>
    <h3 class="page-title">Đơn hàng tour</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row" v-if="items.length == 0">
              <div class="col-md-2"></div>
              <div class="col-md-4">
                <div class="mb-0 flex-grow">
                  <h5 class="mr-2 mb-2">Quản lý đơn hàng tour</h5>
                  <p class="mb-0 font-weight-light">
                    Chưa có đơn hàng tour nào.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <img width="100%" height="400" src="http://bizweb.dktcdn.net/assets/admin/images/empty-states/customer.svg">
              </div>
              <div class="col-md-2"></div>
            </div>
            <vs-input
              v-if="items.length > 0"
              icon="search"
              placeholder="Tìm theo tên/điện thoại/email"
              v-model="keyword"
              @keyup="debouncedSearch"
            />
            <vs-table max-items="10" pagination :data="items" v-if="items.length > 0">
              <template slot="thead">
                <vs-th>#</vs-th>
                <vs-th>Thời gian</vs-th>
                <vs-th>Khách hàng</vs-th>
                <vs-th>Điện thoại</vs-th>
                <vs-th>Email</vs-th>
                <vs-th>Số người</vs-th>
                <vs-th>Ngày đi</vs-th>
                <vs-th>Loại</vs-th>
                <vs-th>Tổng</vs-th>
                <vs-th>Hành động</vs-th>
              </template>
              <template slot-scope="{data}">
                <vs-tr :key="'row'+indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="tr.id">#{{ tr.id }}</vs-td>
                  <vs-td :data="tr.created_at">{{ formatDate(tr.created_at) }}</vs-td>
                  <vs-td :data="tr.name">{{ tr.name }}</vs-td>
                  <vs-td :data="tr.phone">{{ tr.phone }}</vs-td>
                  <vs-td :data="tr.email">{{ tr.email }}</vs-td>
                  <vs-td :data="tr.nguoilon">{{ tr.nguoilon }}</vs-td>
                  <vs-td :data="tr.travel_date">{{ travelDateLabel(tr) }}</vs-td>
                  <vs-td :data="tr.request_type">{{ requestLabel(tr.request_type) }}</vs-td>
                  <vs-td :data="tr.total">{{ formatMoney(tr.total) }}</vs-td>
                  <vs-td :data="tr.id">
                    <router-link :to="{ name: 'bill_tour_detail', params: { id: tr.id } }">
                      <vs-button vs-type="gradient" size="lagre" color="success" icon="visibility"></vs-button>
                    </router-link>
                    <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDelete(tr.id)"></vs-button>
                  </vs-td>
                </vs-tr>
              </template>
            </vs-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data: () => ({
    keyword: "",
    items: [],
    timer: 0,
  }),
  methods: {
    ...mapActions(["listBillTour", "deleteBillTour", "loadings"]),
    formatDate(value) {
      if (!value) return "";
      const date = new Date(value);
      const month = (date.getMonth() + 1);
      const mm = month > 9 ? month : `0${month}`;
      const day = date.getDate() > 9 ? date.getDate() : `0${date.getDate()}`;
      return `${date.getFullYear()}-${mm}-${day}`;
    },
    requestLabel(type) {
      if (type === 'quote') return 'Báo giá';
      if (type === 'enquiry') return 'Đặt tour';
      return 'Đặt tour';
    },
    travelDateLabel(row) {
      if (!row) return '';
      if (row.date_type === 'flexible') return 'Linh hoạt';
      if (!row.travel_date) return '';
      return String(row.travel_date).slice(0, 10);
    },
    formatMoney(value) {
      if (value === null || value === undefined) return '';
      try {
        return new Intl.NumberFormat('vi-VN').format(Number(value));
      } catch (e) {
        return value;
      }
    },
    fetchList() {
      this.loadings && this.loadings(true);
      this.listBillTour({ keyword: this.keyword })
        .then((res) => {
          this.items = (res && res.data && res.data.data) ? res.data.data : (res.data || []);
        })
        .finally(() => {
          this.loadings && this.loadings(false);
        });
    },
    debouncedSearch() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
        this.fetchList();
      }, 500);
    },
    doDelete(id) {
      this.loadings && this.loadings(true);
      this.deleteBillTour(id)
        .then(() => {
          this.$vs.notify({
            title: "Xóa đơn hàng tour",
            text: "Thành công",
            color: "success",
            position: "top-right",
          });
          this.fetchList();
        })
        .finally(() => {
          this.loadings && this.loadings(false);
        });
    },
    confirmDelete(id) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Bạn có chắc chắn`,
        text: "Xóa đơn hàng tour này",
        accept: () => this.doDelete(id),
      });
    },
  },
  mounted() {
    this.fetchList();
  },
};
</script>

<style>
</style>

