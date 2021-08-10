<template>
  <div>
    <div class="content">
      <br />
      <br />
      <div class="container-fuild">
        <p class="_title0">Thông tin danh mục sản phẩm</p>
        <el-form :inline="true" :model="listQuery" class="demo-form-inline">
          <el-form-item>
            <el-input
              v-model="listQuery.keyword"
              placeholder="Tìm kiếm"
            ></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="btnSearch">Tìm kiếm</el-button>
          </el-form-item>
          <el-button type="primary" @click="btnCreate()">
            <i class="el-icon-circle-plus-outline"></i>Thêm mới</el-button
          >
        </el-form>

        <el-table :data="users.data" style="width: 100%">
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

          <el-table-column label="Thao tác">
            <template slot-scope="scope">
              <el-button
                size="mini"
                type="warning"
                @click="btnUpdate(scope.row)"
                >Sửa</el-button
              >
              <el-button size="mini" type="danger" @click="bntDelete(scope.row)"
                >Xóa</el-button
              >
            </template>
          </el-table-column>
        </el-table>
      </div>
    </div>
    <div>
      <el-dialog :title="textMap[dialogStatus]" :visible.sync="createDL">
        <el-form :model="dataCreate" :rules="rules" ref="dataform2">
          <el-form-item label="Tên" prop="name" :label-width="formLabelWidth">
            <el-input v-model="dataCreate.name" autocomplete="off"></el-input>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="createDL = false">hủy</el-button>
          <el-button
            type="primary"
            @click="dialogStatus === 'create' ? handleCreate() : handleUpdate()"
            >Xác nhận</el-button
          >
        </span>
      </el-dialog>
      <el-dialog title="Cảnh báo" :visible.sync="deleteDL" width="20%" center>
        <span>Xóa danh mục sản phẩm </span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="deleteDL = false">Hủy</el-button>
          <el-button type="primary" @click="handleDelete()">Đồng ý</el-button>
        </span>
      </el-dialog>
      <div></div>
    </div>
  </div>

  <!-- </div> -->
</template>
<script>
import { Empty, Loading } from "element-ui";
import {
  createCategory,
  getCategory,
  updateCategory,
  deleteCategory,
} from "../../../api/Category";
let loadingInstance;

export default {
  components: {},
  data() {
    return {
      textMap: {
        update: "Sửa Danh mục",
        create: "Thêm mới Danh mục",
      },
      dialogStatus: "",
      listQuery: {
        page: 1,
        limit: 20,
        keyword: undefined,
      },
      creatUserDL: false,
      createDL: false,
      deleteDL: false,
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
        id: undefined,
        name: "",
        email: "",
        code: "",
      },
      dataCreate: {
        name: "",
      },
      modalTitle: "",
      modal1: false,
      modal2: false,
      modaledit: false,
      modal_loading: false,
      loading: true,

      mesDelete: false,
      fullscreenLoading: false,
      updateDLLabelWidth: "130PX",
      rules: {
        name: [
          {
            required: true,
            message: "Tên không được bỏ trống",
            trigger: "change",
          },
        ],
      },
      formLabelWidth: "120px",
      search: {
        keyword: "",
        isUsed: undefined,
      },
    };
  },

  created() {
    this.getcategories();
  },
  methods: {
    Reset() {
      this.createDL = false;
      this.deleteDL = false;
      this.updateUserDL = false;
      loadingInstance.close();
    },
    getcategories: async function () {
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await getCategory();
      if (data.data) {
        this.users = data.data;
        loadingInstance.close();
      }
    },
    success() {
      this.$message({
        type: "success",
        message: "Thành công",
      });
      this.Reset();
    },
    error(data) {
      loadingInstance.close();
      this.$message({
        type: "error",
        message: data == "" ? "Không thành công" : data,
      });
    },
    checkStatus: function (data) {
      this.Reset();
      if (!data.error) {
        this.getcategories();
        this.success();
      } else {
        this.error();
      }
    },
    btnCreate() {
      this.createDL = true;
      this.dialogStatus='create';
    },
    handleCreate: async function () {
      this.$refs.dataform2.validate((valid) => {
        if (valid) {
          loadingInstance = Loading.service({ fullscreen: true });
          try {
            createCategory(this.dataCreate).then((result) => {
              if (result.data.status == true) {
                this.getcategories();
                this.success();
              } else {
                this.error(result.data.message);
              }
            });
          } catch (error) {
            console.log(error);
            this.error();
          }
        }
      });
    },
    bntDelete(row) {
      this.dataUser = row;
      this.deleteDL = true;
    },
    handleDelete: async function () {
      this.deleteDL = false;
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await deleteUser(this.dataUser.id);
      // console.log(data);
      this.checkStatus(data.data);
    },
    btnUpdate(row) {
      this.userData = Object.assign({}, row);
      // console.log(this.userData);
      this.updateUserDL = true;
      this.dialogStatus='update';
    },
    handleUpdate: async function () {
      this.$refs["ruleForm"].validate((valid) => {
        if (valid) {
          loadingInstance = Loading.service({ fullscreen: true });
          try {
            updateUser(this.userData.id, this.userData).then((result) => {
              if (result.data.status == true) {
                this.getcategories();
                this.success();
              }
            });
          } catch (error) {
            this.error();
          }
        }
      });
    },
    btnSearch: async function () {
      loadingInstance = Loading.service({ fullscreen: true });
      try {
        const data = await filterUser(this.listQuery);
        if (data.data) {
          this.users = data.data;
          this.success();
        } else {
          this.error();
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>



			