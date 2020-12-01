<script>

var posjobCanvas = document.getElementById("posjob");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var compareposjob = {
    labels: [
        "Position Title",
        "Job"
    ],
    datasets: [
        {
            data: [<?php echo $totalpos;?>, <?php echo $totaljob;?>],
            backgroundColor: [
                "#FF6384",
                "#63FF84"
            ]
        }]
};

var pieChart = new Chart(posjobCanvas, {
  type: 'pie',
  data: compareposjob
});
</script>


<script>

var filejobCanvas = document.getElementById("filepos");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var comparefilejob = {
    labels: [
        "File",
        "Job"
    ],
    datasets: [
        {
            data: [<?php echo $totalfile;?>, <?php echo $totaljobs;?>],
            backgroundColor: [
                "#FF6384",
                "#63FF84"
            ]
        }]
};

var pieChart = new Chart(filejobCanvas, {
  type: 'doughnut',
  data: comparefilejob
});
</script>