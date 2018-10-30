function add_request_add_to_team(team_id) {
    //alert('добавить' + team_id);
    $.ajax({
        url: '/team/requesttoteam',
        type: 'get',
        data: {'team_id': team_id},
        success: function (data) {
            if (data.status == 100){
                addViewRequstToTeam(data);
                $("#btn_add_"+team_id).addClass("disabled");
            }
            if (data.status == 0){
                $("#btn_add_"+team_id).addClass("disabled");
            }
        },
        error: function () {

        }
    });
}

function setRequestRegected(team_id, user_id){
    $.ajax({
        url: '/team/requestreject',
        type: 'post',
        data: {'team_id': team_id, 'user_id': user_id},
        success: function (data) {
            if (data == 'OK'){
                removeRequestByUser(user_id);
            }
        },
        error: function () {

        }
    });
}

function removeRequest(team_id, user_id){
    $.ajax({
        url: '/team/requestremove',
        type: 'post',
        data: {'team_id': team_id, 'user_id': user_id},
        success: function (data) {
            if (data == 'OK'){
                removeRequestByTeam(team_id)
            }
        },
        error: function () {

        }
    });
}

function setRequestAccept(team_id, user_id){
    $.ajax({
        url: '/team/requestaccept',
        type: 'post',
        data: {'team_id': team_id, 'user_id': user_id},
        success: function (data) {
            if (data == 'OK'){
                removeRequestByUser(user_id);
            }
        },
        error: function () {

        }
    });
}



function addViewRequstToTeam(data) {
    var tbody = document.getElementById('list_requests');
    var tr = document.createElement('tr');

    var td_status = document.createElement("td");
    td_status.innerHTML = "<mark class=\"text-info\">Отправлена</mark>";

    var td_title = document.createElement("td");
    td_title.innerHTML = "<i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i>\r\n" + data.team.title;

    var td_desc = document.createElement("td");
    td_desc.innerHTML = data.team.description;

    var td_users = document.createElement("td");
    td_users.innerHTML = "<i class=\"fa fa-users\" aria-hidden=\"true\"></i>\r\n" + data.team.users;

    var td_date = document.createElement("td");
    td_date.innerHTML = "<i class=\"fa fa-user\" aria-hidden=\"true\"></i>\r\n" + data.team.date;

    var td_user = document.createElement("td");
    td_user.innerHTML = "<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>\r\n" + data.team.user;

    var td_remove = document.createElement("td");
    td_remove.innerHTML = "<a href=\"#\"><i class=\"fa fa-remove\" aria-hidden=\"true\"></i></a>";

    tr.appendChild(td_status);
    tr.appendChild(td_title);
    tr.appendChild(td_desc);
    tr.appendChild(td_users);
    tr.appendChild(td_date);
    tr.appendChild(td_user);
    tr.appendChild(td_remove);
    tbody.appendChild(tr);
}

function removeRequestByUser(user_id){
    var request = $('#request_' + user_id);
    request.detach();
}

function removeRequestByTeam(team_id){
    var request = $('#request_' + team_id);
    request.detach();

    $("#btn_add_" + team_id).removeClass('disabled');
}
