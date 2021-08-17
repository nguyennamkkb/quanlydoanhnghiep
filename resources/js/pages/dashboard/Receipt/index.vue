<template>
  <div class="app-container">
    <h4>Dặc tính hàng hóa</h4>
    <div class="grid-content bg-purple">
      <div class="filter-container">
        <el-input
          :placeholder="'Tên'"
          v-model="listQuery.keyword"
          style="width: 200px"
          class="filter-item"
          @keyup.enter.native="handleFilter"
        />
        <!-- <el-select
        v-model="listQuery.status"
        :placeholder="'Trạng thái'"
        clearable
        class="filter-item"
        style="width: 160px"
        @change="handleFilter"
      >
        <el-option
          v-for="item in statusOptions"
          :key="item.key"
          :label="item.display_name"
          :value="item.key"
        />
      </el-select> -->
        <el-button
          class="filter-item"
          type="primary"
          icon="el-icon-search"
          @click="handleFilter"
          >Tìm kiếm</el-button
        >
        <el-button
          class="filter-item"
          style="margin-left: 10px"
          type="primary"
          icon="el-icon-circle-plus-outline"
          @click="handleCreate"
        ></el-button>
      </div>

      <el-table :data="list" style="width: 100%; margin-top: 20px" border>
        <el-table-column label="Ngày">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.date }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Loại hàng">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.category }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Khách hàng">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.customer }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Người nhập">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.importer }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Người chở">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.carrier }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Đã trả trước">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.prepay }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Tổng tiền">
          <template slot-scope="scope">
            <span style="margin-left: 10px">{{ scope.row.totalmoney }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Trạng thái">
          <template slot-scope="">
            <span style="margin-left: 10px">Trạng thái</span>
          </template>
        </el-table-column>

        <el-table-column label="Thao tác">
          <template slot-scope="scope">
            <el-button
              type="success"
              icon="el-icon-view"
              circle
              @click="viewInputDetail(scope.row)"
            ></el-button>
            <el-button
              type="primary"
              icon="el-icon-edit"
              circle
              @click="handleUpdate(scope.row)"
            ></el-button>
            <el-button
              type="danger"
              icon="el-icon-delete"
              circle
              @click="handleDelete(scope.row)"
            ></el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <!-- <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" /> -->
    <!-- dialog customer type -->
    <!-- <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible">
      <el-form
        ref="dataForm"
        :rules="rules"
        :model="temp"
        label-position="left"
        label-width="150px"
        style="width: 400px; margin-left: 50px"
      >
        <el-form-item :label="'Tên'" prop="name">
          <el-input v-model="temp.name" />
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">Huỷ bỏ</el-button>
        <el-button
          type="primary"
          @click="dialogStatus === 'create' ? createData() : updateData()"
          >Cập nhật</el-button
        >
      </div>
    </el-dialog> -->
    <!-- dialog customer -->
    <el-drawer
      :title="inputDetailDrtitle"
      :visible.sync="inputDetailDr"
      direction="rtl"
      size="70%"
     
    >
      <!-- <h5>Thông tin nhập hàng {{temp.category}}</h5> -->
      <el-row style="padding: 10px">
        <el-col :span="12">
          <div class="grid-content Compact">
            <span style="font-weight: bold">Ngày: </span> {{ temp.date }}
          </div>
        </el-col>
        <el-col :span="12">
          <div class="grid-content Compact">
            <span style="font-weight: bold">Khách hàng: </span>
            {{ temp.customer }}
          </div>
        </el-col>
      </el-row>
      <el-row style="padding: 10px">
        <el-col :span="12">
          <div class="grid-content Compact">
            <span style="font-weight: bold">Người kiểm tra: </span
            >{{ temp.importer }}
          </div>
        </el-col>
        <el-col :span="12">
          <div class="grid-content">
            <span style="font-weight: bold">Người chở: </span>{{ temp.carrier }}
          </div>
        </el-col>
      </el-row>
      <el-row style="padding: 10px">
        <el-col :span="6">
          <div class="grid-content">
            <span style="font-weight: bold">Tổng tiền: </span>
            {{ temp.totalmoney }}
          </div>
        </el-col>
        <el-col :span="6">
          <div class="grid-content">
            <span style="font-weight: bold">Đã trả: </span>{{ temp.prepay }}
          </div>
        </el-col>
        <el-col :span="6">
          <div class="grid-content">
            <span style="font-weight: bold">Trạng thái: </span>
            {{ temp.status }}
          </div>
        </el-col>
        <el-col :span="6">
          <div class="grid-content">
            <span style="font-weight: bold">Ghi chú: </span> {{ temp.note }}
          </div>
        </el-col>
      </el-row>
      <el-table :data="temp.item" class="table table-striped" border>
        <el-table-column
          property="categorychildren"
          label="Loại"
        ></el-table-column>
        <el-table-column property="weight" label="Số lượng"></el-table-column>
        <el-table-column property="unit" label="Đơn vị tính"></el-table-column>
        <el-table-column property="price" label="Giá"></el-table-column>
        <el-table-column property="total" label="Thành tiền"></el-table-column>
      </el-table>
    </el-drawer>
  </div>
</template>

<script>
import { getInput } from "../../../api/Input";

export default {
  filters: {
    statusFilter(status) {
      const statusMap = {
        available: "success",
        disable: "danger",
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      inputDetailDrtitle: "",
      inputDetailDr: false,
      Tenloai: "",
      tableKey: 0,
      list: null,
      total: 0,
      //   listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
        keyword: undefined,
      },
      statusOptions: [
        { key: "available", display_name: "Hoạt động" },
        { key: "disable", display_name: "Không hoạt động" },
      ],
      temp: {
        id: undefined,
        name: "",
      },
      dialogFormVisible: false,
      dialogStatus: "",
      textMap: {
        update: "Sửa Loại hàng hóa",
        create: "Thêm mới loại hàng hóa",
      },
      rules: {
        name: [
          {
            required: true,
            message: "Tên hàng hóa không được bỏ trống",
            trigger: "change",
          },
        ],
      },
      temp: {
        date: undefined,
        customer_id: undefined,
        importer_id: undefined,
        carrier_id: undefined,
        note: "",
        totalmoney: undefined,
        prepay: 0,
        status: 0,
        item: [
          {
            categorychildren_id: undefined,
            weight: 0,
            unit: undefined,
            price: undefined,
            total: 0,
          },
        ],
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    getList() {
      //   this.listLoading = true
      getInput(this.listQuery).then((response) => {
        this.list = response.data.data;
        // this.total = response.data.meta.total;
        console.log(response.data.data);
        // Just to simulate the time of the request
        setTimeout(() => {
          //   this.listLoading = false
        }, 0.5 * 1000);
      });
    },
    handleFilter() {
      this.listQuery.page = 1;
      this.getList();
    },
    resetTemp() {
      this.temp = {
        id: undefined,
        name: "",
      };
    },
    handleCreate() {
      this.resetTemp();
      this.dialogStatus = "create";
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs["dataForm"].clearValidate();
      });
    },
    createData() {
      this.$refs["dataForm"].validate((valid) => {
        if (valid) {
          console.log(this.temp);
          createPrice(this.temp).then(() => {
            this.listQuery.page = 1;
            this.getList();
            this.dialogFormVisible = false;
            this.$notify({
              title: "Thông báo",
              message: "Tạo thành công",
              type: "success",
              duration: 2000,
            });
          });
        }
      });
    },
    handleUpdate(row) {
      this.temp = Object.assign({}, row); // copy obj
      this.dialogStatus = "update";
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs["dataForm"].clearValidate();
      });
    },
    updateData() {
      this.$refs["dataForm"].validate((valid) => {
        if (valid) {
          const tempData = Object.assign({}, this.temp);
          updatePrice(tempData.id, tempData).then(() => {
            this.getList();
            this.dialogFormVisible = false;
            this.$notify({
              title: "Thông báo",
              message: "Cập nhật thành công",
              type: "success",
              duration: 2000,
            });
          });
        }
      });
    },
    handleDelete(row) {
      deletePrice(row.id).then(() => {
        this.getList();
        this.$notify({
          title: "Thông báo",
          message: "Xoá thành công",
          type: "success",
          duration: 2000,
        });
      });
    },
    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    viewInputDetail(row) {
      this.temp = Object.assign({}, row);
      // console.log(row);
      this.inputDetailDrtitle = "Thông tin nhập " + row.category;
      this.inputDetailDr = true;
    },
  },
};
</script>