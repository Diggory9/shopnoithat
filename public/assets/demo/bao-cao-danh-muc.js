// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
console.log(1);
var url = 'http://localhost:8080/admin/report-12-month';
let months = [];

async function fetchData() {
  try {
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    months = data;

    // Xử lý dữ liệu JSON ở đây
    let v = months.map(item => item.order_count);
    var ctx = document.getElementById("report-category");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["T1", "T2", "T3", "T4", "T5", "T6","T7","T8","T9","T10","T11","T12"],
        datasets: [{
          label: "Revenue",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: v ,
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 12
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 200,
              maxTicksLimit: 12
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });


  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

// Gọi hàm fetchData để bắt đầu quá trình fetch
fetchData();
// Bar Chart Example

