<x-filament::widget>
    <div 
        x-data="{
            activeTab: 'today',
            charts: {},
            initCharts() {
                this.$nextTick(() => {
                    const periods = ['today', 'week', 'month'];
                    periods.forEach(period => {
                        const data = @json($data);
                        const labels = Object.keys(data[period]);
                        const values = Object.values(data[period]);
                        
                        const options = {
                            chart: {
                                height: 400,
                                type: 'radar',
                                toolbar: { show: false },
                                animations: { enabled: true },
                                fontFamily: 'Tajawal, sans-serif'
                            },
                            series: [{ name: 'الأداء', data: values }],
                            labels: labels,
                            colors: ['#3B82F6'],
                            fill: { opacity: 0.2 },
                            stroke: { width: 2 },
                            markers: { size: 5 },
                            plotOptions: {
                                radar: {
                                    size: 140,
                                    polygons: {
                                        strokeColors: '#E5E7EB',
                                        connectorColors: '#E5E7EB',
                                        fill: { colors: ['#F8FAFC', '#fff'] }
                                    }
                                }
                            },
                            yaxis: { 
                                show: false,
                                max: 100,
                                min: 0
                            },
                            tooltip: {
                                enabled: true,
                                rtl: true,
                                y: {
                                    formatter: (val) => `${val.toFixed(1)}%`,
                                    title: { formatter: () => 'النسبة' }
                                }
                            },
                            responsive: [{
                                breakpoint: 768,
                                options: { chart: { height: 300 } }
                            }]
                        };

                        const chartElement = document.getElementById(`chart-${period}`);
                        if (chartElement) {
                            this.charts[period] = new ApexCharts(chartElement, options);
                            this.charts[period].render();
                        }
                    });
                });
            },
            switchTab(tab) {
                this.activeTab = tab;
                this.$nextTick(() => {
                    if (this.charts[tab]) {
                        this.charts[tab].updateSeries([{
                            data: Object.values(@json($data)[tab])
                        }]);
                    }
                });
            }
        }"
        x-init="initCharts()"
        class="p-6 bg-white rounded-xl shadow-sm border border-gray-100"
    >
        <div class="flex flex-col space-y-4">
            <h3 class="text-xl font-bold text-gray-800 text-center">
                <span class="text-blue-600">◢</span> مثلث جلبرت - تحليل الأداء <span class="text-blue-600">◣</span>
            </h3>
            
            <div class="flex justify-center space-x-2 space-x-reverse">
                <button 
                    x-on:click="switchTab('today')"
                    :class="{
                        'bg-blue-600 text-white': activeTab === 'today',
                        'bg-gray-100 text-gray-700': activeTab !== 'today'
                    }"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    اليوم
                </button>
                <button 
                    x-on:click="switchTab('week')"
                    :class="{
                        'bg-blue-600 text-white': activeTab === 'week',
                        'bg-gray-100 text-gray-700': activeTab !== 'week'
                    }"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    الأسبوع
                </button>
                <button 
                    x-on:click="switchTab('month')"
                    :class="{
                        'bg-blue-600 text-white': activeTab === 'month',
                        'bg-gray-100 text-gray-700': activeTab !== 'month'
                    }"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    الشهر
                </button>
            </div>

            <div class="relative">
                <template x-if="activeTab === 'today'">
                    <div id="chart-today" class="w-full h-[400px]"></div>
                </template>
                <template x-if="activeTab === 'week'">
                    <div id="chart-week" class="w-full h-[400px]"></div>
                </template>
                <template x-if="activeTab === 'month'">
                    <div id="chart-month" class="w-full h-[400px]"></div>
                </template>
                
                <div x-show="Object.values(@json($data)[activeTab]).every(v => v === 0)" 
                     class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-80">
                    <p class="text-gray-500 text-lg">لا توجد بيانات متاحة</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 text-center text-sm">
                <div class="bg-blue-50 p-3 rounded-lg">
                    <p class="font-bold text-blue-700">الأهداف اليومية</p>
                    <p class="text-2xl font-bold">{{ $data['today']['الأهداف'] }}%</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <p class="font-bold text-green-700">النتائج المحققة</p>
                    <p class="text-2xl font-bold">{{ $data['today']['النتائج'] }}%</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-lg">
                    <p class="font-bold text-purple-700">كفاءة الموارد</p>
                    <p class="text-2xl font-bold">{{ $data['today']['الموارد'] }}%</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <style>
            .apexcharts-text.apexcharts-yaxis-label,
            .apexcharts-text.apexcharts-xaxis-label {
                font-family: 'Tajawal', sans-serif !important;
            }
        </style>
    @endpush
</x-filament::widget>