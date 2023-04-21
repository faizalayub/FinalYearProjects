<template>
    <div class="container-wrapper flex flex-column w-full overflow-auto">

        <div class="w-full bg-blue-500 flex align-items-center justify-content-center p-3">
            <h2 class="text-0 m-0 p-0">Liminator Control Panel</h2>
        </div>

        <div class="surface-ground grid grid-nogutter px-4 pt-5">
            <div class="col-12 md:col-6 lg:col-6 pr-3 pb-3">
                <div class="grid grid-nogutter">
                    <label
                        v-html="'Energy Output (W/CM<sup>2</sup>)'"
                        class="overflow-hidden text-overflow-ellipsis font-bold white-space-nowrap col-12 md:col-4 lg:col-4 flex align-items-center bg-blue-500 text-0 border-round-left p-3"
                        for="energy-output">
                    </label>
                    <InputNumber
                        class="col-12 md:col-8 lg:col-8"
                        id="energy-output"
                        v-model="value.energy"
                        inputClass="p-3 border-noround border-round-right"
                        placeholder="Energy Output"
                        @input="onChange"
                        :useGrouping="false"
                        :showButtons="false">
                    </InputNumber>
                </div>
            </div>

            <div class="col-12 md:col-6 lg:col-6 pr-2 pb-3">
                <div class="grid grid-nogutter">
                    <label
                        v-html="'Temperature (&#8451;)'"
                        class="overflow-hidden text-overflow-ellipsis font-bold white-space-nowrap col-12 md:col-4 lg:col-4 flex align-items-center bg-blue-500 text-0 border-round-left p-3"
                        for="temperature">
                    </label>
                    <InputNumber
                        class="col-12 md:col-8 lg:col-8"
                        id="temperature"
                        v-model="value.temperature"
                        inputClass="p-3 border-noround border-round-right"
                        placeholder="Temperature"
                        @input="onChange"
                        :useGrouping="false"
                        :showButtons="false">
                    </InputNumber>
                </div>
            </div>
        </div>

        <div class="grid grid-nogutter">
            <div class="col-12 md:col-4 lg:col-4 surface-ground pl-4 pr-5 pt-3 flex flex-column gap-4">
                <div class="w-full flex flex-column gap-3 pr-2">
                    <label
                        v-html="'Power Control (%)'"
                        class="flex-1 font-bold text-700 overflow-hidden text-overflow-ellipsis "
                        for="power-control">
                    </label>
                    <InputNumber
                        class="flex-1"
                        id="power-control"
                        v-model="value.power"
                        placeholder="Power Control"
                        @input="onChange"
                        inputClass="p-3"
                        :min="0"
                        :max="100"
                        :useGrouping="false"
                        :showButtons="true">
                    </InputNumber>
                </div>

                <div class="w-full flex flex-column gap-3 pr-2">
                    <label
                        v-html="'Speed (m/s)'"
                        class="flex-1 font-bold text-700 overflow-hidden text-overflow-ellipsis "
                        for="speed">
                    </label>
                    <InputNumber
                        class="flex-1"
                        id="speed"
                        inputClass="p-3"
                        v-model="value.speed"
                        placeholder="Speed Control"
                        @input="onChange"
                        :useGrouping="false"
                        :showButtons="true">
                    </InputNumber>
                </div>
            </div>

            <div class="col-12 md:col-8 lg:col-8 flex flex-column">
                <div class="pl-4 pr-5 graph-size border-300 surface-ground">
                    <div
                        class="h-full w-full surface-0 border-1 border-300 border-round pt-4 pl-4 pb-3"
                        ref="chartcontainer">
                    </div>
                </div>

                <div class="surface-ground grid grid-nogutter py-3 pl-4 pr-5 row-gap-3">
                    <template v-for="(index) in 6" :key="index">
                        <div class="col-12 md:col-6 lg:col-4 flex flex-column gap-3 pr-2">
                            <label
                                v-html="`Sensor ${ index }`"
                                class="flex-1 font-bold text-700 overflow-hidden text-overflow-ellipsis "
                                :for="`sensor_${ index }`">
                            </label>
                            <InputNumber
                                class="flex-1"
                                v-model="value.sensor[index]"
                                placeholder="Sensor"
                                @input="onChange"
                                inputClass="p-3"
                                :id="`sensor_${ index }`"
                                :useGrouping="false"
                                :showButtons="false">
                            </InputNumber>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import * as echarts from 'echarts';
import rawdata from './dataset.json';
import InputNumber from 'primevue/inputnumber';

export default {
    name: 'dashboard',
    components: {
        InputNumber
    },
    data: () => ({
        value: {
            sensor: [],
            speed: null,
            power: null,
            energy: null,
            temperature: null,
        },
        chartAction: {
            right: 10,
            feature: {
                dataZoom: {
                    yAxisIndex: 'none'
                },
                restore: {},
                saveAsImage: {}
            }
        },
        chartTitle: {
            text: 'Sail Temperature Graph',
            left: '20'
        }
    }),
    methods: {
        onChange: function(){
            console.log(this.value);
        }
    },
    watch: {

    },
    mounted: function(){
        let chartEl = this.$refs.chartcontainer;
        let myChart = echarts.init(chartEl);

        let configuration = {
            title: this.chartTitle,
            tooltip: {
                trigger: 'axis'
            },
            grid: {
                left: '5%',
                right: '15%',
                bottom: '10%'
            },
            xAxis: {
                data: rawdata.map(function (item) {
                    return item[0];
                })
            },
            yAxis: {},
            toolbox: false,//this.chartAction,
            dataZoom: [{
                startValue: '2009-06-01',
                endValue: '2010-06-01'
            },{
                type: 'inside'
            }],
            visualMap: {
                top: 50,
                right: 10,
                pieces: [{
                    gt: 0,
                    lte: 50,
                    color: '#93CE07'
                },
                {
                    gt: 50,
                    lte: 100,
                    color: '#FBDB0F'
                },
                {
                    gt: 100,
                    lte: 150,
                    color: '#FC7D02'
                },
                {
                    gt: 150,
                    lte: 200,
                    color: '#FD0100'
                },
                {
                    gt: 200,
                    lte: 300,
                    color: '#AA069F'
                },
                {
                    gt: 300,
                    color: '#AC3B2A'
                }],
                outOfRange: {
                    color: '#999'
                }
            },
            series: {
                name: 'Printer',
                type: 'line',
                data: rawdata.map(function (item) {
                    return item[1];
                }),
                markLine: {
                    silent: true,
                    lineStyle: {
                        color: '#333'
                    },
                    data: [
                        { yAxis: 50 },
                        { yAxis: 100 },
                        { yAxis: 150 },
                        { yAxis: 200 },
                        { yAxis: 300 }
                    ]
                }
            }
        };

        myChart.setOption(configuration);

        window.jubo = this;
    }
}
</script>

<style lang="scss">
    @import '_core.scss';
    @import '_code.scss';

    .container-wrapper{
        height: 100vh;
    }

    .graph-size{
        height: 80vh;
    }
</style>