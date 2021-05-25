<template>
<div class="container">
    <div class="row ">
        <div class="col-md-12" style="background-color:#eeeeee;">
            <ve-chart :data="chartData.line" :settings="chartSettings.line" :extend="chartSettings.extend"></ve-chart>
        </div>
    </div>
</div>
</template>

<script>
  export default {
    data () {
      this.typeArr = ['line', 'histogram', 'pie']
      this.index = 0
      this.datarows = []
      return {
        chartData: {
            line:{
                columns: ['时间', '抛单状态','抛单队列'],
                rows: this.datarows
            },
        },
        chartSettings: {
            extend:{
                //'xAxis.0.axisLabel.rotate': 45,
                series:{
                    symbol:'none'
                },
                grid:{
                    bottom:'40%'
                },
                yAxis:{
                    minInterval: 1,
                    type: "value",
                }
            },
            line:{
                axisSite: { right: ['抛单队列'] },
                yAxisName: ['状态', '队列'],
                type: this.typeArr[this.index],
                min:[0],
                max:[2]
            },
        }
      }
    },
    methods: {
      getStatus: function(){
        const that = this

        axios.get('dashboard/getstatus',{
            params:{

            }
        }).then(function(res){
            var paodanStatus = Number(res.data.paodan)
            var paodanQlen = Number(res.data.qlen)
            var nowTime = new Date()

            if (that.datarows.length > 360) {
                that.datarows.shift()
            }

            that.datarows.push({'时间': nowTime.toLocaleTimeString(), '抛单状态': paodanStatus, '抛单队列':paodanQlen})

        }).catch(function (error) {
            console.log(error);
        });

        
      }
    },
    mounted() {
        const that = this
        that.timer = setInterval(that.getStatus, 10000);
    },
    beforeDestroy() {
      clearInterval(this.timer);
    }
  }
</script>