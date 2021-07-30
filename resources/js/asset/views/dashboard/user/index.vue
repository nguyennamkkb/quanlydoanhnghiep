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

        <el-table :data="users.data" style="width: 100%">
          <el-table-column label="Id">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.id }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Mã đăng ký">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.User }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Trạng thái">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.isUsed }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Doanh nghiệp">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{
                scope.row.enterprise ? scope.row.enterprise.name : ""
              }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Ngày bắt đầu">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.startTime }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Ngày kết thúc">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.endTime }}</span>
            </template>
          </el-table-column>

          <el-table-column label="Thao tác">
            <template slot-scope="scope">
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
      createUserDL: false,
      deleteUserDL: false,
      users: {
        message: null,
        error: false,
        User: 0,
        results: [
          {
            id: 0,
            User: null,
            isUsed: null,
            enterprise: null,
            startTime: null,
            endTime: null,
          },
        ],
      },
      modalTitle: "",
      modal1: false,
      modal2: false,
      modaledit: false,
      modal_loading: false,
      loading: true,
      tableData: {
        id: 0,
        User: "Nguyennasdasdam",
        isUsed: null,
        idEnterprise: null,
        startTime: null,
        endTime: null,
      },
      resData: {
        message: null,
        error: null,
        User: null,
        results: null,
      },
      mesDelete: false,
      fullscreenLoading: false,
    };
  },

  created() {
    this.getusers();
  },
  methods: {
    open() {
      this.$confirm(
        "This will permanently delete the file. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning",
        }
      )
        .then(() => {
          this.$message({
            type: "success",
            message: "Delete completed",
          });
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "Delete canceled",
          });
        });
    },
    getusers: async function () {
      const { data } = await UserRepository.get();
      this.users = data;
    },
    success() {
      this.createUserDL = false;
      this.$message({
        type: "success",
        message: "Thành công",
      });
    },
    error() {
      this.$message({
        type: "error",
        message: "Không thành công",
      });
    },
    checkStatus: function (data) {
      if (!data.error) {
        this.getusers();
        this.success();
        loadingInstance.close();
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
  },
};
</script>



			