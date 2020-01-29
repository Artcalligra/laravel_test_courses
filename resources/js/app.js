require('./bootstrap');
import $ from 'jquery';

window.onload = function () {
    showCourses();
}

$('#loadCourses').click(function () {
    loadCourses();
});

function loadCourses() {
    console.log('load');
    let status = true;
    $.ajax({
        type: "GET",
        url: "api/load",
        data: 'status',
        success: function (msg) {
            //  console.log(msg);
            if (status == msg) {
                showCourses();
            }
        }

    });

}

function showCourses() {
    console.log('show');
    var table;
    $.ajax({
        type: "GET",
        url: "api/show",
        data: 'status',
        success: function (msg) {
            // console.log(msg);
            let curse = JSON.parse(msg);
            // console.log(curse);
            table = '<table class="table"><thead><tr><th>NumCode</th><th>CharCode</th><th>Scale</th><th>Name</th><th>Rate</th><tr><thead></thead><tbody>';
            $(curse).each(function (index, item) {
                table += '<tr><td>' + item.NumCode + '</td><td>' + item.CharCode + '</td><td>' + item.Scale + '</td><td>' + item.Name + '</td><td>' + item.Rate.toFixed(2) + '</td></tr>';
            });

            table += '</tbody></table>';
            $('.table-block').html(table);
        }
    });
}
