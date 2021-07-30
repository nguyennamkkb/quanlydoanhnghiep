<template>
  <div>
    <div class="content">
      <br />
      <br />
      <div class="container-fuild">
        <p class="_title0">Thông tin mã đăng ký</p>
        <el-button type="primary" @click="createUserDL = true">
          <i class="el-icon-circle-plus-outline"></i>Thêm mới</el-button
        >

        <el-table :data="users.results" style="width: 100%">
          <el-table-column label="Id">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.id }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Tên">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.name }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Email">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.email }}</span>
            </template>
          </el-table-column>
          
          </el-table-column>
          <el-table-column label="Mã đăng ký">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.code }}</span>
            </template>
          </el-table-column>

          <el-table-column label="Thao tác">
            <template slot-scope="scope">
              <el-button
                size="mini"
                type="warning"
                @click="confirmUpdate(scope.row)"
                >Sửa</el-button
              >
              <el-button
                size="mini"
                type="danger"
                @click="confirmDelete(scope.row)"
                >Xóa</el-button
              >
            </template>
          </el-table-column>
        </el-table>
      </div>
    </div>
    <div>
      <el-dialog
        title="Thông báo"
        :visible.sync="createUserDL"
        width="20%"
        center
      >
        <span>Thêm mới mã đăng ký</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="createUserDL = false">Hủy</el-button>
          <el-button type="primary" @click="handleCreateUser()"
            >Đồng ý</el-button
          >
        </span>
      </el-dialog>
      <el-dialog
        title="Cảnh báo"
        :visible.sync="deleteUserDL"
        width="20%"
        center
      >
        <span>Xóa mã đăng ký</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="deleteUserDL = false">Hủy</el-button>
          <el-button type="primary" @click="deleteUser()">Đồng ý</el-button>
        </span>
      </el-dialog>
      <div>
        
      </div>
      <el-dialog title="Thêm mới tài khoản" :visible.sync="updateUserDL">
        <el-form :model="userData">
          <el-form-item label="Tên" :label-width="updateUserDLLabelWidth">
            <el-input v-model="userData.name" autocomplete="off"></el-input>
          </el-form-item>
          <el-form-item label="Địa chỉ Email" :label-width="updateUserDLLabelWidth">
            <el-input v-model="userData.email" autocomplete="off"></el-input>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="updateUserDL = false">Hủy</el-button>
          <el-button type="primary" @click="handleUpdateCode()">Xác nhận</el-button>
        </span>
      </el-dialog>

      <!-- <el-dialog title="Shipping address" :visible.sync="creatUserDL">
        <el-form :model="form">
          <el-form-item label="Promotion name" :label-width="formLabelWidth">
            <el-input v-model="form.name" autocomplete="off"></el-input>
          </el-form-item>
          <el-form-item label="Zones" :label-width="formLabelWidth">
            <el-select v-model="form.region" placeholder="Please select a zone">
              <el-option label="Zone No.1" value="shanghai"></el-option>
              <el-option label="Zone No.2" value="beijing"></el-option>
            </el-select>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="creatUserDL = false">Cancel</el-button>
          <el-button type="primary" @click="creatUserDL = false">Confirm</el-button>
        </span>
      </el-dialog> -->
    </div>
  </div>

  <!-- </div> -->
</template>
<script>
import Repository from "../../../api/repositories/RepositoryFactory";
import { Loading } from "element-ui";
let loadingInstance;
const UserRepository = Repository.get("users");

export default {
  components: {},
  data() {
    return {
      creatUserDL: false,
      createUserDL: false,
      deleteUserDL: false,
      updateUserDL: false,
      users: {
        message: null,
        error: false,
        User: 0,
        results: [
          {
            id: null,
            name: null,
            email: null,
            code: null,
          },
        ],
      },
      userData: {
        id: null,
        name: null,
        email: null,
        code: null,
      },
      modalTitle: "",
      modal1: false,
      modal2: false,
      modaledit: false,
      modal_loading: false,
      loading: true,

      mesDelete: false,
      fullscreenLoading: false,
      updateUserDLLabelWidth: "130PX",
    };
  },

  created() {
    this.getusers();
  },
  methods: {
    Reset() {
      this.createUserDL = false;
      this.deleteUserDL = false;
      this.updateUserDL = false;
      loadingInstance.close();
    },
    getusers: async function () {
      const data = await UserRepository.getlistUser();
      if (data.data.code == 200) {
        this.users = data.data;
      }
    },
    success() {
      this.$message({
        type: "success",
        message: "Thành công",
      });
    },
    error() {
      loadingInstance.close();
      this.$message({
        type: "error",
        message: "Không thành công",
      });
    },
    checkStatus: function (data) {
      this.Reset();
      if (!data.error) {
        this.getusers();
        this.success();
      } else {
        this.error();
      }
      
    },
    handleCreateUser: async function () {
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await UserRepository.create();
      this.checkStatus(data.data);
    },
    confirmDelete(row) {
      this.dataUser = row;
      this.deleteUserDL = true;
    },
    deleteUser: async function () {
      this.deleteUserDL = false;
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await UserRepository.delete(this.dataUser.id);
      console.log(data);
      this.checkStatus(data.data);
    },
    confirmUpdate(row) {
      this.userData = row;
      console.log(this.userData)
      this.updateUserDL = true;
    },
    handleUpdateCode: async function () {
      loadingInstance = Loading.service({ fullscreen: true });
      try {
        const data = await UserRepository.updateUser(
          this.userData.id,
          this.userData
        );
        if (data.data.code == 200) {
          this.users = data.data;
        }
      } catch (error) {
        this.error();
      }
    },
  },
};
</script>



			