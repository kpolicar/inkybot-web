import Swiper, { Autoplay, Lazy } from 'swiper';
// import Swiper styles
import 'swiper/swiper-bundle.css';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import palette from 'google-palette';

let swiperElement = document.querySelector('#swiper-exos');

if (swiperElement) {
    let swiper = new Swiper(swiperElement, {
        slidesPerView: 2,
        lazy: true,
        spaceBetween: 5,
        grabCursor: true,
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            1280: {
                slidesPerView: 3,
                spaceBetween: 10
            },
        }
    });

    swiperElement.classList.remove('opacity-0')
}

let chartElements = document.querySelectorAll('.data-chart');
if (chartElements) {
    chartElements.forEach(chartElement => {

        let ctx = chartElement.getContext('2d');
        let chartData = JSON.parse(chartElement.dataset.dataset);

        let chart = new Chart(ctx, {
            plugins: [ChartDataLabels],
            type: 'pie',
            data: {
                labels: Object.keys(chartData),
                datasets: [{
                    data: Object.values(chartData).map(a => Object.values(a).reduce((a, b) => a + b, 0)),
                    backgroundColor: palette('cb-Dark2', Object.keys(chartData).length).map(function(hex) {
                        return '#' + hex;
                    }),
                    borderColor: 'rgb(0,0,0,0.4)',
                    borderWidth: 1,
                    cake: chartData
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

                                for (let [key, value] of Object.entries(context[0].dataset.cake[context[0].label])){
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

    });

}
