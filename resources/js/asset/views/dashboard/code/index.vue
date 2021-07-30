<template>
  <div>
    <div class="content">
      <br />
      <br />
      <div class="container-fuild">
        <p class="_title0">Thông tin mã đăng ký</p>
        <el-button type="primary" @click="createCodeDL = true">
          <i class="el-icon-circle-plus-outline"></i>Thêm mới</el-button
        >

        <el-table :data="codes.results" style="width: 100%">
          <el-table-column label="Id">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.id }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Mã đăng ký">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.code }}</span>
            </template>
          </el-table-column>
          <el-table-column label="Trạng thái">
            <template slot-scope="scope">
              <el-tag type="danger" v-if="scope.row.isUsed == false"
                >Chưa sử dụng</el-tag
              >
              <el-tag type="success" v-if="scope.row.isUsed == true"
                >Đã sử dụng</el-tag
              >
            </template>
          </el-table-column>
          <el-table-column label="Doanh nghiệp">
            <template slot-scope="scope">
              <span style="margin-left: 10px">{{ scope.row.enterprise }}</span>
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
        :visible.sync="createCodeDL"
        width="20%"
        center
      >
        <span>Thêm mới mã đăng ký</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="createCodeDL = false">Hủy</el-button>
          <el-button type="primary" @click="handleCreateCode()"
            >Đồng ý</el-button
          >
        </span>
      </el-dialog>
      <el-dialog
        title="Cảnh báo"
        :visible.sync="deleteCodeDL"
        width="20%"
        center
      >
        <span>Xóa mã đăng ký</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="deleteCodeDL = false">Hủy</el-button>
          <el-button type="primary" @click="deleteCode()">Đồng ý</el-button>
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
const CodeRepository = Repository.get("codes");

export default {
  components: {},
  data() {
    return {
      createCodeDL: false,
      deleteCodeDL: false,
      codes: {
        message: null,
        error: false,
        code: 0,
        results: [
          {
            id: 0,
            code: null,
            isUsed: null,
            enterprise: null,
            startTime: null,
            endTime: null,
          },
        ],
      },
      modalTitle: "",
      modaledit: false,
      modal_loading: false,
      loading: true,
      tableData: {
        id: 0,
        code: "Nguyennasdasdam",
        isUsed: null,
        idEnterprise: null,
        startTime: null,
        endTime: null,
      },
      resData: {
        message: null,
        error: null,
        code: null,
        results: null,
      },
      mesDelete: false,
      fullscreenLoading: false,
    };
  },

  created() {
    this.getCodes();
  },
  methods: {
    
    getCodes: async function () {
      const data = await CodeRepository.get();
      // console.log(data.data);
      if (data.data.code == 200) {
        this.codes = data.data;
      }
    },
    success() {
      this.createCodeDL = false;
      loadingInstance.close();
      this.$message({
        type: "success",
        message: "Thành công",
      });
    },
    error() {
      this.createCodeDL = false;
      loadingInstance.close();
      this.$message({
        type: "error",
        message: "Không thành công",
      });
    },
    checkStatus: function (data) {
      if (!data.error) {
        this.getCodes();
        this.success();
      } else {
        this.error();
      }
    },
    handleCreateCode: async function () {
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await CodeRepository.create();
      this.checkStatus(data.data);
    },
    confirmDelete(row) {
      this.dataCode = row;
      this.deleteCodeDL = true;
    },
    deleteCode: async function () {
      this.deleteCodeDL = false;
      loadingInstance = Loading.service({ fullscreen: true });
      const data = await CodeRepository.delete(this.dataCode.id);
      console.log(data);
      this.checkStatus(data.data);
    },
  },
};
</script>



			