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
    <el-dialog
      title="详细信息"
      :visible.sync="dialogVisible"
      width="30%"
      :before-close="handleClose">
      <span>这是一段信息</span>
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
      return {
        dialogVisible:false,
        chartData: {
            histogram:{
                columns: ['类型', '数量','drillkey'],
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
                metrics: ['数量'],
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
      getStatus: function(){
        const that = this

        this.datarows.length = 0
        axios.get('dashboard/getvalue',{
            params:{
              key:"dashboard:baddoc"
            }
        }).then(function(res){
            // console.log(res.data)

            res.data.forEach(row => {
                that.datarows.push({'类型':row["name"],'数量':row["value"],'drillkey':row["drillkey"]})
            });

        }).catch(function (error) {
            console.log(error);
        });
      },
      onBarClick: function(e) {
        console.log(e.name + " clicked")
        const that = this
        var keyname=""
        this.datarows.forEach(row => {
          if(row["类型"] == e.name) {
            keyname = row["drillkey"]
            console.log(keyname)
          }
        })
        axios.get('dashboard/getvalue',{
            params:{
              key:keyname
            }
        }).then(function(res){
            console.log(res.data)
            that.dialogVisible= true

        }).catch(function (error) {
            console.log(error);
        });
      }
    },
    mounted() {
        const that = this
        that.timer = setInterval(that.getStatus, 5000);

    },
    beforeDestroy() {
      clearInterval(this.timer);
    }
  }
</script>