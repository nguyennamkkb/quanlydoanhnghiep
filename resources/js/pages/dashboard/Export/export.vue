<template>
  <div>
    <br />
    <h4>Phiếu nhập hàng</h4>

    <el-form ref="form" :model="temp" label-width="130px">
      <el-row :gutter="20">
        <el-col :span="10">
          <div class="grid-content bg-purple">
            <el-form-item label="Ngày nhập" style="font-weight: bold">
              <el-date-picker
                type="date"
                placeholder="(Năm-Tháng-ngày)"
                v-model="temp.date"
                style="width: auto"
                
              >
              </el-date-picker>
              <!-- <input type="date" v-model="temp.date" placeholder="(Năm-Tháng-ngày)"  style="width: auto"> -->
            </el-form-item>
          </div>
        </el-col>
        <el-col :span="10">
          <div class="grid-content bg-purple">
            <el-form-item label="Ng vận chuyển" style="font-weight: bold">
              <el-select
                v-model="temp.carrier_id"
                placeholder="Chọn người vận chuyển"
                style="width: auto"
              >
                <el-option
                  v-for="item in listEmployees"
                  :key="item.id"
                  :label="item.name"
                  :value="item.id"
                ></el-option>
              </el-select>
            </el-form-item>
          </div>
        </el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="10">
          <div class="grid-content bg-purple">
            <el-form-item label="Khách hàng" style="font-weight: bold">
              <el-select
                v-model="temp.region"
                placeholder="Chọn khách hàng"
                style="width: auto"
              >
                <el-option
                  v-for="item in listCustomers"
                  :key="item.id"
                  :label="item.name"
                  :value="item.id"
                ></el-option>
              </el-select>
            </el-form-item>
          </div>
        </el-col>
        <el-col :span="10">
          <div class="grid-content bg-purple">
            <el-form-item label="Ng kiểm hàng" style="font-weight: bold">
              <el-select
                v-model="temp.importer_id"
                placeholder="Người kiểm"
                style="width: auto"
              >
                <el-option
                  v-for="item in listEmployees"
                  :key="item.id"
                  :label="item.name"
                  :value="item.id"
                ></el-option>
              </el-select>
            </el-form-item></div
        ></el-col>
      </el-row>
      <el-row :gutter="20">
        <el-col :span="10"
          ><div class="grid-content bg-purple">
            <el-form-item label="Mục hàng hóa" style="font-weight: bold">
              <el-select
                v-model="temp.category_id"
                placeholder="Chọn loại hàng"
                style="width: auto"
                @change="getListCatagoryChild"
              >
                <el-option
                  v-for="item in listCategories"
                  :key="item.id"
                  :label="item.name"
                  :value="item.id"
                ></el-option>
              </el-select>
            </el-form-item>
          </div>
        </el-col>
        <el-col :span="10">
          <div class="grid-content bg-purple">
            <el-form-item label="Ghi chú" style="font-weight: bold">
              <el-input
                type="textarea"
                placeholder="Nhập ghi chú"
                v-model="temp.note"
              >
              </el-input>
            </el-form-item>
          </div>
        </el-col>
      </el-row>

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
        <tr  v-for="(item, index) in inputDetails" :key="index">
          <td>
            <el-select
              v-model="item.categorychildren_id"
              placeholder="Loại"
              style="width: auto"
               @change="CalculateTotal()"
            >
              <el-option
                v-for="item in listCategoryChilds"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              ></el-option>
            </el-select>
          </td>
          <td>
            <input v-model="item.weight" class="form-control" type="number"  @change="CalculateTotal()" />
          </td>
          <td>
            <el-select
              v-model="item.unit"
              placeholder="Loại"
              style="width: auto"
              @change="CalculateTotal()"
            >
              <el-option
                v-for="item in listUnits"
                :key="item.id"
                :label="item.name"
                :value="item.name"
              ></el-option>
            </el-select>
          </td>
          <td>
            <el-select
              v-model="item.price"
              placeholder="Giá"
              style="width: auto"
              @change="CalculateTotal()"
            >
              <el-option
                v-for="item in listPrices"
                :key="item.id"
                :label="item.name"
                :value="item.name"
              ></el-option>
            </el-select>
          </td>
          <td>
            <input type="text" v-model="item.total" disabled  />
          </td>
          <td>
            <el-button v-if="index ==lenTable-1"
              type="danger"
              icon="el-icon-delete"
              circle
              @click="deleteRow(item)"
            ></el-button>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right">Tổng tiền</td>
          <td colspan="1">{{temp.totalmoney }}</td>
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
    <el-button type="primary" @click="getvalue" style="float: right"
      >Tạo phiếu xuất</el-button
    >
  </div>
</template>
<script>
import { getInput,createInput } from "../../../api/Input";
import { getCategoryChildbyCategoryId } from "../../../api/CategoryChild";

export default {
  data() {
    return {
      listCustomers: null,
      listEmployees: null,
      listCategories: null,
      listUnits: null,
      listPrices: null,
      listCategoryChilds: null,
      inputDetails: [
        {
          customer_id: undefined,
          categorychildren_id: undefined,
          weight: 0,
          unit: undefined,
          price: undefined,
          total: 0,
        },
      ],
      temp: {
        date: Date(),
        customer_id: undefined,
        importer_id: undefined,
        carrier_id: undefined,
        note: "",
        totalmoney: undefined,
        item: [
          {
            customer_id: undefined,
            categorychildren_id: undefined,
            weight: 0,
            unit: undefined,
            price: undefined,
            total: 1,
          },
        ],
      },
      totalAmount:0,
      lenTable:0,
    };
  },
  created() {
    this.getList();
  },
  methods: {
    getList: async function () {
      const data = await getInput();
      this.listCustomers = data.data.customer;
      this.listCategories = data.data.category;
      this.listEmployees = data.data.employee;
      this.listUnits = data.data.unit;
      this.listPrices = data.data.price;
    },
    addRow: function () {
      this.inputDetails.push({
        categorychildren_id: undefined,
        weight: undefined,
        unit: undefined,
        price: undefined,
        total: "",
      });
      this.CalculateTotal();
    },
    deleteRow(row) {
      this.inputDetails.pop();
      this.CalculateTotal();
    },
    getvalue() {
      this.temp.item = Object.assign({}, this.inputDetails);
      console.log(typeof(this.temp.date));
      
      // createInput(this.temp).then((result) => {
      //   console.log(result.data);
      // }).catch((err) => {
        
      // });
    },
    getData: async function () {
      // const data1 = await getCategoryChild(this.temp)
    },
    getListCatagoryChild() {
      const dt = {
        category_id: this.temp.category_id,
      };
      getCategoryChildbyCategoryId(dt)
        .then((result) => {
          // console.log(result.data.data);
          this.listCategoryChilds = result.data.data;
        })
        .catch((err) => {});
    },
    CalculateTotal() {
      // console.log(this.inputDetails);
      // console.log(this.inputDetails[0].price);
      
      this.temp.totalmoney =0;
      let datatable = this.inputDetails;
      let index =0;
      this.lenTable = datatable.length
      datatable.forEach((element) => {
        index++;
        let soluong =element.weight;
        let donvi = element.unit != undefined? parseInt(element.unit.split(" ")[1]):'';
        let dongia =element.price;
        let thanhtien;
        if(isNaN(donvi))  donvi=1;
        thanhtien = soluong*donvi*dongia;
        if(isNaN(thanhtien))  thanhtien=0;
        // console.log('tong tien'+ thanhtien);     
        datatable[index-1].total =thanhtien
        this.temp.totalmoney+=thanhtien;
      });

    },
  },
};
</script>