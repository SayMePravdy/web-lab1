function checkY(valY) {
    const maxY = 5;
    const minY = -5;
    if (valY != "" && isFinite(valY) && valY < maxY && valY > minY) {
        return true;
    }
    return false;
}

function submit() {
    const valY = $("#y_arg").val();
    const valX = $("#x_arg").val();
    const valR = $("#r_arg").val();
    if (checkY(valY)) {
        $.ajax({
            url: 'php/index.php',
            method: 'GET',
            dataType: 'json',
            data: {
                x: valX,
                y: valY,
                r: valR,
            },
            success: function(data) {
                err_msg = data.err_msg;
                console.log(err_msg);
                console.log('1 point');
                if (err_msg.length === 0) {
                    row = '<tr>';
                    row += '<td>' + data.x + '</td>';
                    row += '<td>' + data.y + '</td>';
                    row += '<td>' + data.r + '</td>';
                    row += '<td>' + data.time + '</td>';
                    row += '<td>' + data.exec_time + '</td>';
                    row += '<td>' + data.check + '</td>';
                    row += '</tr>';
                    $('#history-table').append(row);
                } else {
                    console.log('2 point');
                    alert(err_msg);
                }
            }
        });
    } else {
        alert("Y должен лежать в интервале (-5;5)")
    }
}