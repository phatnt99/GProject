$(document).ready(function () {
  var pusher = new Pusher('419f519367020011ddd5', {
    cluster: 'ap1',
  })

  var channel = pusher.subscribe('user-channel')
  channel.bind('user-created', function (data) {
    console.log(data)
    $('.notify-content').text('New user ' + data.notify + ' has registered!')
    $('.toast').toast('show')
  })

  channel.bind('user-online', function (data) {
    console.log(data)
    $('.notify-content').text('User ' + data.notify + ' is online!')
    $('.toast').toast('show')
  })

  var barChartCanvas = $('#barChart').get(0).getContext('2d')

  var barChartData = []

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: true,
  }

  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions,
  })

  $('#filterChart').on('click', function () {
    $.ajax({
      url: '/filter-chart',
      type: 'GET',
      dataType: 'html',
      data: {
        fromD: $('#fromD').val(),
        toD: $('#toD').val(),
      },
    }).done(function (result) {
      var dataSets = JSON.parse(result)
      var barChartData = {
        labels: [],
        datasets:
          [
            {
              label: 'Newly registered users',
              backgroundColor: 'rgba(60,141,188,0.9)',
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: [],
            }],
      }
      dataSets.forEach(function (e) {
        formatDate = new Date(e.start_at)
        xValue = formatDate.getDate() + '/' + (formatDate.getMonth() + 1)
        yValue = e.soluong
        barChartData.labels.push(xValue)
        barChartData.datasets[0].data.push(yValue)
      })
      console.log('bar char = ' + barChartData.toString())
      barChart.data = barChartData
      barChart.update()
    })
  })

  $('#monthFilter').change(function () {
    var chooseMonth = new Date($(this).val())
    var firstDay = chooseMonth.getFullYear() + '-' + ("0" + (chooseMonth.getMonth() + 1)).slice(-2) + '-' +
      ("0" + new Date(chooseMonth.getFullYear(), chooseMonth.getMonth() + 1, 1).getDate()).slice(-2);
    var lastDay = chooseMonth.getFullYear() + '-' + ("0" + (chooseMonth.getMonth() + 1)).slice(-2) + '-' +
      ("0" + new Date(chooseMonth.getFullYear(), chooseMonth.getMonth() + 1, 0).getDate()).slice(-2);

    $('#fromD').attr('min', firstDay).attr('max', lastDay);
    $('#toD').attr('min', firstDay).attr('max', lastDay);
  })

})
