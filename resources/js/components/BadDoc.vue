<template>
<div class="container">
    <div class="row ">
        <div class="col-md-12" style="background-color:#eeeeee;">
            <ve-histogram 
              :data="chartData.histogram" 
              :settings="chartSettings.histogram" 
              :events="chartSettings.chartEvents" 
              :extend="chartSettings.extend">
            </ve-histogram>
        </div>
    </div>
    <el-dialog :title="tableTitle" width="40%"
      :visible.sync="dialogVisible"
      :before-close="handleClose">
      <el-table
        :data="tableData"
        height="250"
        border
        style="width: 100%">
        <el-table-column
          v-for="(obj,idx) in tableColName"
          :key="idx"
          :label="obj.name"
          :width="obj.width">
          <template slot-scope="scope">
            {{scope.row[idx]}}
          </template>
        </el-table-column>
      </el-table>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>
</div>

</template>

<script>
  export default {
    data () {
      this.datarows = []
      this.drillkeys={}
      return {
        tableTitle:"详细信息",
        dialogVisible: false,
        tableColName: [],
        tableData: [],
        contentWidth:100,
        chartData: {
            histogram:{
                columns: ['类型', '问题单据数量','drillkey'],
                rows: this.datarows
            },
        },
        chartSettings: {
            extend:{
                //'xAxis.0.axisLabel.rotate': 45,
                series: {
                    label: { show: true, position: "top" }
                },
            },
            histogram:{
                metrics: ['问题单据数量'],
                dimension: ['类型']
            },
            chartEvents:{
              click: this.onBarClick
            }
        }
      }
    },
    methods: {
      handleClose: function(done) {
        this.$confirm('确认关闭？')
          .then(_ => {
            done();
          })
          .catch(_ => {});
      },
      getData: function(){
        const that = this

        this.datarows.length = 0
        axios.get('dashboard/getvalue',{
            params:{
              key:"dashboard:baddoc"
            }
        }).then(function(res){
            // console.log(res.data)

            res.data.forEach(row => {
                that.datarows.push({'类型':row["name"],'问题单据数量':row["value"]})
                that.drillkeys[row["name"]] = row["drillkey"]
            });

        }).catch(function (error) {
            console.log(error);
        });
      },
      onBarClick: function(e) {
        // console.log(e.name + " clicked")
        this.tableTitle = "问题单据详情-" + e.name
        var keyname=this.drillkeys[e.name]

        const that = this
        axios.get('dashboard/getvalue',{
            params:{
              key:keyname
            }
        }).then(function(res){
            that.contentWidth = 100
            that.dialogVisible= true
            that.tableColName=res.data.colNames
            that.tableData=[].concat(res.data.data)

            // console.log(that.tableData)
        }).catch(function (error) {
            console.log(error);
        })
  
      }
    },
    mounted() {
        const that = this
        this.getData()
        that.timer = setInterval(that.getData, 5000);

    },
    beforeDestroy() {
      clearInterval(this.timer);
    }
  }
</script>