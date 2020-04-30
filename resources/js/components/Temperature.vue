<template>
<div class="container">
    <div class="row ">
        <div class="col-md-3" style="background-color:#333333;">
            <ve-gauge :data="chartData.gauge" :settings="chartSettings.gauge"></ve-gauge>
        </div>
        <div class="col-md-9" style="background-color:#eeeeee;">
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
      this.gaugeRows = [{type: '温度', value: 0}]
      return {
        chartData: {
            line:{
                columns: ['时间', '空调温度'],
                rows: this.datarows
            },
            gauge:{
                columns: ['type', 'value'],
                rows: this.gaugeRows
            }
        },
        chartSettings: { 
            extend:{
                //'xAxis.0.axisLabel.rotate': 45,
                series:{
                    symbol:'none'
                }
            },
            line:{
                type: this.typeArr[this.index],
                min:[15],
                max:[40]
            },
            gauge:{
                labelMap:{
                    '温度':'Celsius'
                },
                dataName: {
                    '温度': '℃'
                },
                seriesMap: {
                    '温度': {
                        min:20,
                        max:40,
                        splitNumber:4,
                        radius: '90%',
                        axisLine: {
                        lineStyle: {
                            color: [[0.25, 'lime'],[0.5, '#1e90ff'],[0.75, 'orange'],[1, '#ff4500']],
                            width: 3,
                            shadowColor: '#fff',
                            shadowBlur: 10
                        }
                        },
                        axisLabel: {
                            textStyle: {
                                fontWeight: 'bolder',
                                color: '#fff',
                                shadowColor: '#fff',
                                shadowBlur: 10
                            }
                        },
                        axisTick: {
                            length:15,
                            lineStyle: {
                                color: 'auto',
                                shadowColor: '#fff',
                                shadowBlur: 10
                            }
                        },
                        splitLine: {
                            length:25,
                            lineStyle: {
                                width:3,
                                color: '#fff',
                                shadowColor: '#fff',
                                shadowBlur: 10
                            }
                        },
                        pointer: {
                            shadowColor: '#fff',
                            shadowBlur: 5
                        },
                        title: {
                            textStyle: {
                                fontWeight: 'bolder',
                                fontSize: 20,
                                fontStyle: 'italic',
                                color: '#fff',
                                shadowColor: '#fff',
                                shadowBlur: 10
                            }
                        },
                        detail: {
                            backgroundColor: 'rgba(30,144,255,0.8)',
                            borderWidth: 1,
                            borderColor: '#fff',
                            shadowColor: '#fff',
                            shadowBlur: 5,
                            offsetCenter: [0, '50%'],
                            textStyle: {
                                fontWeight: 'bolder',
                                fontSize:20,
                                color: '#fff'
                            }
                        }
                    },
                }
            }
        }
      }
    },
    methods: {
      changeType: function () {
        this.index++
        if (this.index >= this.typeArr.length) { this.index = 0 }
        this.chartSettings = { type: this.typeArr[this.index] }
      },
      genTemp: (max,min)=>Math.floor(Math.random() * (max - min) ) + min,
      getTemp: function(){
        const that = this

        axios.get('dashboard/getac',{
            params:{

            }
        }).then(function(res){
            var currentData = Number(res.data.celsius)
            var nowTime = new Date()

            if (that.datarows.length > 360) {
                that.datarows.shift()
            }

            that.gaugeRows[0].value = currentData
            that.datarows.push({'时间': nowTime.toLocaleTimeString(), '空调温度': currentData})

        }).catch(function (error) {
            console.log(error);
        });

        
      }
    },
    mounted() {
        const that = this

        axios.get('dashboard/getachist').then(function(res){
            var nowTime = new Date()
            var temp = 0

            res.data.forEach(element => {
                temp = element.celsius
                that.datarows.unshift({'时间': nowTime.toLocaleTimeString(), '空调温度': temp})
                nowTime.setTime(nowTime.getTime() - 5000)
            });
            
            that.gaugeRows[0].value = temp
            that.timer = setInterval(that.getTemp, 5000);
        }).catch(function(error){
            console.log(error)
        })
    },
    beforeDestroy() {
      clearInterval(this.timer);
    }
  }
</script>