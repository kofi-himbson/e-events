$(document).ready(function(){
    $("#add_event").on('submit', function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: 'create_event.php',
            type: 'post',
            data:formdata,
            cache:false,
            processData: false,
            contentType: false,
            success: function(response){
                if(response === 'success'){
                    document.getElementById('name').value = '';
                    document.getElementById('price').value = '';
                    document.getElementById('tickets_available').value = '';
                    document.getElementById('description').value = '';
                    document.getElementById('file').value = '';
                    Swal.fire(
                      "Great",
                      "New Event created",
                      "success",
                  );
                 } else {
                  Swal.fire(
                      "Sorry",
                      "Event not created",
                      "error"
                  );
                }
            },
        });
    });


    $("#add_conference").on('submit', function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: 'create_conference.php',
            type: 'post',
            data:formdata,
            cache:false,
            processData: false,
            contentType: false,
            success: function(response){
                if(response === 'success'){
                    document.getElementById('conference_name').value = '';
                    document.getElementById('seats_available').value = '';
                    document.getElementById('conference_description').value = '';
                    document.getElementById('image').value = '';
                    Swal.fire(
                      "Great",
                      "New Conference created",
                      "success",
                  );
                 } else {
                  Swal.fire(
                      "Sorry",
                      "Conference not created",
                      "error"
                  );
                }
            },
        });
    });




$(".nav a").on("click", function() {
  $(".nav").find("#active").removeClass("active");
  $(this).parent().addClass("active");
});


$("#search_meeting").on('submit', function(e){
    e.preventDefault();
    let event = $('#event').val();
    $.ajax({
        type:'post',
        url:'search_conference.php',
        data:{event_id:event},
        success:function (response){
            $('#conference_attendees').html(response);
        } 
    })
});


$('#login').on('submit', function (e){
    e.preventDefault();
    let username = $('#username').val();
    let password = $('#pass').val();

    $.ajax({
        type:'post',
        url:'../admin/pages/login.php',
        data:{
            username:username,
            password:password
        },
        success:function(response){
            if(response === 'success'){
                window.location.href = "../admin/pages/dashboard.php";
             } else {
              Swal.fire(
                  "Sorry",
                  "Wrong username or password",
                  "error"
              );
            }

        }
    })

});






});

