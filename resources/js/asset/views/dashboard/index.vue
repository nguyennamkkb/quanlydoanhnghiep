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
          class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
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
          </el-menu>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <router-view />
        </main>
      </div>
    </div>
  </div>
</template>




			