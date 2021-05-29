import Swiper, { Autoplay, Lazy } from 'swiper';
// import Swiper styles
import 'swiper/swiper-bundle.css';

import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
let palette = require('google-palette');

Swiper.use(Autoplay);
Swiper.use(Lazy);

let swiperElement = document.querySelector('#swiper-exos');

if (swiperElement) {
    let swiper = new Swiper(swiperElement, {
        slidesPerView: 1,
        lazy: true,
        spaceBetween: 2,
        grabCursor: true,
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 5
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 10
            },
        }
    });

    swiperElement.classList.remove('opacity-0')
}

let previousActivity = document.querySelector('#previous-activity');
let previousActivityContent = document.querySelector('#previous-activity-content');
let previousActivityDatepicker = document.querySelector('#previous-activity-dateselector');

if (previousActivityDatepicker && previousActivity) {
    previousActivityDatepicker.addEventListener('change',
        () => {

            if (previousActivityDatepicker.value === previousActivityDatepicker.dataset.notallowed)
                return;

            previousActivity.classList.add('opacity-50');
            previousActivity.classList.add('pointer-events-none');
            previousActivity.querySelector('.loader').classList.remove('hidden');
            previousActivityDatepicker.classList.add('cursor-wait');
            previousActivityDatepicker.classList.add('pointer-events-none');

            const params = {
                date: previousActivityDatepicker.value
            };

        axios.get(previousActivityDatepicker.dataset.dataHandler, { params })
            .then(result => {
                previousActivityContent.innerHTML = result.data;
                loadDataCharts();
            })
            .finally(() => {
                previousActivity.classList.remove('opacity-50');
                previousActivity.classList.remove('pointer-events-none');
                previousActivity.querySelector('.loader').classList.add('hidden');
                previousActivityDatepicker.removeAttribute('disabled')
                previousActivityDatepicker.classList.remove('cursor-wait');
                previousActivityDatepicker.classList.remove('pointer-events-none');
            })
        })
}

let loadDataCharts = () => {
    let chartElements = document.querySelectorAll('.data-chart:not(.loaded)');
    if (chartElements) {
        chartElements.forEach(chartElement => {

            let ctx = chartElement.getContext('2d');
            let chartData = JSON.parse(chartElement.dataset.dataset);
            let keys = Object.keys(chartData);
            let values = Object.values(chartData);

            let chart = new Chart(ctx, {
                plugins: [ChartDataLabels],
                type: 'pie',
                data: {
                    labels: keys,
                    datasets: [{
                        data: values.map(a => Object.values(a).reduce((a, b) => a + b, 0)),
                        backgroundColor: palette('cb-Pastel1', keys.length).map(function(hex) {
                            return '#' + hex;
                        }),
                        borderColor: 'rgb(0,0,0,0.4)',
                        borderWidth: 1,
                        chartData: chartData
                    }],
                },
                options: {
                    layout: {
                        padding: 0,
                    },
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                footer: function (context) {
                                    let txt = ''
                                    let first = true;

                                    for (let [key, value] of Object.entries(context[0].dataset.chartData[context[0].label])){
                                        if (!first) {
                                            txt += '\n';
                                        }
                                        txt += key+": "+value;
                                        first = false;
                                    }

                                    return txt;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: chartElement.dataset.title
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value*100 / sum).toFixed(0)+"%";
                                return percentage;
                            },
                            color: '#000',
                        }
                    },
                }
            });

            chartElement.classList.add('loaded');
        });

    }
};

loadDataCharts();
