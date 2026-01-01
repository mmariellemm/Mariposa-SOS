
function ColumnBase(){
    return {
                series:[],
                      chart: {
                        type: 'bar',
                        height: 500
                      },
                      plotOptions: {
                        bar: {
                         horizontal: false,
                         columnWidth: '55%',
                         endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories:[],
                    },
                    yaxis: {
                        title: {
                            text: '$ (thousands)'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
   
            }
}