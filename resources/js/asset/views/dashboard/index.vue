<template>
  <div>
    <div class="">
      <header
        class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
      >
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"
          >QUYETNHANH</a
        >

        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Đăng xuất</a>
          </div>
        </div>
      </header>

      <div class="row">
        <nav
          id="sidebarMenu"
          class="col-md-3 col-lg-2 d-md-block sidebar collapse"
        >
          <el-menu
            class="el-menu-vertical-demo"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b"
          >
            <router-link to="index" aria-current="page">
              <el-menu-item index="1">
                <i class="el-icon-setting"></i>
                <span> Overview</span>
              </el-menu-item>
            </router-link>
            <router-link aria-current="page" to="user">
              <el-menu-item index="2">
                <i class="el-icon-setting"></i>
                <span> Tài khoản</span>
              </el-menu-item>
            </router-link>
            <router-link aria-current="page" to="code">
              <el-menu-item index="3">
                <i class="el-icon-setting"></i>
                <span>Mã đăng ký</span>
              </el-menu-item>
            </router-link>
            <el-submenu index="4">
              <template slot="title">
                <i class="el-icon-location"></i>
                <span>Danh mục chung</span>
              </template>
              <el-menu-item index="4-1">Loại hàng hóa</el-menu-item>
              <el-menu-item index="4-2">Tính sản phẩm</el-menu-item>
              <el-menu-item index="4-3">kho hàng</el-menu-item>
            </el-submenu>
            <router-link aria-current="page" to="code">
              <el-menu-item index="5">
                <i class="el-icon-setting"></i>
                <span>Nhà cung cấp</span>
              </el-menu-item>
            </router-link>
            <router-link aria-current="page" to="code">
              <el-menu-item index="6">
                <i class="el-icon-setting"></i>
                <span>Khách hàng mua</span>
              </el-menu-item>
            </router-link>
            <router-link aria-current="page" to="code">
              <el-menu-item index="6">
                <i class="el-icon-setting"></i>
                <span>Nhân viên</span>
              </el-menu-item>
            </router-link>
            <el-submenu index="7">
              <template slot="title">
                <i class="el-icon-location"></i>
                <span>Nhập hàng</span>
              </template>
              <el-menu-item index="8-1">Lập phiếu nhập</el-menu-item>
              <el-menu-item index="8-2">Danh sách phiếu nhập</el-menu-item>
              
            </el-submenu>
            <el-submenu index="8">
              <template slot="title">
                <i class="el-icon-location"></i>
                <span>Xuất hàng</span>
              </template>
              <el-menu-item index="8-1">Lập phiếu xuất</el-menu-item>
              <el-menu-item index="8-2">Danh sách phiếu xuất</el-menu-item>
              
            </el-submenu>
          </el-menu>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>




			