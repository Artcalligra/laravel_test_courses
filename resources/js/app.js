require('./bootstrap');
import $ from 'jquery';

window.onload = function () {
    // loadCourses();
}

/* 
$('#load_courses').click(function() {
    console.log('load');
    loadCourses();
}); */


$('#loadCourses').click(function () {
    console.log('load');
    loadCourses();
});

function loadCourses() {
    let status = 'show';
    var table;
    $.ajax({
        type: "GET",
        url: "api/show",
        data: 'status=' + status,
        success: function (msg) {
            let curse = JSON.parse(msg);
            console.log(curse['Currency']);

            table = '<table class="table"><thead><tr><th>NumCode</th><th>CharCode</th><th>Scale</th><th>Name</th><th>Rate</th><tr><thead></thead><tbody>';
           /*  for (var item in curse['Currency']) {
                console.log(item);
            } */
            $(curse['Currency']).each(function (index, item) {
                table += '<tr><td>' + item.NumCode + '</td><td>' + item.CharCode + '</td><td>' + item.Scale + '</td><td>' + item.Name + '</td><td>' + item.Rate + '</td></tr>';
            });

            table += '</tbody></table>'
            $('.table-block').append(table);
        }

    });

}

function showСourses() {
    console.log('show');
}
