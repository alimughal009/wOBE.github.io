<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Scores Bar Chart</title>
  
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <!-- Add Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Add custom CSS -->
  <style>
    canvas {
      width: 100%;
      height: 400px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <label for="chartType">Chart Type:</label>
        <select id="chartType" class="form-control">
          <option value="bar">Bar</option>
          <option value="line">Line</option>
          <option value="radar">Radar</option>
          <option value="polarArea">Polar Area</option>
          <option value="pie">Pie</option>
          <option value="doughnut">Doughnut</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>

  <?php
  // Connect to the database
  $host = 'localhost:3307';
  $user = 'root';
  $password = '';
  $dbname = 'wobe';
  $conn = mysqli_connect($host, $user, $password, $dbname);

  // Check for connection errors
  if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
  }

  // Retrieve the data
  $query = "SELECT student_name, quiz, test, project, viva, exam FROM student_marks";
  $result = mysqli_query($conn, $query);

  // Convert the data to a JSON format
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
  }
  $json_data = json_encode($data);
  ?>

  <script>
  var student_data = <?php echo $json_data ?>;
  var labels = [];
  var quiz_scores = [];
  var test_scores = [];
  var project_scores = [];
  var viva_scores = [];
  var exam_scores = [];

  // Extract the data from the JSON object
  for (var i = 0; i < student_data.length; i++) {
    labels.push(student_data[i].student_name);
    quiz_scores.push(student_data[i].quiz);
    test_scores.push(student_data[i].test);
    project_scores.push(student_data[i].project);
    viva_scores.push(student_data[i].viva);
    exam_scores.push(student_data[i].exam);
  }


// Get the canvas element and create the chart

var ctx = document.getElementById('myChart').getContext('2d');
  var chartType = document.getElementById('chartType').value;
  var myChart;

  function createChart() {
    if (typeof myChart !== 'undefined') {
      myChart.destroy();
    }

    myChart = new Chart(ctx, {
      type: chartType,
      data: {
        labels: labels,
        datasets: [{
          label: 'Quiz',
          data: quiz_scores,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }, {
          label: 'Test',
          data: test_scores,
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }, {
          label: 'Project',
          data: project_scores,
          backgroundColor: 'rgba(255, 206, 86, 0.5)',
          borderColor: 'rgba(255, 206, 86, 1)',
          borderWidth: 1
        }, {
          label: 'Viva',
          data: viva_scores,
          backgroundColor: 'rgba(75, 192, 192, 0.5)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }, {
          label: 'Exam',
          data: exam_scores,
          backgroundColor: 'rgba(153, 102, 255, 0.5)',
          borderColor: 'rgba(153, 102, 255, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }

  createChart();

  var chartTypeSelect = document.getElementById('chartType');
  chartTypeSelect.addEventListener('change', function() {
    chartType = chartTypeSelect.value;
    createChart();
  });
</script>

</body>
</html>  
