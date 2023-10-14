<template>
    <div class="flex flex-col items-center mt-10">
      
      <div class="w-3/4">
          <div id="chart">
          <!-- <div class="toolbar">
              <button id="one_month"
                  @click="updateData('one_month')" :class="{active: selection==='one_month'}"
                  >
                  1M
              </button>
              
              <button id="six_months"
                  @click="updateData('six_months')" :class="{active: selection==='six_months'}"
                  >
                  6M
              </button>
              
              <button id="one_year"
                  
                  @click="updateData('one_year')" :class="{active: selection==='one_year'}"
                  >
                  1Y
              </button>
              
              <button id="ytd"
                  @click="updateData('ytd')" :class="{active: selection==='ytd'}"
                  >
                  YTD
              </button>
              
              <button id="all"
                  @click="updateData('all')" :class="{active: selection==='all'}"
                  >
                  ALL
              </button>
          </div> -->
        
          <div id="chart-timeline ">
              <VueApexCharts type="area" class="" height="350" ref="chart" :options="chartOptions" :series="series"></VueApexCharts>
          </div>
        </div>
      </div>
        
    </div>
</template>

<script>
    import VueApexCharts from 'vue3-apexcharts';
    export default {
        components: { VueApexCharts},
        props: ['revenus'],
        data() {
            return {
                series: [{
                    name: 'PRIX',
                    data: this.revenus,
                }],
                chartOptions: {
                    chart: {
                        id: 'area-datetime',
                        type: 'area',
                        height: 350,
                        zoom: {
                            autoScaleYaxis: true,
                            enabled: false
                        }
                    },
                    annotations: {
                        yaxis: [{
                            y: 1000,
                            borderColor: '#999',
                            
                        }],
                        xaxis: [{
                            x: new Date().getTime(),
                            borderColor: '#999',
                            yAxisIndex: 0,
                            label: {
                            show: false,
                            text: 'Rally',
                            style: {
                                color: "#fff",
                                background: '#775DD0'
                            }
                            }
                        }]
                    },
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 0,
                        style: 'hollow',
                    },
                    xaxis: {
                        type: 'datetime',
                        min: new Date('17 Sep 2022').getTime(),
                        tickAmount: 6,
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy'
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 100]
                        }
                    },
                },
            
                selection: 'one_year',
            }
            
        },
        methods: {
          updateData: function(timeline) {
            this.selection = timeline
        
            switch (timeline) {
              case 'one_month':
                this.$refs.chart.zoomX(
                  new Date('28 Jan 2013').getTime(),
                  new Date('27 Feb 2013').getTime()
                )
                break
              case 'six_months':
                this.$refs.chart.zoomX(
                  new Date('27 Sep 2012').getTime(),
                  new Date('27 Feb 2013').getTime()
                )
                break
              case 'one_year':
                this.$refs.chart.zoomX(
                  new Date('27 Feb 2012').getTime(),
                  new Date('27 Feb 2013').getTime()
                )
                break
              case 'ytd':
                this.$refs.chart.zoomX(
                  new Date('01 Jan 2013').getTime(),
                  new Date('27 Feb 2013').getTime()
                )
                break
              case 'all':
                this.$refs.chart.zoomX(
                  new Date('23 Jan 2012').getTime(),
                  new Date('27 Feb 2013').getTime()
                )
                break
              default:
            }
          }
        }
    }
</script>

<style lang="scss" scoped>

</style>