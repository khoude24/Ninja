
var words = [];
axios.get('/words/valid')
    .then(function (response) {
        words = response.data;
    })
    .catch(function (error) {
        console.log(error);
    });



$("#tech").tagsManager({
    validator:   function validele(tag) {
        if (isInArray(tag.toLowerCase(), words)) {
            return true;
        } else {
            alert ('Invalid awesome word, try again!')
            return false;
        }
    }
});

function isInArray(value, array) {
    return array.indexOf(value) > -1;
}


if ( $( ".admin" ).length ) {
    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            backgroundColor: '#505D6A',

        },
        title: {
            text: '',
            style: {
                color: '#FFF',
                fontWeight: 'bold'
            }
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            },
            style: {
                color: '#FF00FF',
                fontWeight: 'bold'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
}