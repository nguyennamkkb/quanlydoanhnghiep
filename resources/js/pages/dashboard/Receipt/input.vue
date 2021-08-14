<template>
  <div>
    <br />
    <h4>Phiếu nhập hàng</h4>

    <el-form ref="form" :model="temp" label-width="130px" size="mini">
      <el-form-item label="Chọn ngày">
        <el-col :span="7">
          <el-date-picker
            type="date"
            placeholder="(Năm-Tháng-ngày)"
            v-model="temp.date1"
            style="width: auto"
          ></el-date-picker>
          Hôm nay: <el-switch v-model="temp.value1"> </el-switch>
        </el-col>
        <!-- <el-col class="line" :span="2"></el-col> -->
      </el-form-item>
      <el-form-item label="Khách hàng">
        <el-select
          v-model="temp.region"
          placeholder="Loại khách hàng"
          style="width: auto"
        >
          <el-option label="Khách 1" value="shanghai"></el-option>
          <el-option label="Khách 2" value="beijing"></el-option>
        </el-select>
        Người kiểm hàng
        <el-select
          v-model="temp.importer_id"
          placeholder="Người kiểm"
          style="width: auto"
        >
          <el-option label="Nam" value="shanghai"></el-option>
          <el-option label="Thực" value="beijing"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Người vận chuyển">
        <el-select
          v-model="temp.carrier_id"
          placeholder="Chọn người vận chuyển"
          style="width: auto"
        >
          <el-option label="Minh" value="shanghai"></el-option>
          <el-option label="ABC" value="beijing"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Ghi chú">
        <el-input
          type="textarea"
          :autosize="{ minRows: 2, maxRows: 4 }"
          placeholder="Nhập ghi chú"
          v-model="temp.note"
        >
        </el-input>
      </el-form-item>

      <el-form-item size="large">
        <el-button type="primary" @click="onSubmit">Create</el-button>
        <el-button>Xóa</el-button>
      </el-form-item>
    </el-form>
    <table class="table table-bordered">
      <thead class="text text-success">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr v-for="(user, index) in users"> -->
        <tr  v-for="user in users" :key="user.id">
          <td>
            <input v-model="user.name" class="form-control" type="text" />
          </td>
          <td>
            <input v-model="user.email" class="form-control" type="text" />
          </td>
          <td>
            <input v-model="user.mobno" class="form-control" type="text" />
          </td>
          <td>
               <el-button type="danger" icon="el-icon-delete" circle @click="deleteRow(user.id)"></el-button>
            
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      users: [
          { name: "", email: "", mobno: "" },
          { name: "", email: "", mobno: "" },
          
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
    };
  },
  methods: {
    onSubmit() {
      console.log("submit!");
    },
    addRow: function () {
      this.users.push({ name: "", email: "", mobno: "" });
    },
    deleteRow(index) {
      this.users.splice(index, 1);
    },
  },
};
</script>