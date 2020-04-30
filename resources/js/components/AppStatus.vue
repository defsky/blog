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
                columns: ['时间', '抛单'],
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
                }
            },
            line:{
                metrics: ['抛单'],
                dimension: ['时间'],
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
            var nowTime = new Date()

            if (that.datarows.length > 360) {
                that.datarows.shift()
            }

            that.datarows.push({'时间': nowTime.toLocaleTimeString(), '抛单': paodanStatus})

        }).catch(function (error) {
            console.log(error);
        });

        
      }
    },
    mounted() {
        const that = this
        that.timer = setInterval(that.getStatus, 10000);

        // axios.get('dashboard/getachist').then(function(res){
        //     var nowTime = new Date()
        //     var temp = 0

        //     res.data.forEach(element => {
        //         temp = element.celsius
        //         that.datarows.unshift({'时间': nowTime.toLocaleTimeString(), '空调温度': temp})
        //         nowTime.setTime(nowTime.getTime() - 5000)
        //     });
            
        //     that.gaugeRows[0].value = temp
        //     that.timer = setInterval(that.getTemp, 5000);
        // }).catch(function(error){
        //     console.log(error)
        // })
    },
    beforeDestroy() {
      clearInterval(this.timer);
    }
  }
</script>