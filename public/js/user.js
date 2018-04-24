$(document).ready(function() {
    var jqxhr = $.ajax( "http://localhost/testapi/public/api/v1/user?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvdGVzdGFwaS9wdWJsaWMvYXBpL3YxL3VzZXIvbG9naW4iLCJpYXQiOjE1MjQ1NTk5MjUsImV4cCI6MTUyNDU2MzUyNSwibmJmIjoxNTI0NTU5OTI1LCJqdGkiOiI5aVIxQkRFdDBrTUJQWmxaIn0.o0YylBXsvNCtAq3vsDbJ8UWqJU7bhy2CGESAZdPRaYg");
    jqxhr.done(function(resp){
        for(var i = 0; i < resp.data.user.length; i++){
            $('.userid').append(resp.data.user[i].id);
            $('.username').append(resp.data.user[i].name);
            $('.email').append(resp.data.user[i].email);
            $('.role').append(resp.data.user[i].level);
        }
        // console.log(resp.data.user.length);
        // $('.userid').html(resp.data.user[0].id);
        // $('.username').html(resp.data.user[0].name);
        // $('.email').html(resp.data.user[0].email);
        // $('.role').html(resp.data.user[0].level);
    });
});