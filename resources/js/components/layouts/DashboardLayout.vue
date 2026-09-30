<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <a class="menutogle" @click="toggleSidebarMobile">
        <i class="fa fa-bars fa-2x" > </i>
      </a>
    <side-bar :background-color="sidebarBackground">
      <template slot-scope="props" slot="links">
        <user-menu></user-menu>
        <sidebar-item
          :link="{
            name: 'Dashboard',
            icon: 'now-ui-icons design_app',
            path: '/',
          }"
        >
        </sidebar-item>
        <sidebar-item v-for="(i, key) in objSidebar" :key="'side'+key"
          :link="{
            name: i.name,
            icon: 'fab fa-vuejs',
          }"
        >
          <sidebar-item v-for="(item, key) in i.sub" :key="'sub'+key"
            :link="{ name: item.name, path: item.path }"
          ></sidebar-item>
        </sidebar-item>

      </template>
    </side-bar>
    <div class="main-panel">
      <sidebar-share
        :color.sync="sidebarBackground"
        :fixed-navbar.sync="fixedNavbar"
        :sidebarMini.sync="sidebarMini"
        style="cursor: pointer"
      >
      </sidebar-share>
      <router-view name="header"></router-view>

      <div
        :class="{ content: !$route.meta.hideContent }"
        @click="toggleSidebar"
      >
        <zoom-center-transition :duration="200" mode="out-in">
          <!-- your content here -->
          <router-view></router-view>
        </zoom-center-transition>
      </div>
      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>
<script>
import PerfectScrollbar from "perfect-scrollbar";
import "perfect-scrollbar/css/perfect-scrollbar.css";

function hasElement(className) {
  return document.getElementsByClassName(className).length > 0;
}

function initScrollbar(className) {
  if (hasElement(className)) {
    new PerfectScrollbar(`.${className}`);
  } else {
    // try to init it later in case this component is loaded async
    setTimeout(() => {
      initScrollbar(className);
    }, 100);
  }
}

import TopNavbar from "../layouts/dashboard/TopNavbar.vue";
import ContentFooter from "../layouts/dashboard/ContentFooter.vue";
import UserMenu from "../layouts/dashboard/Extra/UserMenu.vue";
import { SlideYDownTransition, ZoomCenterTransition } from "vue2-transitions";
import Vuex from "vuex";
import SidebarShare from "../layouts/dashboard/Extra/SidebarSharePlugin";

export default {
  components: {
    TopNavbar,
    ContentFooter,
    UserMenu,
    ZoomCenterTransition,
    SidebarShare,
  },
  data() {
    return {
      sidebarBackground: "black",
      fixedNavbar: false,
      sidebarMini: false,
      objSidebar: [
        {
          icon: "mdi mdi-crosshairs-gps menu-icon",
          name: "Tour",
          route_name: "",
          sub: [
            {
              name: "Danh sách tour",
              path: "/product",
            },
            {
              name: "Danh mục chính",
              path: "/product/category",
            },
            {
              name: "Danh mục cấp 2",
              path: "/product/type",
            },
          ],
        },
        {
          icon: "mdi mdi-crosshairs-gps menu-icon",
          name: "Quản lý thẻ tags",
          route_name: "",
          sub: [
            {
              name: "Danh sách tag",
              path: "/tag/list",
            },
            {
              name: "Danh mục tag",
              path: "/tag/category",
            }
          ],
        },
        {
          icon: "mdi mdi-crosshairs-gps menu-icon",
          name: "Đơn hàng tour",
          route_name: "",
          sub: [
            {
              name: "Danh sách đơn",
              path: "/bill_tour",
            },
          ],
        },
        {
          icon: "mdi mdi-crosshairs-gps menu-icon",
          name: "Dịch vụ",
          route_name: "",
          sub: [
            {
              name: "Danh sách",
              path: "/service",
            },
            {
              name: "Danh mục",
              path: "/service/category",
            },
          ],
        },
        {
          icon: "mdi mdi-newspaper menu-icon",
          name: "Trang nội dung",
          route_name: "",
          sub: [
            {
              name: "Danh sách ",
              path: "/pagecontent",
            }
          ],
        },
        {
          icon: "mdi mdi-newspaper menu-icon",
          name: "Quản lý bài viết",
          route_name: "",
          sub: [
            {
              name: "Danh sách bài viết",
              path: "/blogs",
            },
            {
              name: "Danh mục bài viết",
              path: "/blog/category",
            },
          ],
        },
        {
          icon: "mdi mdi-file-image menu-icon",
          name: "Website",
          route_name: "",
          sub: [
            {
              name: "Quản lý banner",
              path: "/banner",
            },
            {
              name: "Quản lý quảng cáo",
              path: "/bannerads",
            },
            {
              name: "Gallery",
              path: "/albumAffter",
            },
            {
              name: "Cài đặt chung",
              path: "/setting",
            },
             {
              name: "Quản lý Fourder",
              path: "/founder",
            },
            {
              name: "Quản lý đối tác",
              path: "/partner",
            },
            {
              name: "Quản lý text",
              path: "/language/keyword",
            },
          ],
        },
        // {
        //   icon: "mdi mdi-shopping-music menu-icon",
        //   name: "Đa ngôn ngữ",
        //   route_name: "",
        //   sub: [
        //     {
        //       name: "Danh sách ngôn ngữ",
        //       path: "/language",
        //     },
        //     {
        //       name: "Quản lý keyword",
        //       path: "/language/keyword",
        //     }
        //   ],
        // },
        {
          icon: "mdi mdi-shopping-music menu-icon",
          name: "Quản lý tin nhắn liên hệ",
          route_name: "",
          sub: [
            {
              name: "Danh sách",
              path: "/messcontact",
            }
          ],
        },
        {
          icon: "mdi mdi-newspaper menu-icon",
          name: "Quản lý Review",
          route_name: "",
          sub: [
            {
              name: "Danh sách",
              path: "/reviewCus",
            }
          ],
        },
      ],
    };
  },
  methods: {
    initScrollbar() {
      let isWindows = navigator.platform.startsWith("Win");
      if (isWindows) {
        initScrollbar("sidenav");
      }
    },
    toggleSidebarMobile(){
      if (this.$sidebar.showSidebar == false) {
        this.$sidebar.displaySidebar(true);
      }else{
        this.$sidebar.displaySidebar(false);
      }
    },
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    minimizeSidebar() {
      if (this.$sidebar) {
        this.$sidebar.toggleMinimize();
        let text = this.$sidebar.isMinimized ? "activated" : "deactivated";
        this.$notify({ type: "info", message: `Sidebar mini ${text}...` });
      }
    },
  },
  mounted() {
    let docClasses = document.body.classList;
    let isWindows = navigator.platform.startsWith("Win");
    if (isWindows) {
      // if we are on windows OS we activate the perfectScrollbar function
      initScrollbar("sidebar");
      initScrollbar("sidebar-wrapper");

      docClasses.add("perfect-scrollbar-on");
    } else {
      docClasses.add("perfect-scrollbar-off");
    }
  },
  computed: {
  },
  watch: {
    sidebarMini() {
      this.minimizeSidebar();
    },
  },
};
</script>
<style lang="scss">
$scaleSize: 0.95;
@keyframes zoomIn95 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  to {
    opacity: 1;
  }
}
.main-panel .zoomIn {
  animation-name: zoomIn95;
}
@keyframes zoomOut95 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
}
.main-panel .zoomOut {
  animation-name: zoomOut95;
}
</style>
