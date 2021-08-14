<template>
  <div>
    <br />
    <h4>Phiếu nhập hàng</h4>

    <el-form ref="form" :model="temp" label-width="130px">
      <el-row :gutter="20">
        <el-col :span="10"
          ><div class="grid-content bg-purple">
            <el-form-item label="Ngày nhập">
              <el-date-picker
                type="date"
                placeholder="(Năm-Tháng-ngày)"
                v-model="temp.date1"
                style="width: auto"
              ></el-date-picker>
            </el-form-item></div
        ></el-col>
        <el-col :span="10"
          ><div class="grid-content bg-purple">
            <el-form-item label="Người vận chuyển">
              <el-select
                v-model="temp.carrier_id"
                placeholder="Chọn người vận chuyển"
                style="width: auto"
              >
                <el-option label="Minh" value="shanghai"></el-option>
                <el-option label="ABC" value="beijing"></el-option>
              </el-select>
            </el-form-item></div
        ></el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="10"
          ><div class="grid-content bg-purple">
            <el-form-item label="Khách hàng">
              <el-select
                v-model="temp.region"
                placeholder="Loại khách hàng"
                style="width: auto"
              >
                <el-option label="Khách 1" value="shanghai"></el-option>
                <el-option label="Khách 2" value="beijing"></el-option>
              </el-select>
            </el-form-item></div
        ></el-col>
        <el-col :span="10"
          ><div class="grid-content bg-purple">
            <el-form-item label="Người kiểm hàng">
              <el-select
                v-model="temp.importer_id"
                placeholder="Người kiểm"
                style="width: auto"
              >
                <el-option label="Nam" value="shanghai"></el-option>
                <el-option label="Thực" value="beijing"></el-option>
              </el-select>
            </el-form-item></div
        ></el-col>
      </el-row>

      <el-form-item label="Ghi chú">
        <el-input
          type="textarea"
          :autosize="{ minRows: 2, maxRows: 4 }"
          placeholder="Nhập ghi chú"
          v-model="temp.note"
        >
        </el-input>
      </el-form-item>

      <!-- <el-form-item size="large">
        <el-button type="primary" @click="onSubmit">Create</el-button>
        <el-button>Xóa</el-button>
      </el-form-item> -->
    </el-form>
    <table class="table table-bordered">
      <thead class="text text-success">
        <tr>
          <th>Loại</th>
          <th>Số lượng</th>
          <th>Đơn vị</th>
          <th>Đơn giá</th>
          <th>Tổng tiền</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr v-for="(user, index) in users"> -->
        <tr v-for="item in inputDetails" :key="item.id">
          <td>
            <el-select
              v-model="item.categorychildren_id"
              placeholder="Loại"
              style="width: auto"
            >
              <el-option label="Tăm 34" value="34"></el-option>
              <el-option label="Tăm 40" value="40"></el-option>
            </el-select>
          </td>
          <td>
            <input v-model="item.weight" class="form-control" type="number" />
          </td>
          <td>
            <el-select
              v-model="temp.item.unit_id"
              placeholder="Loại"
              style="width: auto"
            >
              <el-option label="Kg" value="1"></el-option>
              <el-option label="Kiện" value="2"></el-option>
            </el-select>
          </td>
          <td>
            <el-select
              v-model="temp.item.price_id"
              placeholder="Loại"
              style="width: auto"
            >
              <el-option label="10000" value="10000"></el-option>
              <el-option label="20000" value="20000"></el-option>
            </el-select>
          </td>
          <td>
            <input type="text" v-model="temp.item.total" disabled />
          </td>
          <td>
            <el-button
              type="danger"
              icon="el-icon-delete"
              circle
              @click="deleteRow()"
            ></el-button>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right">Tổng tiền</td>
          <td colspan="1">1000000</td>
          <td colspan="1">
            <el-button
              type="primary"
              icon="el-icon-plus"
              circle
              @click="addRow"
            ></el-button>
          </td>
        </tr>
      </tbody>
    </table>
    <el-button type="primary" @click="getvalue">Tạo phiếu xuất</el-button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      inputDetails: [
        {
          categorychildren_id: "",
          weight: "",
          unit_id: "",
          price_id: "",
          total: "",
        },
      ],
      temp: {
        date: undefined,
        customer_id: undefined,
        importer_id: undefined,
        carrier_id: undefined,
        note: "",
        totalmoney: undefined,
        item: {
          customer_id: undefined,
          categorychildren_id: undefined,
          weight: 0,
          unit_id: undefined,
          price_id: undefined,
          total: 1,
          prepay: undefined,
        },
      },
      item: {
        customer_id: undefined,
        categorychildren_id: undefined,
        weight: 0,
        unit_id: undefined,
        price_id: undefined,
        total: 1,
        prepay: undefined,
      },
    };
  },
  methods: {
    onSubmit() {
      console.log("submit!");
    },
    addRow: function () {
      this.inputDetails.push({
        categorychildren_id: undefined,
        weight: undefined,
        unit_id: undefined,
        price_id: undefined,
        total: "",
      });
    },
    deleteRow() {
      this.inputDetails.pop();
    },
    getvalue() {
      console.log(this.temp);
      console.log(this.inputDetails);
    },
  },
};
</script>