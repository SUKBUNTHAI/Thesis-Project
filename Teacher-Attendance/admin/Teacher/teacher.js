$(document).ready(function(){
    fetch();
    //add
    $('#addNew').click(function(){
        $('#add').modal('show');
    });
    $('#addForm').submit(function(e){
        e.preventDefault();
        var addform = $(this).serialize();
        //console.log(addform);
        $.ajax({
            method: 'POST',
            url: 'add.php',
            data: addform,
            dataType: 'json',
            success: function(response){
                $('#add').modal('hide');
                if(response.error){
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                }
                else{
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                    fetch();
                }
            }
        });
    });
    //

    //edit
    $(document).on('click', '.edit', function(){
        var id = $(this).data('t_id');
        getDetails(id);
        $('#edit').modal('show');
    });
    $('#editForm').submit(function(e){
        e.preventDefault();
        var editform = $(this).serialize();
        $.ajax({
            method: 'POST',
            url: 'edit.php',
            data:editform,
            dataType: 'json',
            success: function(response){
                if(response.error){
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                }
                else{
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                    fetch();
                }

                $('#edit').modal('hide');
            }
        });
    });
    //

    //delete
    $(document).on('click', '.delete', function(){
        var id = $(this).data('t_id');
        getDetails(id);
        $('#delete').modal('show');
    });

    $('.id').click(function(){
        var id = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'delete.php',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                if(response.error){
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                }
                else{
                    $('#alert').show();
                    $('#alert_message').html(response.message);
                    fetch();
                }

                $('#delete').modal('hide');
            }
        });
    });
    //

    //hide message
    $(document).on('click', '.close', function(){
        $('#alert').hide();
    });

});

function fetch(){
    $.ajax({
        method: 'POST',
        url: 'fetch_data.php',
        success: function(response){
            $('#tbody').html(response);
        }
    });
}

function getDetails(id){
    $.ajax({
        method: 'POST',
        url: 'fetch_row.php',
        data: {id:id},
        dataType: 'json',
        success: function(response){
            if(response.error){
                $('#edit').modal('hide');
                $('#delete').modal('hide');
                $('#alert').show();
                $('#alert_message').html(response.message);
            }
            else{
                $('.t_id').val(response.data.id);
                $('.name').val(response.data.name);
                $('.sex').val(response.data.sex);
                $('.age').val(response.data.age);
                $('.dob').val(response.data.dob);
                $('.pob').val(response.data.pob);
                $('.phone').val(response.data.phone);
                $('.address').val(response.data.address);
                // $('.fullname').html(response.data.firstname + ' ' + response.data.lastname);
            }
        }
    });
}