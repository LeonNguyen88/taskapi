$(document).ready(function() {
    var jqxhr = $.ajax( "http://localhost/testapi/public/api/v1/user?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvdGVzdGFwaS9wdWJsaWMvYXBpL3YxL3VzZXIvbG9naW4iLCJpYXQiOjE1MjQ1NTk5MjUsImV4cCI6MTUyNDU2MzUyNSwibmJmIjoxNTI0NTU5OTI1LCJqdGkiOiI5aVIxQkRFdDBrTUJQWmxaIn0.o0YylBXsvNCtAq3vsDbJ8UWqJU7bhy2CGESAZdPRaYg");
    jqxhr.done(function(resp){
        for(var i = 0; i < resp.data.user.length; i++){

                // var compiled = _.template('<td>${ name }</td>');
                // compiled({ 'name': resp.data.user[i].name });
                $('.userlist').append(test(i));

        }
        $('.deleteuser').click(function(){
           var id = $(this).attr('data-id');
           deleteuser(id);
        });
        function deleteuser(id){
            $.ajax({
                url: 'http://localhost/testapi/public/api/v1/user/'+id,
                type: 'DELETE',
                success: function(result) {
                    window.location.href = "http://localhost/testapi/public/admin/user";
                }
            });
            return "a";
        }
        function test(i){
            return '<tr><td>'+resp.data.user[i].id+'</td>' +
                '<td>'+resp.data.user[i].name+'</td>' +
                '<td>'+resp.data.user[i].email+'</td>' +
                '<td>'+resp.data.user[i].role.name+'</td>' +
                '<td><a href="" class="btn btn-success">Promote</a>' +
                '<a href="" class="btn btn-primary">Demote</a>' +
                '<a href="#" class="btn btn-danger deleteuser" data-id="'+resp.data.user[i].id+'">Remove</a></td>'+'</tr>';
        }

        //console.log(resp);
        // console.log(resp.data.user.length);
        // $('.userid').html(resp.data.user[0].id);
        // $('.username').html(resp.data.user[0].name);
        // $('.email').html(resp.data.user[0].email);
        // $('.role').html(resp.data.user[0].level);
    });
});