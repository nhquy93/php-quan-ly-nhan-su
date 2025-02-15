<h2>THỐNG KÊ</h2>
<label for="chartType">Chọn loại biểu đồ:</label>
<select name="chartType" id="chartType" style="max-width: 200px; display: block;">
    <option value="pie" selected>Pie</option>
    <option value="bar">Bar</option>
    <option value="line">Line</option>
    <option value="doughnut">Doughnut</option>
</select>

<div style="display: flex; justify-content: center; align-items: center;">
    <canvas id="myChart" style="max-width: 600px; max-height: 600px;"></canvas>
</div>

<script>
    // Dữ liệu cho biểu đồ
    var data = <?php echo json_encode($data); ?>;

    // Khởi tạo biểu đồ
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',  // Giá trị mặc định là 'pie'
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            }
        }
    });

    // Thay đổi loại biểu đồ khi chọn loại khác từ dropdown
    document.getElementById('chartType').addEventListener('change', function () {
        var chartType = this.value;
        myChart.config.type = chartType;

        // Ẩn legend nếu không phải là biểu đồ tròn
        myChart.config.options.plugins.legend.display = chartType !== 'pie' && chartType !== 'doughnut' ? false : true;

        myChart.update();
    });
</script>
